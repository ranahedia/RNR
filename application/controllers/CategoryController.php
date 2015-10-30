<?php

class CategoryController extends Zend_Controller_Action
{


    public function init() {

    }

    public function indexAction() {
    }

    public function addAction() {
        $form = new Application_Form_Category();
        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $info = $form->getValues();
                $category_model = new Application_Model_Category();
                $category_model->addCategory($info);
                $this->redirect("category/list");
            }
        }
        $this->view->form = $form;
    }

    public function listAction() {
        $category_model = new Application_Model_Category();
        $this->view->categories = $category_model->listCategory();
        $form = new Application_Form_Category();
        $this->view->form = $form;
    }

    public function deleteAction() {
        $id = $this->_request->getParam("id");
        $category_model = new Application_Model_Category();
        $category_model->deleteCategory($id);
        $this->redirect("category/list");
    }

    public function editAction() {
        $id = $this->_request->getParam("id");
        $form = new Application_Form_Category();
        $form->getElement("picture")->setRequired(false);
        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $info = $form->getValues();
                $category_model = new Application_Model_Category();
                $category_model->editCategory($info);
                $this->redirect("category/list");
            }
        }
        if (!empty($id)) {
            $category_model = new Application_Model_Category();
            $cat = $category_model->getCategoryById($id);
            $form->populate($cat[0]);
        } 
        $this->view->form = $form;
        $this->render('add');
    }
}

