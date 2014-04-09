<?php

class OrganizationsController extends AppController {
    public $components = array('RequestHandler');

    public function index() {
        $organizations = $this->Organization->find('all');
        $this->set(array(
            'organizations' => $organizations,
            '_serialize' => array('organizations')
        ));
    }
}