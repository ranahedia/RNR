<?php

class Application_Form_Category extends Zend_Form {

    public function init() {

        $form = new Zend_Form("form");
        $form->setMethod('post');


        $title = new Zend_Form_Element_Text("title");
        $title->setLabel("Title:");
        $title->setAttrib("placeholder", "Title");
        $title->setAttrib("class", "form-control");
        $title->setRequired();
        $picture = new Zend_Form_Element_File("picture");
        $picture->setLabel("Picture:");
        $picture->setDestination('/var/www/html/RNR/public/images/category');
        $picture->setRequired();        
        $id = new Zend_Form_Element_Hidden("id");
        $submit = new Zend_Form_Element_Submit("Submit");
                $submit->setLabel("Save");

        $submit->setAttrib("class", "btn btn-primary");
        $rest = new Zend_Form_Element_Reset('Reset');
        $rest->setAttrib("class", "btn btn-info");

        $this->addElements(array($title, $picture, $submit, $rest,$id));
    }

}
