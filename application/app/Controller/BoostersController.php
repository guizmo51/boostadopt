<?php
App::uses('AppController', 'Controller');
/**
 * Boosters Controller
 *
 * @property Booster $Booster
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BoostersController extends AppController {

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
	
	public function begin(){
		$this->autoRender = false; // no view to render
		$this->response->type('json');
		
		$errors = array();
		$success = array();
		$user = $this->Session->Read('User');
		if($user != NULL){
			if ($this->request->is('post')) {
				$nb_profiles = $this->request->data['nb_profiles'];
				$this->Booster->create();
				$this->Booster->set('date_debut',date("Y-m-d H:i:s"));
				$this->Booster->set('nb_profiles',$nb_profiles );
				$this->Booster->set('users_id',$user['id'] );
				if($user['credits'] >= $nb_profiles){
					
					if($booster=$this->Booster->save()){
						
						$this->Session->write('currentBooster',$booster);
						
						
						
					}else{
						$errors[] = " Can't save booster in DB";
					}
			
				}else{
					$errors[] = " You have not enough credits. Please subscribe";
				}
					
			}
			
			
		}else{
			$errors[] = "Session doesn't exist, Please log in.";
		}
		
		$response = array();
		if(count($errors)==0){
			$response['status'] = "success";
		}else{
			$response['status'] = "failed";
		}
		$response['errors'] = $errors;
		$json = json_encode($response);
		$this->response->body($json);
		
	}
	
	public function end(){
		$errors = Array();
		$success = Array();
		$this->autoRender = false; // no view to render
		$this->response->type('json');
		$currentBooster = $this->Session->Read('currentBooster');
		if($currentBooster == NULL){
			$errors[]="Cannot find the current booster";
		}else{
			debug($currentBooster);
			$booster = $this->Booster->read('',$currentBooster['Booster']['id']);
			$this->Booster->set('date_fin',date("Y-m-d H:i:s"));
			$this->Booster->save();
			$this->Session->delete('currentBooster');
			
			$this->loadModel('User');
			
			$user=$this->User->read('',$booster['Booster']['users_id'] );
			if($this->Session->Check('currentBooster.profile')){
				$profilesRead = $this->Session->Read('currentBooster.profile');
				if(count($profilesRead) != $booster['Booster']['nb_profiles']){
					$fp = fopen('../webroot/adminLog/hackLog.text','a+');
					fwrite($fp, date("Y-m-d H:i:s")." / ". $booster['Booster']['users_id']." / ".count($profilesRead)." / ".$booster['Booster']['nb_profiles']);
					fclose($fp);
				}
			}
			$this->User->set('credits',$user['User']['credits']-$booster['Booster']['nb_profiles']);
			$this->User->save();
		}
	}
	
	public function index() {
		$this->Booster->recursive = 0;
		$this->set('boosters', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Booster->exists($id)) {
			throw new NotFoundException(__('Invalid booster'));
		}
		$options = array('conditions' => array('Booster.' . $this->Booster->primaryKey => $id));
		$this->set('booster', $this->Booster->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Booster->create();
			if ($this->Booster->save($this->request->data)) {
				$this->Session->setFlash(__('The booster has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booster could not be saved. Please, try again.'));
			}
		}
		$users = $this->Booster->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Booster->exists($id)) {
			throw new NotFoundException(__('Invalid booster'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Booster->save($this->request->data)) {
				$this->Session->setFlash(__('The booster has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booster could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Booster.' . $this->Booster->primaryKey => $id));
			$this->request->data = $this->Booster->find('first', $options);
		}
		$users = $this->Booster->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Booster->id = $id;
		if (!$this->Booster->exists()) {
			throw new NotFoundException(__('Invalid booster'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Booster->delete()) {
			$this->Session->setFlash(__('The booster has been deleted.'));
		} else {
			$this->Session->setFlash(__('The booster could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
