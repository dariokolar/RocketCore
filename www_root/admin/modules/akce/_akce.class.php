<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class akce{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbAkce WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function kategorie(){
        $query = "SELECT kategorie FROM tbAkce group by kategorie ";
        $data = new sql($query);
        $arr = array();
        foreach ($data->all() as $zaznam) {
            $arr["{$zaznam["kategorie"]}"] = $zaznam["kategorie"];
        }
        return $arr;
    }
  
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbAkce WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }

    static function dejByRew($rew){
        $query = "SELECT * FROM tbAkce WHERE rew = '$rew'";
        $data = new sql($query);
        $out =  $data->first();

        $views = $out["views"] + 1;

        new sql("Update tbAkce set views = $views where isDel = 0 and rew = '$rew'");
        return $out;
    }

        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbAkce where 1=1 $filtr ";
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

            if($zaznam["datumDo"] != "0000-00-00 00:00:00"){
                $dateDo = " - ".dateformat($zaznam["datumDo"]);
            }

            if(!empty($zaznam["misto"])){
                $place = ", ".$zaznam["misto"];
            }

            $line->addNote(dateformat($zaznam["datum"]).$dateDo.$place);
	        $line->addNote('<a href="/akce/'.$zaznam["rew"].'" target="_blank">Otevřít</a>' );
	    
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
