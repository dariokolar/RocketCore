<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class labels{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbLabels WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
  
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbLabels WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function returnArray(){
        $query = "SELECT * FROM tbLabels WHERE isDel = 0 and isActive = 1";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $label){
            $out[$label["id"]] = $label["name"];
        }
        return $out;
    }

  static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbLabelsLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }
        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbLabels where 1=1 $filtr ";
	      $_SESSION["query"] = $query;
	 }
	     $num = 32;
         $page = ($page-1)*$num;

	    $query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["name"]);
	    $line->addIcon($zaznam["photo"], "img/tag.png");
	    
	    $del = new button('<i class="fa fa-times"></i> Smazat', 'labelDel', $zaznam["id"], "del", "red");
	    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'labelEdit', $zaznam["id"]);
	    
	    $line->addButton($del->getString());
	    $line->addButton($edit->getString());
	     
	    $line->langButtons("labelLang", $zaznam["id"]);
	    
	    $out .= $line->getString();
        }
        return $out;
    }
   
}
