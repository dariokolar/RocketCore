<?php

/*
 *	TinyRocket 3.0
 *	Uploader Assistent
 * 
 *	Avaible settings in config file
 */

class fileupload{
    public $link = "";
    public $datum = "";
    public $type = "";
    public $id = "";
    public $size = "";
    public $icon = "";
    public $zmensoval = "";
    public $error = false;


    public function __construct(){
        global $rocket;


        $allowedExts = $rocket["allowedExtensions"];
        $fotoExts = $rocket["fotoExtensions"];


        $temp = explode(".", $_FILES["file"]["name"]);
        $jmeno = $_FILES["file"]["name"];
        $extension = strtolower(end($temp));

        if (in_array($extension, $allowedExts)) {

            if(file_exists("../../files/".str_replace(".".$extension, "", rewrite::getRewrite($jmeno)). "." . $extension)){
                $name = str_replace(".".$extension, "", rewrite::getRewrite($jmeno))."-".md5(microtime()). "." . $extension;
            }else{
                $name = str_replace(".".$extension, "", rewrite::getRewrite($jmeno)). "." . $extension;
            }

            $zmensoval = "ne";
            move_uploaded_file($_FILES["file"]["tmp_name"], "../../files/".$name);

            if($extension == "png" && $rocket["convertPNGtoJPG"] == true){
                $images = "../../files/".$name;
                $image = imagecreatefrompng($images);
                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                imagealphablending($bg, TRUE);
                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                imagedestroy($image);
                $quality = 50;
                imagejpeg($bg, $images . ".jpg", $quality);
                imagedestroy($bg);
                $extension = "jpg";
                $name = $name.".jpg";
            }

            if($extension == "jpg" or $extension == "jpeg") {

                $exif = sql::real_escape_string(json_encode(exif_read_data("../../files/".$name, 'IFD0')));
                $new_image = $name;
                $images = "../../files/".$name;



                $width=$rocket["bigSize"];
                $size=GetimageSize($images);
                $height=round($width*$size[1]/$size[0]);
                $images_orig = ImageCreateFromJPEG($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                ImageJPEG($images_fin,"../../files/big-".$name);
                ImageDestroy($images_orig);
                ImageDestroy($images_fin);


                if ($_POST["addData"]=="noresize"){
                    $width=$rocket["fullSize"];
                    $size=GetimageSize($images);
                    $height=round($width*$size[1]/$size[0]);
                    $images_orig = ImageCreateFromJPEG($images);
                    $photoX = ImagesX($images_orig);
                    $photoY = ImagesY($images_orig);
                    $images_fin = ImageCreateTrueColor($width, $height);
                    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                    ImageJPEG($images_fin,"../../files/".$name);
                    ImageDestroy($images_orig);
                    ImageDestroy($images_fin);
                }

                $width=$rocket["fullSize"];
                $size=GetimageSize($images);
                $height=round($width*$size[1]/$size[0]);
                $images_orig = ImageCreateFromJPEG($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                ImageJPEG($images_fin,"../../files/wm-".$name);
                ImageDestroy($images_orig);
                ImageDestroy($images_fin);

                /*
                 * Vodoznak
                 */
                if ($rocket["watermarkForFullSize"]){
                    $input_name = "../../files/wm-".$name;
                    $stamp = imagecreatefrompng($rocket["watermarkFile"]); //Input the location of your Watermark Here.

                    if ($extension == "png")
                        $im = imagecreatefrompng($input_name);
                    if ($extension == "jpg" || $extn == "jpeg")
                        $im = imagecreatefromjpeg($input_name);
                    if ($extension == "gif")
                        $im = imagecreatefromgif($input_name);

                    // Set the margins for the stamp and get the height/width of the stamp image
                    $marge_right = 1;
                    $marge_bottom = 5;
                    $sx = imagesx($stamp);
                    $sy = imagesy($stamp);

                    // Copy the stamp image onto our photo using the margin offsets and the photo
                    // width to calculate positioning of the stamp.
                    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

                    // Output and free memory

                    imagejpeg($im,$input_name); //This part overwrites the image.
                    imagedestroy($im);


                }

                $width=$rocket["smallSize"]; //*** Fix Width & Heigh (Autu caculate) ***//
                $size=GetimageSize($images);
                $height=round($width*$size[1]/$size[0]);
                $images_orig = ImageCreateFromJPEG($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                ImageJPEG($images_fin,"../../files/small-".$name);
                ImageDestroy($images_orig);
                ImageDestroy($images_fin);

                $width=$rocket["mediumSize"] ; //*** Fix Width & Heigh (Autu caculate) ***//
                $size=GetimageSize($images);
                $height=round($width*$size[1]/$size[0]);
                $images_orig = ImageCreateFromJPEG($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                ImageJPEG($images_fin,"../../files/medium-".$name);
                ImageDestroy($images_orig);
                ImageDestroy($images_fin);
                $zmensoval = "ano";

            }else{
                $zmensoval = "ne";
            }



            if (in_array($extension, $fotoExts)){
                $templink =  "../../files/" . $name;
            }else{
                $templink =  "img/no.png";
            }

            $typ = "Neznámý";
            if (strtolower($extension) == "gif") {$typ = "Obrazek GIF";	    }
            if (strtolower($extension) == "jpeg") {$typ = "Obrazek JPG";	    }
            if (strtolower($extension) == "jpg") {$typ = "Obrazek JPG";	    }
            if (strtolower($extension) == "png") {$typ = "Obrazek PNG";	    }
            if (strtolower($extension) == "pdf") {$typ = "Dokument PDF";	    $templink =  "img/pdf.png";		}
            if (strtolower($extension) == "doc") {$typ = "Dokument";	    $templink =  "img/word.png";		}
            if (strtolower($extension) == "docx") {$typ = "Dokument";	    $templink =  "img/word.png";		}
            if (strtolower($extension) == "xls") {$typ = "Tabulka Excel";	    $templink =  "img/excel.png";		}
            if (strtolower($extension) == "csv") {$typ = "Tabulka Excel";	    $templink =  "img/excel.png";		}
            if (strtolower($extension) == "xlsx") {$typ = "Tabulka Excel";	    $templink =  "img/excel.png";		}
            if (strtolower($extension) == "ppt") {$typ = "Prezentace";	    $templink =  "img/powerpoint.png";	}
            if (strtolower($extension) == "pptx") {$typ = "Prezentace";	    $templink =  "img/powerpoint.png";	}
            if (strtolower($extension) == "zip") {$typ = "Balicek ZIP";	    $templink =  "img/zip.png";		}
            if (strtolower($extension) == "rar") {$typ = "Balicek RAR";	    $templink =  "img/zip.png";		}
            if (strtolower($extension) == "exe") {$typ = "Spustitelny soubor";  $templink =  "img/app.png";		}

            $size = files::humanSize($_FILES["file"]["size"]);

            $datum = date("j.n.Y H:i", (strtotime("now")));
            $query = "INSERT INTO tbFiles SET
                                user = {$_SESSION["id"]},
                                name = '".$jmeno."',
                                link = '/files/".$name."',
                                exif = '$exif',
                                extension= '".strtolower($extension)."',
                                size='".$_FILES["file"]["size"]."',
                                type='$typ',
                                hidden = 0,
                                date = NOW(),
                                isDel = 0";



            $temp = new sql($query);
            $id = $temp->inserted();


            $this->name = $name;
            $this->datum = $datum;
            $this->typ = $typ;
            $this->id = $id;
            $this->size = $size;
            $this->icon = $name;
            $this->zmensoval = $zmensoval;


        }else{
            $this->error = false;
        }

    }

    public function getResponse(){
        $response = new StdClass;

        $response->link = "/files/".$this->name;
        $response->datum = $this->datum;
        $response->type = $this->typ;
        $response->id = $this->id;
        $response->size = $this->size;
        $response->icon = photo("/files/".$this->name, "small");
        $response->zmensoval = $this->zmensoval;

        //  echo stripslashes(json_encode($response));
        return $response;
    }
}

