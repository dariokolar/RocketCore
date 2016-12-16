<?php

class lang{
    
    function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbLangs WHERE id = '$id'";
	
        $data = mysqli_query($link, $query);
        while ($zaznam = mysql_fetch_assoc($data)) {

            return $zaznam;
        }
    }
   
     function dejList($page, $query){
         $num = 100;
         $page = ($page-1)*$num;
        $query = "SELECT * FROM tbLangs WHERE 1 = 1 $query LIMIT $page,$num";
        $data = new sql($query);
        $out = "";
	
        foreach ($data->all() as $zaznam) {
       		 
        $line = new line($zaznam["name"]);
	    $line->addIcon($zaznam["icon"], "img/flag.png");
	    $line->addNote($zaznam["short"]);
	    
	    $del = new button('<i class="fa fa-times"></i> Smazat', 'langDel', $zaznam["id"], "del", "red");
	    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'langEdit', $zaznam["id"]);
	     if ($zaznam["id"] != 1){
	       	    $line->addButton($del->getString());
	   }
	    $line->addButton($edit->getString());
	    
	    $out .= $line->getString();
	   
        }
        return $out;
    }
  
       static function buttons($source, $page){
        
        $query = "SELECT * FROM tbLangs WHERE id > 1 and isActive = 1";
        $data = new sql($query);
        $out = "";
        foreach ($data as $zaznam) {
          
	   
		 
	     $edit = new button('<div class="icon" style="background-image: url('.photo($zaznam["icon"], "small", "img/flag.png").')"></div>', $page, $zaznam["id"], "page", "grey");
	     $edit->addSource($source);
	     $out .=$edit->getString();
	   
        }
        return $out;
    }
         static function buttonsMin($source, $page){
        
        $query = "SELECT * FROM tbLangs WHERE id > 1 and isActive = 1";
             $data = new sql($query);
             $out = "";
             foreach ($data as $zaznam) {
          
	         $out .='
		     <div class="btn a grey min" page="'.$page.'" do="note" data="'.$zaznam["id"].'" source="'.$source.'"><div class="icon" style="background-image: url('.photo($zaznam["icon"], "small", "img/flag.png").')"></div></div>

                   ';
	   
        }
        return $out;
    }
    
     static function title($id){
        $id = intval($id);
        $query = "SELECT * FROM tbLangs WHERE id = '$id'";

         $data = new sql($query);
         foreach ($data as $zaznam) {

            return $zaznam["name"];
        }
    }
  static  function short($id){
        $id = intval($id);
        $query = "SELECT * FROM tbLangs WHERE id = '$id'";

      $data = new sql($query);
      foreach ($data as $zaznam) {

            return $zaznam["short"];
        }
    }
    
      function langsOut(){
        
        $query = "SELECT * FROM tbLangs WHERE isActive = 1 and isDel = 0";
	
        $data = mysqli_query($link, $query);
        $out = "";
        while ($zaznam = mysql_fetch_assoc($data)) {
		if ($_SESSION["lang"] == $zaznam["id"]){
		    $active = " aktivni ";
		}else{
		    $active = "";
		}
	    
	        $out .=' 
		 
		    <li> <a href="/do/changeLang.php?lang='.$zaznam["id"].'"> <img src="'.$zaznam["icon"].'" alt="" title="" width="22" height="15" /></a></li>
                    ';
	   
        }
        return $out;
    }
}
