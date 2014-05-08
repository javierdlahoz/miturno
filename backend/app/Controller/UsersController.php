<?php
App::uses('Security', 'Utility');

class UsersController extends AppController {
    var $components = array('RequestHandler');

    public function index() {
        $users = $this->User->find('all');
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        ));
    }

    public function getData(){
        $user = $this->Session->read('User');
        if(!empty($user)){
            $this->set(array(
                'response' => array("user" => $user),
                '_serialize' => array('response')
                ));
        }
        else{
            $this->set(array(
                'response' => array("user" => false),
                '_serialize' => array('response')
                ));
        }
    }

    public function validateEmail(){
        $data = $this->request->input('json_decode');
        $email = $this->User->find('first', array('conditions' => array('email' => $data->email)));
        if(count($email)>0)
            $status = false;
        else
            $status = true;

        $this->set(array(
            'response' => array("status" => $status),
            '_serialize' => array('response')
        ));
    }

    public function save(){
    	$status = false;
        $data = $this->request->input('json_decode');
    	$hspwd = Security::hash($data->password, null, true);
    	$this->User->set(
    		array('firstName' => $data->firstName,
    			  'lastName' => $data->lastName,
    			  'email' => $data->email,
                  'username' => $data->email,
    			  'password' => $hspwd)
    		);
    	try{
    		$this->User->save();
    		$this->Session->write("User", $this->User);
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

    public function login(){
    	$status = false;
    	$data = $this->request->input('json_decode');
    	$user = $this->User->find('all', 
    		array('conditions'=> array('email' => $data->email)));
      
        if(!empty($user)){
            $user = $user[0]['User'];
        	
        	if(Security::hash($data->password,null,true) == $user['password']){
        		$this->Session->write('User', $user);
        		$status = true;
        	}
            else
                $status = "wrong";
        }
        else
            $status = false;

    	$this->set(array(
            'response' => array("status" => $status),
            '_serialize' => array('response')
        ));
    }

    public function isLoggedIn(){
    	$tmp = $this->Session->read('User');
    	$status = false;
    	if(!empty($tmp))
    		$status = true;

    	$this->set(array(
            'response' => array("status" => $status),
            '_serialize' => array('response')
        ));	
    }

    public function logout(){
    	try{
    		$this->Session->destroy();
    		$status = true;
    	}
    	catch(Exception $ex){
    		$status = false;
    	}
    	$this->set(array(
            'response' => array("status" => $status),
            '_serialize' => array('response')
        ));	
    }

    public function validatePassword()
    {
        $status = false;
        $tmp = $this->Session->read('User.password');
        $data = $this->request->input('json_decode');
        $hspwd = Security::hash($data->password, null, true);
        if($tmp==$hspwd)
            $status = true;
        $this->set(array(
            'response' => array("status" => $status),
            '_serialize' => array('response')
        ));    
    }
}