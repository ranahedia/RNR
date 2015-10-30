<?php

class Application_Model_Thread extends Zend_Db_Table_Abstract {

    protected $_name = "thread";

    function addThread($data) {
        $userInfo = Zend_Auth::getInstance()->getStorage()->read();
        $row = $this->createRow();
        $row->userId = $userInfo->id;
        $row->toCategoryId = $data['toCategoryId'];
        $row->title = $data['title'];
        $row->stick = $data['stick'];
        $row->picture = $data['picture'];
        $row->body = $data['body'];
        return $row->save();
    }



    function listThreads($toCategoryId) {
        return $this->fetchAll("toCategoryId=$toCategoryId")->toArray();
    }

    function deleteThread($id) {
        return $this->delete("id=$id");
    }

    function getThreadById($toCategoryId,$id) {
        //return $this->find($id)->toArray();
      return  $this->fetchAll(array("toCategoryId=$toCategoryId","id=$id"))->toArray();
    }



}
