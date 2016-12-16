<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class aktuality{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbAktuality WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function kategorie(){
        $query = "SELECT kategorie FROM tbAktuality group by kategorie ";
        $data = new sql($query);
        $arr = array();
        foreach ($data->all() as $zaznam) {
            $arr["{$zaznam["kategorie"]}"] = $zaznam["kategorie"];
        }
        return $arr;
    }
  
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbAktuality WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }

    static function dejByRew($rew){
        $query = "SELECT * FROM tbAktuality WHERE rew = '$rew'";
        $data = new sql($query);
        $out =  $data->first();

        $views = $out["views"] + 1;

        new sql("Update tbAktuality set views = $views where isDel = 0 and rew = '$rew'");
        return $out;
    }

        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbAktuality where 1=1 $filtr ";
	      $_SESSION["query"] = $query;
	 }
	 $num = 64;
         $page = ($page-1)*$num;

	$query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["title"]);
	        $line->addIcon($zaznam["photo"], "img/page.png");

            $line->addNote($zaznam["autor"]);
            $line->addNote("Zobrazení: ".$zaznam["views"]);
            $line->addNote(dateformat($zaznam["datum"]));
	        $line->addNote('<a href="/aktuality/'.$zaznam["rew"].'" target="_blank">Otevřít</a>' );
	    
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
