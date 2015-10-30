<?php

class CommentController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function addAction() {
        if ($this->_request->getParam("body")) {
            $comment_model = new Application_Model_Comment();
            $comment_info = ["body" => $this->_request->getParam("body"), "threadId" => $this->_request->getParam("threadId"), "userId" => Zend_Auth::getInstance()->getStorage()->read()->id];
            $id=$comment_model->addComment($comment_info);
            echo $id;
            exit();
        }
    }

    public function deleteAction() {
        if ($this->_request->getParam("id")) {
            $id = $this->_request->getParam("id");
            $comment_model = new Application_Model_Comment();
            $comment_model->deleteComment($id);
            exit();
        }
    }
    
     public function editAction() {
        if ($this->_request->getParam("id")) {
            $id = $this->_request->getParam("id");
            $body = $this->_request->getParam("body");
            $comment_model = new Application_Model_Comment();
            $comment_model->editComment($id,$body);
        }
    }

}
