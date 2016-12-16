<?php


// Ovládání informačních/chybových hlášek v Rocket 4.0


$tb = new table("tbAlerts");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("color", "varchar", 32);
$tb->column("text", "varchar", 256);


//back compatible - old "mess" class

class mess{
    static function create($color, $mess){
        new alert($color, $mess);
    }
    static function show(){
        alert::show();
    }
}

class alert{
    protected $pageName;
    protected $modul;

    public function __construct($color = "", $mess = ""){
        if(!empty($color)) {
            self::create($color, $mess);
        }
    }
    static function show(){
       if (isset(        $_SESSION["mess"])){


           
       $id = $_SESSION["mess"];

        $query = new sql("SELECT * FROM tbAlerts WHERE id = '$id'");
           $zaznam = $query->first();


           unset($_SESSION["mess"]);
           echo '
                    <div class="err '.$zaznam["color"].'">
                         '.$zaznam["text"].'
                    </div>
                    ';

       }
    }
    
    private function create($color, $mess){
        $mess = sql::escape($mess);
        $query = new sql("SELECT * FROM tbAlerts WHERE text = '$mess'");

        $_SESSION["mess"] = "-";
        foreach ($query->all() as $zaznam) {
            $_SESSION["mess"] = $zaznam["id"];
        }

        if ($_SESSION["mess"] == "-"){
            $query = new sql("INSERT INTO tbAlerts SET color='$color', text = '$mess'");
            $_SESSION["mess"] = $query->inserted();
        }


    }
}