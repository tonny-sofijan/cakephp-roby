<?php
App::uses('AppModel', 'Model');
/**
 * Bet Model
 *
 * @property BetDetail $BetDetail
 */
class Bet extends AppModel {

	public function between2($check, $cmp1, $cmp2) {
		$value = array_values($check);
        $value = $value[0];
        if (($value >= $cmp1) AND ($value <= $cmp2)) {
			return true;
		} else {
			return false;
		}
	}
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'home' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'away' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'handicap1' => array(
            'between' => array(
				'rule' => array('between2', 0.25, 9),
				'message' => 'Hanya boleh antara 1/4 (0.25) dan 9',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'handicap2' => array(
			'between' => array(
				'rule' => array('between2', 0.25, 9),
				'message' => 'Hanya boleh antara 1/4 (0.25) dan 9',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'loss1' => array(
			'between' => array(
				'rule' => array('between2', 5, 100),
				'message' => 'Hanya boleh antara 5 dan 30',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'loss2' => array(
			'between' => array(
				'rule' => array('between2', 5, 100),
				'message' => 'Hanya boleh antara 5 dan 30',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'over_under' => array(
			'between' => array(
				'rule' => array('between2', 0.25, 9),
				'message' => 'Hanya boleh antara 1/4 (0.25) dan 9',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ou_over_loss' => array(
			'between' => array(
				'rule' => array('between2', 5, 100),
				'message' => 'Hanya boleh antara 5 dan 30',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ou_under_loss' => array(
			'between' => array(
				'rule' => array('between2', 5, 100),
				'message' => 'Hanya boleh antara 5 dan 30',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Home' => array(
			'className' => 'Club',
			'foreignKey' => 'home',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Away' => array(
			'className' => 'Club',
			'foreignKey' => 'away',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'BetDetail' => array(
			'className' => 'BetDetail',
			'foreignKey' => 'bet_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
