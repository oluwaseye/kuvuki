<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Error_404 extends CI_Controller
{
	public function __construct()   {
            parent::__construct(); 
           $this->load->helper('url');
    }

	function index()
	{
		$this->load->view('errors/404');
	}

	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */