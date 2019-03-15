<?php

class Contact_IndexController
    extends eApp_Controller_Action_Default
{
    public function indexAction()
    {
        if ($this->getRequest()->isPost()) :

            $contact = $this->_getParam("contact", array());

            if (empty($contact['email']) || empty($contact['message'])) {
                $this->addError($this->view->translate("error_missing_mandatory_fields"));
                $this->_redirect("/contact");
            }

            $email   = $contact['email'];
            $message = $contact['message'];
            $name    = "";
            $subject = "";

            if (!empty($contact['name']))
                $name = $contact['name'];

            if (!empty($contact['subject']))
                $subject = $contact['subject'];

            try {
                $msg = new eApp_Model_Contact;
                $msg->email   = $email;
                $msg->message = $message;
                $msg->name    = $name;
                $msg->subject = $subject;
                $msg->insert();

                $this->addMessage($this->view->translate("message_contact_sent"));
                $this->_redirect("/");
            }
            catch (Exception $e) {
                die($e->getMessage());
            }

        endif;
    }

    public function accessAction()
    {
    }
}
