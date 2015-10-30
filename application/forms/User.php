<?php

class Application_Form_User extends Zend_Form {

    public function init() {
        $this->setMethod("post");
        $this->setAttrib("class", "form-horizontal");
        $username = new Zend_Form_Element_Text("userName");
        $username->setLabel("User Name:");
        $username->setRequired();
        $username->setAttrib("placeholder", "User name");
        $username->setAttrib("class", "form-control");
        $username->addFilter(new Zend_Filter_StripTags);

        $email = new Zend_Form_Element_Text("email");
        $email->setRequired()
                ->setLabel("Email:")
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addValidator(new Zend_Validate_Db_NoRecordExists(array(
                    'table' => 'user',
                    'field' => 'email'
                        )
        ));
        $email->setAttrib("placeholder", "Email");
        $email->setAttrib("class", "form-control");


        $password = new Zend_Form_Element_Password("password");
        $password->setRequired()
                ->setLabel("Password:");
        $password->setAttrib("placeholder", "Password");
        $password->setAttrib("class", "form-control");


        $country = new Zend_Form_Element_Select('country');
        $country->setMultiOptions(array(
            'Egypt' => 'Egypt',
            'Kuwait' => 'Kuwait',
            'Canada' => 'Canada'));
        $country->setLabel("Country:");
        $country->setAttrib("class", "form-control");

        $gender = new Zend_Form_Element_Radio('gender');
        $gender->setRequired(true)->setLabel("Gender:")->addMultiOptions(array(
                    'male' => 'Male',
                    'female' => 'Female'
                ))
                ->setSeparator("     ");

        $profilePicture = new Zend_Form_Element_File('profilePicture');
        $profilePicture->setLabel("ProfilePicture:");
        $profilePicture->setDestination('/var/www/html/RNR/public/images/user/profilePicture');

        $signature = new Zend_Form_Element_File('signature');
        $signature->setLabel("Signature:");
        $signature->setDestination('/var/www/html/RNR/public/images/user/signature');

        $id = new Zend_Form_Element_Hidden("id");
        $submit = new Zend_Form_Element_Submit("Submit");
        $submit->setAttrib("class", "btn btn-primary");
                $submit->setLabel("Save");

        $rest = new Zend_Form_Element_Reset('Reset');
        $rest->setAttrib("class", "btn btn-info");
        $this->addElements(array($id, $username, $email, $password, $country, $gender, $profilePicture, $signature, $submit, $rest));



        /* Form Elements & Other Definitions Here ... */
    }

}
