<?php
class Translator {

    private $language	= '2';
	private $lang 		= array();
	
	public function __construct($language){
		$this->language = dirname(__FILE__) .'/'.$language;
	}
	
    private function findString($str) {
	
        if (array_key_exists($str, $this->lang[$this->language])) {
	   
			return $this->lang[$this->language][$str];
        }else{
	
$filename = dirname(__FILE__) .'/'."{$_SESSION["lang"]}.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$handle = fopen($filename, "w");
fwrite($handle,"$contents
$str=$str");
fclose($handle);
	}
        return $str;
    }
    
	private function splitStrings($str) {
        return explode('=',trim($str));
    }
	
	public function __($str) {	
	    	
        if (!array_key_exists($this->language, $this->lang)) {
	    
            if (file_exists($this->language.'.txt')) {

                $strings = array_map(array($this,'splitStrings'),file($this->language.'.txt'));
                foreach ($strings as $k => $v) {
					$this->lang[$this->language][$v[0]] = $v[1];
                }
                return $this->findString($str);
            }else {
		
                return $str;
            }
        }
        else {
            return $this->findString($str);
        }
    }
}
?>