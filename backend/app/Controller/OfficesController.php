<?php
App::uses('Security', 'Utility');

class OfficesController extends AppController {
    var $components = array('RequestHandler');
    var $organizationId = 1;

    public function add(){
    	$status = false;
      $data = $this->request->input('json_decode');
    	$this->Office->set(
    		array('name' => $data->name,
    			  'address' => $data->address,
    			  'email' => $data->email,
            'phone' => $data->phone,
            'city' => $data->city,
            'organizationId' => $this->organizationId 
            )
    		);
    	try{
    		$this->Office->save();
        $status = true;
    	}
    	catch(Exception $ex){
    		$status = $ex; 
    	}

    	$this->set(array(
            'response' => array("status" => $status),
            '_serialize' => array('response')
        ));
    }

    public function index() {
        $offices = $this->Office->find('all');
        $this->set(array(
            'offices' => $offices,
            '_serialize' => array('offices')
        ));
    }
}