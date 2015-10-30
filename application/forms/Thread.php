<?php

class Application_Form_Thread extends Zend_Form {

    public function init() {
        $this->setMethod("post");
        $title = new Zend_Form_Element_Text("title");
        $title->setAttrib("placeholder", "Title");
        $title->setAttrib("class", "form-control");
        $title->setLabel("Title: ");
        $title->setRequired();

        $body = new Zend_Form_Element_Textarea("body");
        $body->setAttrib("class", "form-control");
        $body->setAttrib("placeholder", "Write body here....");
        $body->setLabel("Body: ");
        $body->setAttrib("rows", "5");
        $body->setAttrib("cols", "55");
        $body->setRequired();
        
        $picture = new Zend_Form_Element_File('picture');
        $picture->setLabel("Picture:");
        $picture->setRequired();
        $picture->setDestination('/var/www/html/RNR/public/images/thread');

     $stick=new Zend_Form_Element_Radio("stick");
        $stick->setLabel("Sticky:");
        $stick->addMultiOption("on", "on");
        $stick->addMultiOption("off", "off");
        $stick->setRequired();


        $id = new Zend_Form_Element_Hidden("id");
        $submit = new Zend_Form_Element_Submit("Submit");
        $submit->setAttrib("class", "btn btn-primary");
                $submit->setLabel("Save");


        $rest = new Zend_Form_Element_Submit('Rest');
        $rest->setAttrib("class","btn btn-info");

        $this->addElements(array($id, $title, $body,$picture,$stick, $submit, $rest));
    }

}
