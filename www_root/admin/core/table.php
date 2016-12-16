<?php
/*
 *    TinyRocket
 *    DB Controller Verze 1.0
 * 
 *    www.tinyrocket.cz
 * 
 *   
 *    // EXAMPLE
 *	$myNewTable = new table("tbMyNewTable");
 *	$myNewTable->column("id", "int", "11", false, false, true, true, false);
 *	...
 * 
 */


class table {
    protected $link;
    protected $name;
    protected $exist = false;
    protected $allowedType = array("varchar", "datetime", "int", "date", "longtext");
    protected $notLegthTypes = array("datetime", "date", "longtext");

    public function __construct($name){
        global $link;
        $this->link = $link;
	if($this->mainLoad()){
	    return false;
	}

	$this->name = $name;
	if(mysqli_num_rows(mysqli_query($this->link, "SHOW TABLES LIKE '".$name."'"))==1){
	    $this->exist = true;
	}
    }
    private function mainLoad(){
	global $mainLoad;
	if ($mainLoad){
	    return false;
	}
	return true;
    }
    public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
        global $rocket;

	if($this->mainLoad()){
	    return false;
	}
	$_name = valid($name);
	$_length = $length;

	if (in_array($type, $this->allowedType)) {
	    $_type = valid($type);
	}else{
	    $_type = "int";
	}
	if (in_array($type, $this->notLegthTypes)){
	    $_type = " $_type ";
	}else{

	    $_type = " $type($_length) ";
	}
	if ($fulltext){
	    $_fulltext = ", FULLTEXT KEY `$_name` (`$_name`) ";
	}		
	if ($key){
	    $_key = ", PRIMARY  KEY `$_name` (`$_name`) ";
	}
	if ($autoIncrement){
	    $_autoIncrement = " auto_increment ";
	}else{
	    $_autoIncrement = "";
	}
	if ($notNull){
	    $_notNull = " NOT NULL ";
	}else{
	    $_notNull = "" ;
	}
	if ($default != false){
	    $default = valid($default);
	    $_default = " default '$default' ";
	}
	
	if ($this->exist){

	    if(mysqli_num_rows(mysqli_query($this->link, "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '{$rocket["dbName"]}' AND TABLE_NAME = '{$this->name}' AND COLUMN_NAME = '$_name'"))==1){
		// sloupec již existuje
	    }else{
		$query = "ALTER TABLE `{$this->name}` ADD `$_name` $_type $_notNull $_autoIncrement $_default ;";

		mysqli_query($this->link, $query);
		if ($fulltext){
		    $query = "ALTER TABLE `{$this->name}` ADD FULLTEXT (`$_name`) ;";

		    mysqli_query($this->link, $query);
		}		
		if ($key){
		    $query = "ALTER TABLE `{$this->name}` ADD PRIMARY KEY (`$_name`) ;";

		    mysqli_query($this->link, $query);
		}
	    }
	}else{
	    $query = "CREATE TABLE `{$this->name}` ( `$_name` $_type $_notNull $_autoIncrement $_default $_key $_fulltext );";

	    mysqli_query($this->link, $query);
	    $this->exist = true;
	}
    }
}


