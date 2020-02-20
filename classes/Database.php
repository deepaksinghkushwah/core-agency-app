<?php
namespace classes;
class Database {
    private $DB_SERVER;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    public $link;
    public function __construct($server, $user, $pass, $db) {
        $this->DB_SERVER = $server;
        $this->DB_USER = $user;
        $this->DB_NAME = $db;
        $this->DB_PASS = $pass;
        $this->link = new \mysqli($this->DB_SERVER, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
        if($this->link->connect_errno){
            throw new Exception($this->link->connect_error);
        }
        return $this->link;
    }
    
    public function Query($sql){
        return $this->link->query($sql);        
    }
    
    public function CloseDB(){
        $this->link->close();
    }
}

