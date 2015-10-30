<?php

class Application_Model_Emoticon extends Zend_Db_Table_Abstract 
{
protected $_name = "emoticons";
function listEmoticons() {
        return $this->fetchAll()->toArray();
    }

}

