<?php
App::uses('AppModel', 'Model');
/**
 * Booster Model
 *
 * @property Users $Users
 */
class Booster extends AppModel {

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
		)
	);
}
