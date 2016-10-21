<?php

namespace J2TeaM\Library;

use J2TeaM\Library\Db;

abstract class Model {
    protected $_db;

    public function __construct($name = 'j2team_security'){
        $this->_db = Db::instance($name);
    }

    protected function _get_db(){
        return $this->_db;
    }
}
