<?php
App::uses('AppModel', 'Model');
/**
 * Rechargement Model
 *
 * @property Users $Users
 * @property Coupons $Coupons
 */
class Rechargement extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'dev';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Users' => array(
			'className' => 'Users',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Coupons' => array(
			'className' => 'Coupons',
			'foreignKey' => 'coupons_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
