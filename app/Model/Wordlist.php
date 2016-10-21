<?php

namespace J2TeaM\Model;
use J2TeaM\Library\Model;

class Wordlist extends Model {

    public function get_by_name($name) {
        $result = $this->_get_db()->query("SELECT ID,name,value FROM wordlists WHERE name = '".$name."';");
        $result = $result->fetchArray();
        return $result;
    }

    public function get_all() {
        $result = $this->_get_db()->query("SELECT ID,name,value FROM wordlists;");
        $data = [];
        while($row = $result->fetchArray()) {
            $data[] = [
                'ID' => $row['ID'],
                'NAME' => $row['name'],
                'VALUE' => !empty($row['value']) ? unserialize($row['value']) : []
            ];
        }
        return $data;
    }

    public function update($name,$value) {
        $result = $this->_get_db()->query("UPDATE wordlists SET value = '".$value."' WHERE name = '".$name."'");
        return ($result);
    }
}
