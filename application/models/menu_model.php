<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Menu_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	// --------------------------------------------------------------------
      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */
	public function technology_active()
	{
		if ($this->uri->segment(1,0) === 'technology')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}

	public function politics_active()
	{
		if ($this->uri->segment(1) === 'politics')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}

	public function gossip_active()
	{
		if ($this->uri->segment(1) === 'gossip')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}

	public function entertainment_active()
	{
		if ($this->uri->segment(1) === 'entertainment')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}

	public function lifestyle_active()
	{
		if ($this->uri->segment(1) === 'lifestyle')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}

	public function weird_active()
	{
		if ($this->uri->segment(1) === 'weird')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}
	public function video_active()
	{
		if ($this->uri->segment(1) === 'video')
		{

    	 return $this->classActive();

		}else{
    		
		}
	}


	public function classActive(){
		$data  = array( 'class_active'=>'class="active"');
		return array_shift($data);
	}

	
}

?>