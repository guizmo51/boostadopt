<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	
	
	
	public function storeLog(){
		$this->autoRender = false; // no view to render
		$this->response->type('json');
		$profile = $this->request->data['profile'];
		$json=json_decode($profile, TRUE);
		
		if(isset($json['id']) && isset($json['pseudo'])){
			file_put_contents("../webroot/profiles/".$json['id'].".json", json_encode($json, TRUE));
		}
		if($this->Session->check('currentBooster')){
			
			if($this->Session->check('currentBooster.profile')){
				$profileRun = $this->Session->read('currentBooster.profile');
				$profileRun[] = $json['id'];
				$this->Session->write('currentBooster.profile',$profileRun);
			}else{
				$this->Session->write('currentBooster.profile', array($json['id']));
			}
		}
		
		
		
	}
	
	
	public function logout(){
		$this->autoRender = false; // no view to render
		$this->response->type('json');
		$this->response->body(json_encode($this->Session->destroy()));
		
	}
	
	public function checkSession(){
		$this->autoRender = false;
		$this->response->type('json');
		if($this->Session->check('User')){
			$user = $this->User->read('', $this->Session->read('User.id'));
		 return $this->response->body(json_encode($user['User']));
		}
	}
	
	public function login(){
		$errors = array();
		$this->autoRender = false; // no view to render
    	$this->response->type('json');
		if ($this->request->is('post')) {
			$data = json_decode(base64_decode($this->request->data[0]), true);
			$email = base64_decode($this->request->data['mail']);
			
			if(isset($data['user'])){
				
				if(is_int($data['user']['id'])&& filter_var($email, FILTER_VALIDATE_EMAIL) ){
					
					$user = $this->User->find('first', array('conditions'=>array('User.login'=>$email)));
					
					if(count($user)==0){
						// Not in DB	
						$dataToSave = Array('aid'=>$data['user']['id'],
											'token'=> uniqid(),
											'login'=> $email,
											'credits'=>300,
											'parrainage_key'=>md5($email),
											'last_login'=>date("Y-m-d H:i:s"),
											'service'=>'AdopteUnMec');
						
						
						
						if($user = $this->User->save($dataToSave)){
							if(isset($this->request->data['affKey'])){
								// Save parrainage in DB 
								$parrain = $this->User->find('first', array('conditions'=>array('User.parrainage_key'=>$this->request->data['affKey'])));
								if(isset($parrain['User'])){
									$this->loadModel('Affiliate');
									$this->Affiliate->create();
									$this->Affiliate->set('parrain_id', $parrain['User']['id']);
									$this->Affiliate->set('filleul_id', $user['User']['id']);
									
									if($this->Affiliate->save()){
										// Add credits to parrain
										$this->loadModel('Coupon');
										$coupon = $this->Coupon->read('',1);
										
										$this->User->Rechargement->create();
										$this->User->Rechargement->set('date',date("Y-m-d H:i:s") );
										$this->User->Rechargement->set('credit_value', $coupon['Coupon']['credits']);
										$this->User->Rechargement->set('credit_before', $parrain['User']['credits']);
										$this->User->Rechargement->set('credit_after', $parrain['User']['credits']+$coupon['Coupon']['credits']);
										$this->User->Rechargement->set('users_id', $parrain['User']['id']);
										$this->User->Rechargement->set('id_transaction', "Affiliation of new user");
										$this->User->Rechargement->set('coupons_id', $coupon['Coupon']['id']);
										$this->User->Rechargement->save();
										
										// Update credits of user
										$newCredits = $parrain['User']['credits']+$coupon['Coupon']['credits'];
										$this->User->read('', 	$parrain['User']['id']);
										$this->User->set('credits',$newCredits);
										$this->User->save();
										
														
									}
									
								}
								
								
							}
						}
						
						
					}else {
						//In DB
						$user['User']['last_login']=date("Y-m-d H:i:s");
						$this->User->save($user);
						
					}
				}
				
			}
			if(empty($errors)){
				$dataSession = $user['User'];
				
				
				
				$this->Session->write('User',$dataSession);
				
			}
			$json = json_encode($user);
    $this->response->body($json);
		}
		
		
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
