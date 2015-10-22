<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Paymentlink_model extends CI_Model{

		function Paymentlink_model()
    {
        // Call the Model constructor
        parent::__construct();



    }

		private $table_name = 'user_paymentlinks';


public function get_userlinks($user_id)
	{
		$this->db->select('store_name,amount, memo, purchasekey, hits');
		$this->db->select("DATE_FORMAT(created, '%D %b %Y') AS created", FALSE );
		$this->db->select("DATE_FORMAT(expires, '%D %b %Y') AS expires", FALSE );
		$this->db->where('user_id', $user_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('user_paymentlinks');

		return $query->result();
		
	}

	public function get_userlink($user_id, $key)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('purchasekey', $key);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('user_paymentlinks');

		return array_shift($query->result());
		
	}


	public function check_userlinks($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_paymentlinks');
		$data =  array_shift($query->result());
		if(empty($data)){
			return FALSE;
		}else{
			return TRUE;
		}
	}

		public function create($form_data)
	{
		$this->db->insert('user_paymentlinks', $form_data);
		
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