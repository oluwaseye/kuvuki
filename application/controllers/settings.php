<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		
		$this->user = $this->session->userdata('user_pro_id');
		$this->provider = $this->session->userdata('provider');

		$this->data['title'] = 'trending news around the world...';
		//if user is not logged in redirect to base
		if((! $this->session->userdata('user_pro_id')) && (! $this->session->userdata('provider'))) {
			redirect(base_url());
		}
	}

	public function index()
	{

		//send to view
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu_settings');
				$this->load->view('settings');
				$this->load->view('_partials/footer_settings');
				
		
	}

	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
