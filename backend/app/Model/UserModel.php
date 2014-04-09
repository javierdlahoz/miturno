<?php

class User extends AppModel {

	public function getName(){
		return $this->data[$this->alias]['firstName']." ".$this->data[$this->alias]['lastName'];
	}

}