<?php
App::uses('AppModel', 'Model');
/**
 * Affiliate Model
 *
 * @property Parrain $Parrain
 * @property Filleul $Filleul
 */
class Affiliate extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'dev';
	public $hasOne = array(
			'Parrain' => array(
					'className' => 'User',
					'foreignKey' => 'id',
					'associationForeignKey' => 'parrain_id'
			));
	public $hasMany = array(
			'Filleul' => array(
					'className' => 'User',
					'foreignKey' => 'id',
					'associationForeignKey' => 'filleul_id'
			)
	);
	
	
}
