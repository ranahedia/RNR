<?php

class ThreadController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function addAction() {
        $toCategoryId = $this->_request->getParam("toCategoryId");
        $form = new Application_Form_Thread();

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $thread_info = $form->getValues();
                $thread_info['toCategoryId'] = $toCategoryId;
                $thread_model = new Application_Model_Thread();
                $thread_model->addThread($thread_info);
                $this->redirect("thread/list/toCategoryId/" . $toCategoryId);
            }
        }
        $this->view->form = $form;
    }

    public function listAction() {
        $toCategoryId = $this->_request->getParam("toCategoryId");
        if ($toCategoryId != NULL) {
            $thread_model = new Application_Model_Thread();
            $tocategory_model = new Application_Model_Tocategory();
            $info = $tocategory_model->getTocategoryById($toCategoryId);
            $threads = $thread_model->listThreads($toCategoryId);
            $sticky = array();
            $unsticky = array();
            if (count($threads) != 0) {
                for ($i = 0; $i < count($threads); $i++) {
                    if ($threads[$i]['stick'] == 'on') {
                        $sticky[] = $threads[$i];
                    } else {
                        $unsticky[] = $threads[$i];
                    }
                }
                if (count($sticky) != 0) {
                    $this->view->sticky = $sticky;
                }
                if (count($unsticky) != 0) {
                    $this->view->unsticky = $unsticky;
                }
                
            } 
         
            $this->view->lock = $info[0]['lock'];
            $this->view->toCategoryId = $toCategoryId;            
        }
    }

    public function displayAction() {
        $id = $this->_request->getParam("id");
        $thread_model = new Application_Model_Thread();
        $toCategoryId = $this->_request->getParam("toCategoryId");
        if ($toCategoryId != NULL && $id != NULL) {
            $thread = $thread_model->getThreadById($toCategoryId, $id);
            if (count($thread) != 0) {
                $user_model = new Application_Model_User();
                $user = $user_model->getUserById($thread[0]['userId']);
                $this->view->user = $user[0]['userName'];
                $this->view->image = $user[0]['signature'];
                $this->view->id = $user[0]['id'];

                $emoticon_model = new Application_Model_Emoticon();
                $emoticons = $emoticon_model->listEmoticons();

                $comment_model = new Application_Model_Comment();
                $comments = $comment_model->listComments($thread[0]['id']);
                if (count($comments) != 0) {
                    $user_model = new Application_Model_User();
                    for ($i = 0; $i < count($comments); $i++) {
                        $user = $user_model->getUserById($comments[$i]['userId']);
                        $names[] = $user[0]['userName'];
                        $images[] = $user[0]['profilePicture'];
                        $ids[] = $user[0]['id'];
                    }
                    $this->view->comments = $comments;
                    $this->view->names = $names;
                    $this->view->images = $images;
                    $this->view->ids = $ids;
                    $this->view->emoticons = $emoticons;
                }
                $this->view->thread = $thread[0];
                $this->view->toCategoryId = $toCategoryId;
//                $this->view->lock = $thread[0]['lock'];
            }
        }
    }

    public function deleteAction() {
        $id = $this->_request->getParam("id");
        $toCategoryId = $this->_request->getParam("toCategoryId");
        if (!empty($id)) {
            $thread_model = new Application_Model_Thread();
            $thread_model->deleteThread($id);
        }
        $this->redirect("thread/list/toCategoryId/" . $toCategoryId);
    }
}
