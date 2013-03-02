<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'pic')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

}
