<?php
/**
 *  SQL nadstavba, umožňuje vyměnit/změnit funkce pro připojení k db bez nutnosti přepisovaat moduly
 *
 * Příklad:
 *      $query = new sql("SELECT * FROM tbUsers");
 *
 *      foreach($data as $zaznam){
 *          ...
 *
 */


function query(){
    global $link;
    mysqli_query($link, $query);
    return mysqli_insert_id();
}

class sql{

    protected $query;
    protected $inserted;
    protected $data;

    static function real_escape_string($in){
        global $link;
        return mysqli_real_escape_string($link,$in);
    }

    public function __construct($query){
        $this->query = $query;
        $this->exec();
    }

    private function exec($query = ""){
        if (!empty($query)) {
            $this->query = $query;
        }
        global $link;


        $this->data = mysqli_query($link, $this->query);

        if(mysqli_errno($link)){

            new alert("red", "MySQL error ".mysqli_errno($link).": "
                .mysql_error()."\n<br>When executing <br>\n$this->query\n<br>");
            echo $this->query;
            alert::show();
        }
        
        if (strpos(strtolower($this->query), 'insert') !== false) {
            $this->inserted = mysqli_insert_id($link);
        }
    }
    public function all(){

        if(empty($this->data)){
            return;
        }
        $array = array();
        while ($zaznam = mysqli_fetch_assoc($this->data)) {
            $array[] = $zaznam;
        }
       // echo_array($this->query);
       // echo_array($array);
        return $array;

    }
    public function last(){
        return end($this->all());
    }

    public function first(){
        return current($this->all());
    }

    public function inserted(){
        return $this->inserted;
    }
    static function escape($in){
        global $link;
        return mysqli_real_escape_string($link, $in);
    }
}


