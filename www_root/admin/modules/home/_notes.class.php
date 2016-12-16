<?php

class notes{
    
   
   
     static function dejData(){
        $query = "SELECT n.*, u.name FROM tbNotes n inner join tbUsers u on u.id = n.user where n.isDel = 0 order by n.date desc";
        $data = mysqli_query($link, $query);
        $out = "";
        while ($zaznam = mysql_fetch_assoc($data)) {
          
                $zaznam["photo"] = "img/content.png";
       
            $out .=' 
              
                 <div class="note a" data="'.$zaznam["id"].'">
        <div class="over a">
            <div class="btn a red deleteNote" data="'.$zaznam["id"].'">Smazat</div>
        </div>
        <p>'.$zaznam["text"].'</p>
        <div class="info">'.$zaznam["name"].', '.date("j.n.Y", (strtotime($zaznam["date"]))).'</div>
    </div>


                    ';
        }
        return $out;
    }
  
       static  function dejPosledni($text){
        $query = "SELECT n.*, u.name FROM tbNotes n inner join tbUsers u on u.id = n.user where n.isDel = 0 and text = '$text' and user = {$_SESSION["id"]} order by n.date desc";
        $data = mysqli_query($link, $query);
        $out = "";
        while ($zaznam = mysql_fetch_assoc($data)) {
          
                $zaznam["photo"] = "img/content.png";
       
            $out .=' 
              
                 <div class="note a" data="'.$zaznam["id"].'">
        <div class="over a">
            <div class="btn a red deleteNote" data="'.$zaznam["id"].'">Smazat</div>
        </div>
        <p>'.$zaznam["text"].'</p>
        <div class="info">'.$zaznam["name"].', '.date("j.n.Y", (strtotime($zaznam["date"]))).'</div>
    </div>


                    ';
        }
        return $out;
    }
}
