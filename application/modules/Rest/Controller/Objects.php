<?php

class Rest_Controller_Objects extends Glitch_Controller_Action_Rest
{

    public function indexAction()
    {
        // action body
    }

    public function collectionGetAction()
    {
//        $this->getResponse()->setSubResponseRenderer('test');
        return array('data' => array('foo' => array('bar' => array('foobar', 'rulez!'))));
    }
}
