<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class gallery{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbGallery WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
  static function all($start = 0, $limit = 4){

          $query = "SELECT * FROM tbGallery where isDel = 0 and isActive = 1 order by date desc LIMIT $start,$limit";

      $data = new sql($query);
      $out = array();
      foreach ($data->all() as $zaznam) {

          unset($tmpout);

          $query = "SELECT p.ownOrder, p.note, f.* FROM tbGalleryPhotos p left join tbFiles f on p.file = f.id WHERE p.source = {$zaznam["id"]} and p.isDel = 0 order by ownOrder limit 0,1";
          $tmpd = new sql($query);
          $tmp["nahled"] = $tmpd->first();

          if(!empty($tmp["nahled"]["link"])){
              $zaznam["photo"] = $tmp["nahled"]["link"];
          }
          $tmpout["name"] = $zaznam["name"];
          $tmpout["rew"] = $zaznam["rew"];
          $tmpout["date"] = $zaznam["date"];
          $tmpout["preview"] = $zaznam["photo"];

         $out[] = $tmpout;
      }
      return $out;
  }
    
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbGallery WHERE id = '$id'";
        $data = new sql($query);
        $out =  $data->first();

        $query = "SELECT p.ownOrder, p.note, f.* FROM tbGalleryPhotos p left join tbFiles f on p.file = f.id WHERE p.source = $id and p.isDel = 0 order by ownOrder limit 0,1";
        $data = new sql($query);
        $out["nahled"] = $data->first();

        return $out;
    }
    static function returnArray(){
        $query = "SELECT * FROM tbGallery WHERE isDel = 0 and isActive = 1";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $label){
            $out[$label["id"]] = $label["name"];
        }
        return $out;
    }

    static function dejPhotoList($id){
        $query = "SELECT p.ownOrder, p.note, f.* FROM tbGalleryPhotos p left join tbFiles f on p.file = f.id WHERE p.source = $id and p.isDel = 0 order by ownOrder";
        $data = new sql($query);
        $out = "";
       foreach ($data->all() as $zaznam){

            $out .= self::oneline($zaznam, $id);

        }
        return $out;
    }

   static function onePhoto($id, $source){
        $id = intval($id);
        $source = intval($source);
        $query = "SELECT * FROM tbFiles where id = $id";
        $data = new sql($query);
        $out = "";

        foreach ($data->all() as $zaznam){
            $out .= self::oneline($zaznam, $source);

            $query = "INSERT INTO tbGalleryPhotos SET source=$source, file = {$zaznam["id"]}, ownOrder = 1";
            new sql($query);
            $query = "UPDATE tbFiles SET hidden = 1 WHERE id = $id";
            new sql($query);
        }
        return $out;
    }


    static function oneline($zaznam, $id){

       if(empty($zaznam["note"])){
           $note = "Přidat poznámku";
       }else{
           $note = "Upravit poznámku";
       }

        $photoData = photoData($zaznam["id"]);


        $line = new line($zaznam["name"], $zaznam["id"]);
        $line->addIcon($zaznam["link"], "img/photo.png");
        $line->dragable();
        $line->big();
        $line->addNote('<i class="fa fa-camera"></i> '.$photoData["device"] );

        if(empty($photoData["date"])){
            $photoData["date"] = $zaznam["date"];
        }

        $line->addNote('<i class="fa fa-calendar"></i> '.date("j.n.Y H:i", (strtotime($photoData["date"]))) );
        $line->addNote('Apperture: '.$photoData["aperture"] );
        $line->addNote('Focal length: '.$photoData["focal"] );
        $line->addNote('Exposure time: '.$photoData["exposure"] );
        $line->addNote('Exposure time: '.$photoData["exposure"] );
        $line->addNote('ISO '.$photoData["iso"] );
        $line->addNote('<a href="'.$zaznam["link"].'" target="_blank">Zobrazit v plném rozlišení</a>' );
        $del = new button('<i class="fa fa-times"></i> Smazat', 'photoDel', $zaznam["id"], "del", "red");
        $del->addSource($id);
        $note = new button('<i class="fa fa-pencil-square-o"></i> '.$note, 'photoNote', $zaznam["id"], "note");
        $note->addSource($id);
        $line->addButton($del->getString());
        $line->addButton($note->getString());

        return $line->getString();

    }

    static function photoData($id){
        $id = intval($id);
        $query = "SELECT p.note, f.* FROM tbFiles f inner join tbGalleryPhotos p on f.id = p.file WHERE f.id = '$id'";
        $data = new sql($query);
        return $data->first();
    }


    static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbGalleryLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }

    static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbGallery where 1=1 $filtr ";
	      $_SESSION["query"] = $query;
	 }
	     $num = 32;
         $page = ($page-1)*$num;

	    $query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["name"]);

            $query = "SELECT p.ownOrder, p.note, f.* FROM tbGalleryPhotos p left join tbFiles f on p.file = f.id WHERE p.source = {$zaznam["id"]} and p.isDel = 0 order by ownOrder limit 0,1";
            $tmpd = new sql($query);
            $tmp["nahled"] = $tmpd->first();

            if(!empty($tmp["nahled"]["link"])){
                $zaznam["photo"] = $tmp["nahled"]["link"];
            }

	    $line->addIcon($zaznam["photo"], "img/photo.png");

            $line->addNote(dateformat($zaznam["date"]));
	    
	    $del = new button('<i class="fa fa-times"></i> Smazat', 'galDel', $zaznam["id"], "del", "red");
	    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'galNahled', $zaznam["id"]);
	    
	    $line->addButton($del->getString());
	    $line->addButton($edit->getString());


	    $out .= $line->getString();
        }
        return $out;
    }
   
}
