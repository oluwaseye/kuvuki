<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		/*$this->load->library('tank_auth');*/
		$this->load->library('session');
/*		$this->load->library('kuvscrapper');
*/		/*$this->load->model('users');*/
		$this->load->helper('language');

		/*$this->load->library('Phpquery_onefile');*/
		/*include APPPATH . 'libraries/Phpquery_onefile.php';*/
		
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

		}

	

	public function index()
	{
		
		
		
	}


	public function allnews($tag){
		if(($this->session->userdata('user_pro_id')) && ($this->session->userdata('provider') )){

		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));

			$json_articles = curl_init();
			curl_setopt($json_articles, CURLOPT_URL, 'http://graystone.com.ng/kuvukiservice/api/news/newsbytag/tag/'.$tag);
			curl_setopt($json_articles, CURLOPT_RETURNTRANSFER, 1);
			$obj_articles =json_decode(curl_exec($json_articles));

			$json_latest = curl_init();
			curl_setopt($json_latest, CURLOPT_URL, 'http://graystone.com.ng/kuvukiservice/api/news/newsbytaglatest/tag/'.$tag);
			curl_setopt($json_latest, CURLOPT_RETURNTRANSFER, 1);
			$obj_latest = json_decode(curl_exec($json_latest));

			if($obj_articles->status=='100'){
				//if data was returned
				$this->data['news_data'] = $obj_articles->data;
				$this->data['news_data_latest'] = $obj_latest->data;

				$this->data['news_data_latest_description'] = word_limiter( $this->data['news_data_latest']->content_txt, 60);


				

				//send to view
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu_loggedin');
				$this->load->view('home');
				$this->load->view('_partials/footer');

			}else{
				//display no news view
				$this->load->view('errors/no_news');
				
			}
		}else{


		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));

			$json_articles = curl_init();
			curl_setopt($json_articles, CURLOPT_URL, 'http://graystone.com.ng/kuvukiservice/api/news/newsbytag/tag/'.$tag);
			curl_setopt($json_articles, CURLOPT_RETURNTRANSFER, 1);
			$obj_articles =json_decode(curl_exec($json_articles));

			$json_latest = curl_init();
			curl_setopt($json_latest, CURLOPT_URL, 'http://graystone.com.ng/kuvukiservice/api/news/newsbytaglatest/tag/'.$tag);
			curl_setopt($json_latest, CURLOPT_RETURNTRANSFER, 1);
			$obj_latest = json_decode(curl_exec($json_latest));

			if($obj_articles->status=='100'){
				//if data was returned
				$this->data['news_data'] = $obj_articles->data;
				$this->data['news_data_latest'] = $obj_latest->data;

				$this->data['news_data_latest_description'] = word_limiter( $this->data['news_data_latest']->content_txt, 60);


				

				//send to view
				$this->load->view('_partials/header', $this->data);
				$this->load->view('_partials/menu');
				$this->load->view('home');
				$this->load->view('_partials/footer');

		}else{
				//if theres no news 
				$this->load->view('errors/no_news');
			//redirect to home
			/*redirect(base_url());*/

				
		}

	}

	
}
	





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
