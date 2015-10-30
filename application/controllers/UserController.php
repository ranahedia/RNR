<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->view->msg = "index";
    }

    public function homeAction() {
        
    }

    public function addAction() {
        $form = new Application_Form_User();
        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $user_info = $form->getValues();
                $user_model = new Application_Model_User();
                $user_model->addUser($user_info);
            }
            if (Zend_Auth::getInstance()->getStorage()->read()->type == "admin") {
                $this->redirect("user/list");
            } else {
                $this->redirect("user/login");
            }
        }
        $this->view->form = $form;
    }

    public function listAction() {
        $user_model = new Application_Model_User();
        $this->view->users = $user_model->listUsers();
    }

    //ban user
    public function banAction() {
        $id = $this->_request->getParam("id");
        $ban = $this->_request->getParam("ban");
        if (!empty($id)) {
            $user_model = new Application_Model_User();
            $user = $user_model->getUserById($id);
            $user_model->banUser($user);
            $this->redirect("user/list");
        }
    }

    //type
    public function typeAction() {

        $id = $this->_request->getParam("id");
        $type = $this->_request->getParam("type");
        if (!empty($id)) {
            $user_model = new Application_Model_User();
            $user = $user_model->getUserById($id);
            $user_model->typeUser($user);
            $this->redirect("user/list");
        }
    }

    //delete user
    public function deleteAction() {
        $id = $this->_request->getParam("id");
        if (!empty($id)) {
            $user_model = new Application_Model_User();
            $user_model->deleteUser($id);
        }
        $this->redirect("user/list");
    }

    //edit action
    public function editAction() {
        $id = $this->_request->getParam("id");
        $form = new Application_Form_User();

        $userInfo = Zend_Auth::getInstance()->getStorage()->read();
        if ($userInfo->type == "regular") {
            $form->getElement("password")->setAttrib('disabled', 'disabled');
            $form->getElement("userName")->setAttrib('disabled', 'disabled');
            $form->getElement("email")->setAttrib('disabled', 'disabled');
            $form->getElement("email")->setRequired(false);
            $form->getElement("userName")->setRequired(false);
        }

        $userInfo = Zend_Auth::getInstance()->getStorage()->read();
        if ($userInfo->type == "admin") {
            $form->getElement("password")->setAttrib('disabled', 'disabled');
        }
        $form->getElement("password")->setRequired(false);
        $form->getElement("email")->removeValidator('Db_NoRecordExists');
        $form->getElement("profilePicture")->setRequired(false);
        $form->getElement("signature")->setRequired(false);

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $user_info = $form->getValues();
                $user_model = new Application_Model_User();
                $user_model->editUser($user_info);
                $userInfo = Zend_Auth::getInstance()->getStorage()->read();
                if ($userInfo->type == "admin") {
                    $this->redirect("user/list");
                } else {
                    $this->redirect("user/display");
                }
            }
        }

        if (!empty($id)) {
            $user_model = new Application_Model_User();
            $user = $user_model->getUserById($id);

            $form->populate($user[0]);
        }
        $this->view->form = $form;
        $this->render('add');
    }

    public function displayAction() {
        $id = $this->_request->getParam("id");
        if ($id != NULL) {
            $user_model = new Application_Model_User();
            $user = $user_model->getUserById($id);
            if (count($user) != 0) {
                $this->view->user = $user[0];
            }
        }
    }

    public function loginAction() {
        $user_form = new Application_Form_User();
        $user_form->removeElement("userName");
        $user_form->removeElement("gender");
        $user_form->removeElement("country");
        $user_form->removeElement("profilePicture");
        $user_form->removeElement("signature");
        $user_form->getElement("email")->removeValidator("Zend_Validate_Db_NoRecordExists");
        $this->view->form = $user_form;
        if ($this->_request->isPost()) {
            if ($user_form->isValid($this->getRequest()->getParams())) {
                $email = $user_form->getValue("email");
                $password = $user_form->getValue("password");
                $db = Zend_Db_Table::getDefaultAdapter();
                $auth = new Zend_Auth_Adapter_DbTable($db, 'user', 'email', 'password', 'ban');
                $auth->setIdentity($email);
                $auth->setCredential(md5($password));
                $row = $auth->authenticate();
                if ($row->isValid()) {
                    $autho = Zend_Auth::getInstance();
                    $storage = $autho->getStorage();
                    //info=$autho ->getidentity
                    $storage->write($auth->getResultRowObject(array("id", "userName", "type", "profilePicture", "signature", "ban")));
                    //info-arrow id
                    if ($storage->read()->ban == "off") {
                        $this->view->message = "valid user";
                        $info = $autho->getIdentity();
                        $this->redirect("user/home");
                    } else {
                        $this->view->message = "You are banned";
                    }
                } else {
                    $this->view->message = "not valid user";
                }
            }
        }
    }

    public function logoutAction() {
        $autho = Zend_Auth::getInstance();
        $autho->clearIdentity();
        $this->redirect("user/home");
    }

    public function locksystemAction() {
        $user_model = new Application_Model_User();
        $users = $user_model->listUsers();
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['type'] == "regular") {
                $user_model->locksystem($users[$i]);
            }
        }
        $this->redirect("user/list");
    }

}
