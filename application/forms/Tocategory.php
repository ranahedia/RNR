<?php

class Application_Form_Tocategory extends Zend_Form {

    public function init() {

        $form = new Zend_Form("form");
        $form->setMethod('post');
        $title = new Zend_Form_Element_Text("title");
        $title->setLabel("Title:");
        $title->setAttrib("placeholder", "Title");
        $title->setAttrib("class", "form-control");
        $title->setRequired();
        $picture = new Zend_Form_Element_File("picture");
        $picture->setLabel("Image:");
        $picture->setDestination('/var/www/html/RNR/public/images/tocategory');
        $picture->setRequired();

        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setAttrib("class", "btn btn-primary");
        $submit->setLabel("Save");
        $submit->setRequired();
        
        
        $rest = new Zend_Form_Element_Reset('Reset');
        $rest->setAttrib("class", "btn btn-info");

        $id = new Zend_Form_Element_Hidden("id");


        $this->addElements(array($title, $picture, $submit,$rest, $id));
    }

}
?>








