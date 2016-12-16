<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class pages{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbPages WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
  
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbPages WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
  static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbPagesLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }
        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbPages where 1=1 $filtr "; 
	      $_SESSION["query"] = $query;
	 }
	 $num = 32;
         $page = ($page-1)*$num;

	$query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["name"]);
	    $line->addIcon($zaznam["photo"], "img/page.png");
	    $line->addNote('<a href="/page/'.$zaznam["rew"].'" target="_blank">Otevřít</a>' );
	    
	    $del = new button('<i class="fa fa-times"></i> Smazat', 'pageDel', $zaznam["id"], "del", "red");
	    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'pageEdit', $zaznam["id"]);
	    
	    $line->addButton($del->getString());
	    $line->addButton($edit->getString());
	     
	    $line->langButtons("pageLangEdit", $zaznam["id"]);
	    
	    $out .= $line->getString();
        }
        return $out;
    }
   
}
