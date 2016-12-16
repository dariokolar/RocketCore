<?php
/*
 * TynyRocket 2.0
 * Modul správce souborů
 * 
 * verze 0.6
 * 
 * Využívá objektu multiFiles z třídy form
 * Využívá funkce ze souboru supportFunctions (získávání miniatur, exif dat,...)
 * 
 * (c) 2015
 */

class files{
    
   
   static function dejList($page, $search="", $filtr=""){
        $num = 100;
        $page = ($page-1)*$num;
        
                
        $query = "SELECT * FROM tbFiles where isDel = 0 and hidden = 0 and user = {$_SESSION["id"]} order by date desc LIMIT $page,$num";
        $data = new sql($query);
        $out = "";

       foreach($data->all() as $zaznam){
            $out .=' 
                <div class="box file a" data="'.$zaznam["id"].'">
                    <div class="icon" style="background-image: url('.iconFile($zaznam["link"], $zaznam["extension"], "small").')"></div>
                    <div class="data">
                        <div class="name">'.$zaznam["name"].'</div>
                    </div>
                    <div class="info">
                        <div class=type>'.self::humanType($zaznam["extension"]).'</div>
                        <div class=size>'.self::humanSize($zaznam["size"]).'</div>
                        <div class=icon>'.iconFile($zaznam["link"], $zaznam["extension"]).'</div>
                        <div class=date>'.date("j.n.Y H:i", (strtotime($zaznam["date"]))).'</div>
                        <div class=link>'.$zaznam["link"].'</div>
                    </div>
                </div> ';
        }
        return $out;
    }
   
   static function humanSize($size){
        $out = "Undefined";
	 	if ($size == 0){  $out = "Undefined";}
	 	if ($size > 1000){ $out = number_format(($size/1000), 2, '.', '')." KB" ;}
		if ($size > 1000000){ $out = number_format(($size/1000000), 2, '.', '')." MB" ;}
		if ($size > 1000000000){ $out = number_format(($size/1000000000), 2, '.', '')." GB" ;}
        return $out;
    }
    
   static function humanType($extension){
        $out = "Various";
	if (strtolower($extension) == "gif") {$out = "GIF obrázek";         }
	if (strtolower($extension) == "jpeg") {$out = "JPG obrázek";        }
	if (strtolower($extension) == "jpg") {$out = "JPG obrázek";         }
	if (strtolower($extension) == "png") {$out = "PNG obrázek";         }
	if (strtolower($extension) == "pdf") {$out = "PDF soubor";        }
	if (strtolower($extension) == "doc") {$out = "Word dokument";            }
	if (strtolower($extension) == "docx") {$out = "Word dokument";           }
        if (strtolower($extension) == "xls") {$out = "Excel tabulka";       }
        if (strtolower($extension) == "xlsx") {$out = "Excel tabulka";      }
	if (strtolower($extension) == "ppt") {$out = "Powerpoint prezentace";          }
	if (strtolower($extension) == "pptx") {$out = "Powerpoint prezentace";         }
	if (strtolower($extension) == "zip") {$out = "ZIP archiv";         }
	if (strtolower($extension) == "rar") {$out = "RAR archiv";         }
	if (strtolower($extension) == "exe") {$out = "Aplikace";  }
	if (strtolower($extension) == "srt") {$out = "Titulky";  }
        return $out;
    }
  
   static function getOneFile($id){
        $query = "SELECT * FROM tbFiles where id = $id";
        $data = mysqli_query($link, $query);
        $out = "";
        while ($zaznam = mysql_fetch_assoc($data)) {
            $out .=' 
                <div class="box file" data="'.$zaznam["id"].'">
                    <div class="icon" style="background-image: url('.iconFile($zaznam["link"], $zaznam["extension"]).')"></div>
                    <div class="data">
                        <div class="name">'.$zaznam["name"].'</div>
                    </div>
                    <div class="info">
                        <div class=type>'.self::humanType($zaznam["extension"]).'</div>
                        <div class=size>'.self::humanSize($zaznam["size"]).'</div>
                        <div class=icon>'.iconFile($zaznam["link"], $zaznam["extension"]).'</div>
                        <div class=date>'.date("j.n.Y H:i", (strtotime($zaznam["date"]))).'</div>
                        <div class=link>'.$zaznam["link"].'</div>
                    </div>
                </div> ';
        }
        return $out;
    }
   static function del($id){
        $query = "SELECT * FROM tbFiles where id = $id";
        $data = mysqli_query($link, $query);
        $out = "";
        while ($zaznam = mysql_fetch_assoc($data)) {
            unlink("../../".$zaznam["link"]);
        };
    }
}
