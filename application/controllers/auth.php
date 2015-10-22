<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('language');
		
		/*$this->load->library('HybridAuthLib');*/

		$this->load->model('auth_model');
	
		
	}

	public function index()
	{
		$this->load->view('home');
	}

	public function login($provider)
	{
		log_message('debug', "controllers.Auth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.Auth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.Auth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.Auth.login: user authenticated.');

					$this->user_profile = $service->getUserProfile();

					log_message('info', 'controllers.Auth.login: user profile:'.PHP_EOL.print_r($this->user_profile, TRUE));

					

					/*$data['user_profile'] = $this->user_profile;*/
					$provider_userid = $this->user_profile->identifier;
					$user_email         = $this->user_profile->email;
					$display_name  = $this->user_profile->displayName;


					//check if the user exist
					$authentication_info = $this->auth_model->find_by_provider_uid($provider, $provider_userid);

					/*$this->load->view('hauth/done',$data);*/
					/*$this->load->view('home',$data);*/


					//if user provider data exists i.e returned data is not empty
			if(!empty($authentication_info)){
				
				/*echo 'user exist, now start session';*/
				//create a session
							$sess_data = array(
                   					'provider'  => 'facebook',
                   					'user_pro_id'     => $this->user_profile->identifier,
                   					'logged_in' => TRUE
               					);

							$this->session->set_userdata($sess_data);

							//redirect to the home
							/*redirect(base_url());*/
								if ($this->agent->is_referral())
    							{
        							redirect($this->agent->referrer());
    							}else{
    								redirect(base_url());
    							}
			}else{
				//create the user data and start a session
					$auth_data = array(

					       	'provider_id' => $this->user_profile->identifier,
					       	'display_name' => $this->user_profile->displayName,
					       	'email' => $this->user_profile->email

						);

						$fbid_userdata = array(

					       	'facebook_id' => $this->user_profile->identifier,
					       	'fullname' => $this->user_profile->displayName,
					       	'email' => $this->user_profile->email

						);

						$twid_userdata = array(

					       	'twitter_id' => $this->user_profile->identifier

						);

							$ggid_userdata = array(

					       	'google_id' => $this->user_profile->identifier,
					       	'fullname' => $this->user_profile->displayName,
					       	'email' => $this->user_profile->email

						);

						
						if($provider=='Facebook'){
							//the user table that links to the fb account
							$this->auth_model->createUserFB($fbid_userdata);
							//create in the social user table fb, twitter or google
							$this->auth_model->createSocialData($provider, $auth_data);

							//create a session
							$sess_data = array(
                   					'provider'  => 'facebook',
                   					'user_pro_id'     => $this->user_profile->identifier,
                   					'logged_in' => TRUE
               					);

							$this->session->set_userdata($sess_data);

							//redirect to home
							/*redirect(base_url());*/
							if ($this->agent->is_referral())
    							{
        							redirect($this->agent->referrer());
    							}else{
    								redirect(base_url());
    							}

						}elseif($provider=='Google'){
							//the user table that links to the google account
							$this->auth_model->createUserGG($ggid_userdata);
							//create in the social user table fb, twitter or google
							$this->auth_model->createSocialData($provider, $auth_data);

							//create a session
							$sess_data = array(
                   					'provider'  => 'google',
                   					'user_pro_id'     => $this->user_profile->identifier,
                   					'logged_in' => TRUE
               					);

							$this->session->set_userdata($sess_data);
							
							//redirect to home
							/*redirect(base_url());*/
							if ($this->agent->is_referral())
    							{
        							redirect($this->agent->referrer());
    							}else{
    								redirect(base_url());
    							}


						}elseif($provider=='Twitter'){
							//the user table that links to the twitter account
							$this->auth_model->createUserTW($twid_userdata);
							//create in the social user table fb, twitter or google
							$this->auth_model->createSocialData($provider, $auth_data);

							//create a session
							$sess_data = array(
                   					'provider'  => 'twitter',
                   					'user_pro_id'     => $this->user_profile->identifier,
                   					'logged_in' => TRUE
               					);

							$this->session->set_userdata($sess_data);

							//redirect to home
							/*redirect(base_url());*/
							if ($this->agent->is_referral())
    							{
        							redirect($this->agent->referrer());
    							}else{
    								redirect(base_url());
    							}


						}else{

						}


			}


				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.Auth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.Auth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.Auth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.Auth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.Auth.endpoint called.');
		log_message('info', 'controllers.Auth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.Auth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.Auth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}

	public function logout(){

		$this->session->sess_destroy();
		redirect(base_url());

	}
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
