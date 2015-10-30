<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract {
    protected $_name = "replay";
    function addComment($data) {
        $row = $this->createRow();
        $row->body = $data['body'];
        $row->threadId = $data['threadId'];
        $row->userId =$data['userId'] ;
        return $row->save();
    }

    function listComments($threadId) {
        return $this->fetchAll("threadId=" . $threadId)->toArray();
    }

    function deleteComment($id) {
        return $this->delete("id=$id");
    }

    function getCommentById($id) {
        return $this->find($id)->toArray();
    }

    function editComment($id,$body) {
       $this->update(array("body"=> $body) , "id=" . $id);
       return $this->fetchAll()->toArray();
    }
    
    function getCommentByBody($body){
        
        
    }
}
