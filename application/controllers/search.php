<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		
		$this->user = $this->session->userdata('user_pro_id');
		$this->provider = $this->session->userdata('provider');


		$this->data['title'] = $this->uri->segment(1, 0);

		//menu active 
		$this->data['active_tech'] = $this->menu_model->technology_active();
		$this->data['active_politics'] = $this->menu_model->politics_active();
		$this->data['active_gossip'] = $this->menu_model->gossip_active();
		$this->data['active_entertainment'] = $this->menu_model->entertainment_active();
		$this->data['active_lifestyle'] = $this->menu_model->lifestyle_active();
		$this->data['active_weird'] = $this->menu_model->weird_active();
		$this->data['active_video'] = $this->menu_model->video_active();

		//IF THE SEARCH STRING IS NOT SET
	/*	if(!isset($this->search)){ echo die(nosearchstring_speci());}*/
		}

	

	/*public function index()
	{
		
		
		
	}*/


	public function allnews($search){

		if(($this->session->userdata('user_pro_id')) && ($this->session->userdata('provider') )){

		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));

			$json_articles = curl_init();
			curl_setopt($json_articles, CURLOPT_URL, 'http://localhost/kuvukiservice/api/news/newsbysearch/search/'.$search);
			curl_setopt($json_articles, CURLOPT_RETURNTRANSFER, 1);
			$obj_articles =json_decode(curl_exec($json_articles));

			if($obj_articles->status=='100'){
				//if data was returned
				$this->data['news_data'] = $obj_articles->data;
				$this->data['news_data_latest'] = $obj_latest->data;

				$this->data['news_data_latest_description'] = word_limiter( $this->data['news_data_latest']->content_txt, 60);


				

				//send to view
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu_loggedin');
				$this->load->view('search');
				$this->load->view('_partials/footer_search');

			}else{
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu_loggedin');
				$this->load->view('search');
				$this->load->view('_partials/footer_search');
			}
		}else{


		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));

			$json_articles = curl_init();
			curl_setopt($json_articles, CURLOPT_URL, 'http://localhost/kuvukiservice/api/news/newsbysearch/search/'.$search);
			curl_setopt($json_articles, CURLOPT_RETURNTRANSFER, 1);
			$obj_articles =json_decode(curl_exec($json_articles));

			if($obj_articles->status=='100'){
				//if data was returned
				$this->data['news_data'] = $obj_articles->data;
				$this->data['news_data_latest'] = $obj_latest->data;

				$this->data['news_data_latest_description'] = word_limiter( $this->data['news_data_latest']->content_txt, 60);


				

				//send to view
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu');
				$this->load->view('search');
				$this->load->view('_partials/footer_search');

		}else{
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu');
				$this->load->view('search');
				$this->load->view('_partials/footer_search');

				
		}

	}

	
}
	

// function to show no search string specified

public function nosearchstring_speci(){

	if(($this->session->userdata('user_pro_id')) && ($this->session->userdata('provider') )){

				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu_loggedin');
				$this->load->view('search_not_specified');
				$this->load->view('_partials/footer_search');

	}else{

				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu');
				$this->load->view('search_not_specified');
				$this->load->view('_partials/footer_search');

	}


}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
