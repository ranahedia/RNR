

<?php

class TocategoryController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function lockAction() {
        $id = $this->_request->getParam("id");
        $categoryId = $this->_request->getParam("categoryId");

        $ban = $this->_request->getParam("lock");
        if (!empty($id)) {
            $to_model = new Application_Model_Tocategory ();
            $tocategory = $to_model->getTocategoryById($id);
            $to_model->lockTocategory($tocategory);
            $this->redirect("tocategory/list/categoryId/" . $categoryId);
        }
    }

    public function addAction() {
        $id = $this->_request->getParam("id");
        $form = new Application_Form_Tocategory();

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $info = $form->getValues();
                $category_model = new Application_Model_Tocategory ();
                $info['toCategoryId'] = $id;
                $category_model->addtoCategory($info);
                $this->redirect("tocategory/list/categoryId/" . $id);
            }
        }

        $this->view->form = $form;
    }

    public function listAction() {
        $categoryId = $this->_request->getParam("categoryId");
        if ($categoryId != NULL) {
            $category_model = new Application_Model_Tocategory ();

            $tocategories = $category_model->listtoCategory($categoryId);
            $this->view->tocategories = $tocategories;
                $form = new Application_Form_Tocategory();
                $this->view->form = $form;
                $this->view->id = $categoryId;
        }
    }

    public function deleteAction() {
        $id = $this->_request->getParam("id");
        $categoryId = $this->_request->getParam("categoryId");
        if (!empty($id)) {
            $to_model = new Application_Model_Tocategory ();
            $to_model->deleteTocategory($id);
        }
        $this->redirect("tocategory/list/categoryId/" . $categoryId);
    }

    public function editAction() {
        $id = $this->_request->getParam("id");
        $categoryId = $this->_request->getParam("categoryId");
        $form = new Application_Form_Tocategory();
        $form->getElement("picture")->setRequired(false);
        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $info = $form->getValues();
                $category_model = new Application_Model_Tocategory ();
                $category_model->edittoCategory($info);
                $this->redirect("tocategory/list/categoryId/" . $categoryId);
            }
        }
        if (!empty($id)) {
            $category_model = new Application_Model_Tocategory ();
            $cat = $category_model->getTocategoryById($id);
            $form->populate($cat[0]);
        }
        $this->view->form = $form;
        $this->render('add');
    }

}
