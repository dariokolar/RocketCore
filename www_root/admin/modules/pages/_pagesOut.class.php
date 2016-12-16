<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class pageout extends pages{

    public $name;
    public $text;
    public $id;

    public function __construct($id = ""){
        if(!empty($id)) {
            $this->id = $id;
            $this->byid();
        }

    }
    public function byid($id = ""){
        if(!empty($id)) {
            $this->id = $id;
        }

        $query = new sql("SELECT * FROM tbPages WHERE id = '{$this->id}' ");
        foreach ($query->all() as $zaznam) {
            $this->name = $zaznam["name"];
            $this->text = $zaznam["text"];
        }
    }

    public function byrew($rew = ""){

        $query = new sql("SELECT * FROM tbPages WHERE rew = '{$rew}' ");
        foreach ($query->all() as $zaznam) {
            $this->id = $zaznam["id"];
            $this->name = $zaznam["name"];
            $this->text = $zaznam["text"];
        }
    }

   
}
