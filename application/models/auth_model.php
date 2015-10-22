<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Auth_model extends CI_Model{

		function Auth_model()
    {
        // Call the Model constructor
        parent::__construct();



    }

		private $table_name = 'kv_users';


public function find_by_provider_uid($provider, $provider_id)
	{
		if($provider=='Facebook'){

		$this->db->where('provider_id', $provider_id);
		$query = $this->db->get('kv_facebook');

		return array_shift($query->result());

		}elseif($provider=='Google'){

		$this->db->where('provider_id', $provider_id);
		$query = $this->db->get('kv_google');

		return array_shift($query->result());


		}elseif($provider=='Twitter'){

		$this->db->where('provider_id', $provider_id);
		$query = $this->db->get('kv_twitter');

		return array_shift($query->result());

		}else{
			return FALSE;
		}
		
		
	}

	public function get_userlink($user_id, $key)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('purchasekey', $key);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('user_paymentlinks');

		return array_shift($query->result());
		
	}


	/*public function find_by_provider_uid($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_paymentlinks');
		$data =  array_shift($query->result());
		if(empty($data)){
			return FALSE;
		}else{
			return TRUE;
		}
	}*/

		public function createSocialData($provider, $data)
	{
		if($provider=='Facebook'){
		$this->db->insert('kv_facebook', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
		}elseif($provider=='Google'){

		$this->db->insert('kv_google', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;

		}elseif($provider=='Twitter'){
			$this->db->insert('kv_twitter', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;

		}else{
			return FALSE;
		}
	}

		public function createUserFB($data)
	{
		
		$this->db->insert('kv_users', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
		
	}

		public function createUserGG($data)
	{
		
		$this->db->insert('kv_users', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
		
	}

		public function createUserTW($data)
	{
		
		$this->db->insert('kv_users', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
		
	}

	   public function edit($data,$user_id,$key){
        $this->db->where('purchasekey',$key);
        $this->db->where('user_id',$user_id);
        $this->db->update('user_paymentlinks', $data);
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;       
    }

	 public function delete($key){
        $this->db->where('purchasekey', $key);
        $this->db->delete('user_paymentlinks');
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;        
    }   

	/*public function check_user_to_company($user_id, $company)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('comp_id', $company);
		$query = $this->db->get('user_companies');
		$data =  array_shift($query->result());
		if(empty($data)){
			return FALSE;
		}else{
			return TRUE;
		}
	}

		public function get_user_to_company($user_id, $company)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('comp_id', $company);
		$query = $this->db->get('user_companies');
		return array_shift($query->result());
		
	}

	public function get_user_to_companies($user_id, $company)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('comp_id', $company);
		$query = $this->db->get('user_companies');
		return $query->result();
		
	}


	public function get_first_company($user_id){
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_companies');
		return array_shift($query->result());
	}

	public function check_profile_completion($user_id){
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_profiles');
		$data =  array_shift($query->result());
		if(($data->fullname=='')&&($data->sex=='')&&($data->country=='')){
			return FALSE;
		}else{
			return TRUE;
		}
	}*/

}

?>