<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {
	public $name = 'User';
/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'dev';
	
	public $hasOne=array('Parrain'=>	array('className' => 'Affiliate',
      			'foreignKey' => 'filleul_id'));
	public $hasMany=array('Filleuls'=>	array('className' => 'Affiliate',
			'foreignKey' => 'parrain_id'),'Rechargement' => array('className' => 'Rechargement', 'foreignKey'=>'users_id'));
      				
      			
	

}
