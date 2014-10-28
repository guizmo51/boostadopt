<?php
App::uses('AppController', 'Controller');
/**
 * Rechargements Controller
 *
 * @property Rechargement $Rechargement
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RechargementsController extends AppController {

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
	
	
	public function ipnPaypal(){
		$this->autoRender = false;
		
		// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
		// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
		// Set this to 0 once you go live or don't require logging.
		define("DEBUG", 0);
		
		// Set to 0 once you're ready to go live
		define("USE_SANDBOX", 0);
		
		
		define("LOG_FILE", "../tmp/logs/ipn.log");

		
		
		// Read POST data
		// reading posted data directly from $_POST causes serialization
		// issues with array data in POST. Reading raw POST data from input stream instead.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}
		
		// Post IPN data back to PayPal to validate the IPN data is genuine
		// Without this step anyone can fake IPN data
		
		if(USE_SANDBOX == true) {
			$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		} else {
			$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
		}
		
		$ch = curl_init($paypal_url);
		if ($ch == FALSE) {
			return FALSE;
		}
		
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		
		if(DEBUG == true) {
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		}
		
		// CONFIG: Optional proxy configuration
		//curl_setopt($ch, CURLOPT_PROXY, $proxy);
		//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		
		// Set TCP timeout to 30 seconds
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
		// of the certificate as shown below. Ensure the file is readable by the webserver.
		// This is mandatory for some environments.
		
		//$cert ="../webroot/cacert.pem";
		//curl_setopt($ch, CURLOPT_CAINFO, $cert);
		
		$res = curl_exec($ch);
		if (curl_errno($ch) != 0) // cURL error
		{
			
				error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
			
			curl_close($ch);
			exit;
		
		} else {
			// Log the entire HTTP response if debug is switched on.
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
				error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
		
				// Split response headers and payload
				list($headers, $res) = explode("\r\n\r\n", $res, 2);
			}
			curl_close($ch);
		}
		
		// Inspect IPN validation result and act accordingly
		
		
				
				
				
		if (strcmp ($res, "VERIFIED") == 0) {
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment and mark item as paid.
		
			// assign posted variables to local variables
			//$item_name = $_POST['item_name'];
			//$item_number = $_POST['item_number'];
			//$payment_status = $_POST['payment_status'];
			//$payment_amount = $_POST['mc_gross'];
			//$payment_currency = $_POST['mc_currency'];
			//$txn_id = $_POST['txn_id'];
			//$receiver_email = $_POST['receiver_email'];
			//$payer_email = $_POST['payer_email'];
			 
			// to do 
			// Add new rechargements for the user
			
			
			if(filter_var($_POST['option_selection2'], FILTER_VALIDATE_EMAIL)) {
				
				
				
				
				
				$this->loadModel('User');
				$user=$this->User->findByLogin($_POST['option_selection2']);
				
				

				if(isset($user['User'])){
					
					$oldCredit=$user['User']['credits'];
					$newCredit=$user['User']['credits']+$_POST['option_selection1'];
					
					$this->loadModel('Rechargement');
					$check=$this->Rechargement->findByUsers_idAndId_transaction($user['User']['id'], $_POST['txn_id']);
					if(empty($check['Rechargement'])){
						$this->User->id = $user['User']['id'];
					if($this->User->save(array('credits'=>$newCredit))){
						
						$rechargementData = array('date'=>date("Y-m-d H:i:s"),
										'credit_value'=>$_POST['option_selection1'],
										'credit_before'=>$user['User']['credits'],
							'credit_after'=>$newCredit,
							'id_transaction'=>$_POST['txn_id'],
							'users_id'=>$user['User']['id'], 'coupons_id'=>'');
						$this->Rechargement->save($rechargementData);
					}
						
					}else{
											error_log(date('[Y-m-d H:i e] '). "Pas empty". PHP_EOL, 3, LOG_FILE);

					}
					
					
					
					
					
					
					
				}else{
					$handle = fopen('../tmp/logs/perso.log', 'w+');
				
				
				
			fwrite($handle,"ERREUR".PHP_EOL);
			fclose($handle);
				}
				
			}else{
				error_log(date('[Y-m-d H:i e] '). "Verified IPN but EMAIL invalid: $req ". PHP_EOL, 3, LOG_FILE);
			}
				//option_selection1=250
				
				
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
			}
		} else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
			// Add business logic here which deals with invalid IPN messages
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
			}
		}
	}
	
	public function index() {
		$this->Rechargement->recursive = 0;
		$this->set('rechargements', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rechargement->exists($id)) {
			throw new NotFoundException(__('Invalid rechargement'));
		}
		$options = array('conditions' => array('Rechargement.' . $this->Rechargement->primaryKey => $id));
		$this->set('rechargement', $this->Rechargement->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rechargement->create();
			if ($this->Rechargement->save($this->request->data)) {
				$this->Session->setFlash(__('The rechargement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rechargement could not be saved. Please, try again.'));
			}
		}
		$users = $this->Rechargement->User->find('list');
		$coupons = $this->Rechargement->Coupon->find('list');
		$this->set(compact('users', 'coupons'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rechargement->exists($id)) {
			throw new NotFoundException(__('Invalid rechargement'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rechargement->save($this->request->data)) {
				$this->Session->setFlash(__('The rechargement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rechargement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rechargement.' . $this->Rechargement->primaryKey => $id));
			$this->request->data = $this->Rechargement->find('first', $options);
		}
		$users = $this->Rechargement->User->find('list');
		$coupons = $this->Rechargement->Coupon->find('list');
		$this->set(compact('users', 'coupons'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rechargement->id = $id;
		if (!$this->Rechargement->exists()) {
			throw new NotFoundException(__('Invalid rechargement'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rechargement->delete()) {
			$this->Session->setFlash(__('The rechargement has been deleted.'));
		} else {
			$this->Session->setFlash(__('The rechargement could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function check(){
		
	}


}
