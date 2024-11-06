<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class BSModel extends CI_Model {
 
    protected $userTable = 'tblusers';
	protected $movieTable = 'tblmovies';
	protected $transactionTable = 'tbltransactions';

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
    
	public function register_user($user){
		$this->db->insert($this->userTable, $user);
		return $this->db->insert_id();
	}
 
	public function get_user($id){
		$query = $this->db->get_where($this->userTable,array('UserID'=>$id));
		return $query->row_array();
	}

	public function login_user($email, $password){
		$query = $this->db->get_where($this->userTable, array('Email' => $email, 'Password' => $password));
		return $query->result();
	}

	public function check_email($email){
		$query = $this->db->get_where($this->userTable,array('Email'=>$email));
		return $query->row_array();
	}
 
	public function activate($data, $id){
		$this->db->where('UserID', $id);
		return $this->db->update($this->userTable, $data);
	}
	
	public function get_count($tbl){
		return $this->db->count_all($tbl);
	}

	public function get_data($tbl,$limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get($tbl);

		return $query->result();
	}

	public function get_transactions($limit, $start) {
		$this->db->select('tblusers.UserID, tblusers.Name, tblmovies.Title, tblmovies.Date, Quantity, Totalcost');
		$this->db->from('tbltransactions');
		$this->db->join('tblusers', 'tbltransactions.UserID=tblusers.UserID');
		$this->db->join('tblmovies', 'tbltransactions.MovieID=tblmovies.MovieID');
		$this->db->order_by('tblmovies.Date', 'DESC');
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_movie($id){
		$query = $this->db->get_where($this->movieTable,array('MovieID'=>$id));
		return $query->row_array();
	}

	public function add_movie($moviedata){
		$this->db->insert($this->movieTable, $moviedata);
		return;
	}

	public function update_movie($data, $id){
		$this->db->where('MovieID', $id);
		$this->db->update($this->movieTable, $data);
		return;
	}

	public function delete_movie($id){
		$this->db->where('MovieID', $id);
		$this->db->delete($this->movieTable);
		return;
	}

	public function add_user($userdata){
		$this->db->insert($this->userTable, $userdata);
		return;
	}

	public function update_user($data, $id){
		$this->db->where('UserID', $id);
		$this->db->update($this->userTable, $data);
		return;
	}

	public function delete_user($id){
		$this->db->where('UserID', $id);
		$this->db->delete($this->userTable);
		return;
	}

	public function get_upcoming_movies($limit, $start){
        $this->db->select('*');
        $this->db->from($this->movieTable);
        $this->db->where('Date >', 'CURDATE()', false);
        $this->db->order_by('Date', 'ASC');
		$this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query->result();
    }

    public function count_upcoming_movies() {
        return $this->db->where('Date >', 'CURDATE()', false)
                        ->count_all_results($this->movieTable);
    }

	public function add_transaction($data){
		$this->db->insert($this->transactionTable, $data);
		return;
	}

	public function get_usertransactions($id,$limit, $start){
		$this->db->select('tblusers.UserID, tblusers.Name, tblmovies.Title, tblmovies.Date, Quantity, Totalcost');
		$this->db->from('tbltransactions');
		$this->db->where('tbltransactions.UserID', $id);
		$this->db->join('tblusers', 'tbltransactions.UserID=tblusers.UserID');
		$this->db->join('tblmovies', 'tbltransactions.MovieID=tblmovies.MovieID');
		$this->db->order_by('tblmovies.Date', 'DESC');
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_usertransaction_count($id){
		return $this->db->where('UserID', $id)
                        ->count_all_results($this->transactionTable);
	}
}
?>