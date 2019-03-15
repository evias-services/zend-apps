<?php

class backOffice_NewsController
    extends eApp_Controller_Action_BackOffice
{
    public function indexAction()
    {
    	$objects = eApp_Model_News::getList(array(
            "order" => "date_news DESC"));

    	$this->view->objects = $objects;
    }

    public function editAction()
    {
    	$oid = $this->_getParam("oid");

    	try {
    		$object = eApp_Model_News::loadById($oid);
    	}
    	catch (Exception $e) {
    		$object = new eApp_Model_News;
    	}

        if ($this->getRequest()->isPost()) :
            /* validate input and save object. */
            $data = $this->_getParam("object", array());

            try {
                if (empty($data['date_news']))
                    throw new Exception("Missing Data!");

                $date = explode('/', $data['date_news']);
                if (count($date) != 3)
                    throw new Exception("Wrong Dates!");

                $date_news = "{$date[2]}-{$date[1]}-{$date[0]}";

                $object->title     = $data['title'];
                $object->date_news = $date_news;
                $object->save();

                $this->addMessage($this->view->translate("save_done"));
                $this->_redirect("/back-office/news");
            }
            catch (Exception $e) {
                $this->addError(sprintf($this->view->translate("error_save_occured"), $e->getMessage()));
                $this->_redirect("/back-office/news");
            }
        endif;

    	$this->view->object = $object;
    }

    public function deleteAction()
    {
        $this->getHelper("viewRenderer")
             ->setNoRender(true);

        $this->view->layout()->disableLayout();

        $oid = $this->_getParam("oid");
        try {
            $object = eApp_Model_News::loadById($oid);

            $wrapper = new eApp_Model_News;
            $wrapper->delete("id_news = " . $object->id_news);
        }
        catch (Exception $e) {
            echo "Error: '{$e->getMessage()}'";
        }
        exit;
    }
}
