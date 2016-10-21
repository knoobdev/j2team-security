<?php

namespace J2TeaM\Library;

class Db {
    protected $_db;

    protected static $_instances = array();

    public static function instance($name = 'sqlite3'){
        if(empty(self::$_instances[$name])){
            self::$_instances[$name] = new self($name);
        }
        return self::$_instances[$name];
    }

    public function __construct($name) {
        $this->_db = new \SQLite3(sqlite3_file($name));
    }

    public function query($query){
        $res = $this->_db->query($query);
        if (!$res){
            throw new \Exception($this->_db->lastErrorMsg());
        }
        return $res;
    }

    public function insert($query) {
        return $this->query($query);
    }

    public function update($query) {
        return $this->query($query);
    }

    public function delete($query) {
        return $this->query($query);
    }

    public function __destruct() {
        $this->_db->close();
    }
}
