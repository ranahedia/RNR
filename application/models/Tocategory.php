<?php

class Application_Model_Tocategory extends Zend_Db_Table_Abstract {

    protected $_name = "toCategory";

    function getTocategoryById($id) {
        return $this->find($id)->toArray();
    }

    function lockTocategory($data) {
        if ($data[0]['lock'] == 'off') {
            $data[0]['lock'] = 'on';
            return $this->update($data[0], "id=" . $data[0]['id']);
        } else {
            $data[0]['lock'] = 'off';
            return $this->update($data[0], "id=" . $data[0]['id']);
        }
    }

    function addtoCategory($data, $id) {
        $row = $this->createRow();
        $row->title = $data['title'];
        $row->toCategoryId = $data['toCategoryId'];
        $row->picture = $data['picture'];
        return $row->save();
    }

    function listtoCategory($id) {
        return $this->fetchAll("toCategoryId=$id")->toArray();
    }

    function deleteTocategory($id) {
        return $this->delete("id=$id");
    }

    function edittoCategory($data) {
        if (empty($data['picture'])) {
            unset($data['picture']);
        }
        $this->update($data, "id=" . $data['id']);
        return $this->fetchAll()->toArray();
    }

}
