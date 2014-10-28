<?php
App::uses('AppController', 'Controller');

class AdminsController extends AppController {
	public $components = array('Paginator', 'Session');
	public $helpers = array('Session');
	
	
	public function login(){
		
		if($this->Session->check('AuthError')){
			$error=$this->Session->read('AuthError');
			$last= $error[count($error)-1];
			
			if(count($error)>=2 && date('U')-(5*60)<$last){
				return $this->redirect(
            array('controller' => 'admins', 'action' => 'exception')
        );
			}
		}
		if ($this->request->is('post')) {
			$admin = $this->Admin->find('first', array('conditions' => array('Admin.login' => $this->request->data['login'], 'Admin.pwd'=> md5($this->request->data['pwd']))));
			if(count($admin)==1){
				$this->Session->write('Admin',array('login' =>$admin['Admin']['login'] , 'k'=>md5($admin['Admin']['login']."simon")));
				if($this->Session->check('AuthError')){
					$this->Session->delete('AuthError');
				}
				$this->Session->setFlash('Connecté', 'alert-box', array('class'=>'alert-success'));
			}else{
				if($this->Session->check('AuthError')){
					$error = $this->Session->read('AuthError');
					$error[]=date('U');
					$this->Session->write('AuthError',$error);
				}else{
					$error[0]=date('U');
					$this->Session->write('AuthError',$error);
				}
			}
		}
	}
	
	public function addBonusMalus(){
		$error = false;
		
		if(isset($this->request->data['amount']) && isset($this->request->data['id_user']) && (isset($this->request->data['-'])||isset($this->request->data['+']) )){
			$this->loadModel('User');
			$user = $this->User->read('', $this->request->data['id_user']);
			if(isset($user['User']['id'])){
				
				if(isset($this->request->data['+'])){
					$sign="+";
					$total = $user['User']['credits']+$this->request->data['amount'];
				
				}else if(isset($this->request->data['-'])){
					$sign="-";
					$total = $user['User']['credits']-$this->request->data['amount'];
				}
				$this->User->id=$user['User']['id'];
				if($this->User->save(array('credits'=>$total))){
					
					$rechargementData = array('date'=>date("Y-m-d H:i:s"),
										'credit_value'=>$sign.$this->request->data['amount'],
										'credit_before'=>$user['User']['credits'],
							'credit_after'=>$total,
							'id_transaction'=>'manual malus bonus',
							'users_id'=>$this->request->data['id_user'], 'coupons_id'=>'');
					
					
					$this->loadModel('Rechargement');
					if($this->Rechargement->save($rechargementData)){
						
						
						
					}else{
						$error=true;
					}
				}
				
			}else{
				$error = true;
			}
			
			
		}else{
			$error = true;
		}
		
		
		if($error){
			$this->Session->setFlash('ERREUR', 'alert-box', array('class'=>'alert-danger'));
		}else{
			$this->Session->setFlash('Crédit ajouté avec succès', 'alert-box', array('class'=>'alert-success'));
		}
		
		return $this->redirect(
				array('controller' => 'admins', 'action' => 'detailuser',$this->request->data['id_user']));
	}
	
	public function menu(){
		
	}
	public function listUsers(){
		$this->loadModel('User');
		$users = $this->User->find('all');
		$this->set('users', $users);
	}
	public function detailUser($id=null){
		if($id == null){
			$this->Session->setFlash('ID manquant', 'alert-box', array('class'=>'alert-danger'));
			return $this->redirect(
					array('controller' => 'admins', 'action' => 'menu')
			);
		}else{
			$this->loadModel('User');
			$user = $this->User->read('', $id);
			if(empty($user)){
				$this->Session->setFlash('ID erroné', 'alert-box', array('class'=>'alert-danger'));
				return $this->redirect(
						array('controller' => 'admins', 'action' => 'menu')
				);
			}else{
				
				if($user['Parrain']['id']!= "null"){
					
					$parrain = $this->User->read('',$user['Parrain']['parrain_id'] );
					$this->set('parrain', $parrain);
				}
				$this->set('user', $user);
			}
		}
	}
	
	public function logout(){
		$this->Session->setFlash('Logout', 'alert-box', array('class'=>'alert-warning'));
		$this->Session->delete('Admin');
		
	}
	public function exception(){
		$this->Session->setFlash('Bloqué', 'alert-box', array('class'=>'alert-danger'));
		
	}
}
?>