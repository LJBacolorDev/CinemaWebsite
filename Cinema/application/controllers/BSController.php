<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class BSController extends CI_Controller{

		public function __construct(){
            parent::__construct();

            $this->load->helper(array('form','url'));
			$this->load->library('form_validation');
        	$this->load->library('session');
			$this->load->library("pagination");
			$this->load->database();
            $this->load->model('BSModel');
        }
		
		public function index(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "admin"){
					redirect('admin');
				}
				else if($_SESSION['Position'] == "user"){
					redirect('user');
				}
				else{
					$this->logout();
				}
			}
			else{
				$this->logout();
			}
		}

		public function main(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "admin"){
					redirect('admin');
				}
				else if($_SESSION['Position'] == "user"){
					redirect('user');
				}
				else{
					$this->logout();
				}
			}
			$this->load->view('Header');
			$this->load->view('Menu');
		}

		public function login(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "admin"){
					redirect('admin');
				}
				else if($_SESSION['Position'] == "user"){
					redirect('user');
				}
				else{
					$this->logout();
				}
			}
			$this->load->view('Header');

			$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
	
			if ($this->form_validation->run() == FALSE) { 
				$this->load->view('Login');
			}
			else{
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$result = $this->BSModel->check_email($email);

				if($result == null){
					$this->session->set_flashdata('message','Account does not exists');
					redirect('login');
				}
				else if($result['Password'] != $password){
					$this->session->set_flashdata('message','Incorrect Password');
					redirect('login');
				}
				else{
					if($result['Active'] == 0){
						$this->session->set_flashdata('message','Please activate your account.');
						$this->emailcode($result['UserID'],$result['Email'],$result['Name'],$result['VerificationCode'],true);
						redirect('login');
					}
					else{
						$this->session->set_userdata($result);
						if($_SESSION['Position'] == "admin"){
							redirect('admin');
						}
						else if($_SESSION['Position'] == "user"){
							redirect('user');
						}
						redirect('login');
					}
				}

			}
		}

		public function signup(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "admin"){
					redirect('admin');
				}
				else if($_SESSION['Position'] == "user"){
					redirect('user');
				}
				else{
					redirect('main');
				}
			}
			$this->load->view('Header');

			$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
			$this->form_validation->set_rules('name','First Name','required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
	
			if ($this->form_validation->run() == FALSE) { 
				$this->load->view('Signup');
			}
			else{
				$email = $this->input->post('email');
				$name = $this->input->post('name');
				$password = $this->input->post('password');

				$query = $this->BSModel->check_email($email);
	 
				if($query){
					$this->session->set_flashdata('message', 'Email Already Exists');
				}
				else{
					$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 12);

					$user['Email'] = $email;
					$user['Password'] = $password;
					$user['Position'] = 'user';
					$user['Name'] = $name;
					$user['VerificationCode'] = $code;
					$user['Active'] = false;
					$id = $this->BSModel->register_user($user);
					
					$this->emailcode($id,$email,$name,$code,false);
				}

				redirect('signup');
			}
		}

		private function emailcode($id,$email,$name,$code,$exists){
			$this->load->library('email');

			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 587,
				'smtp_user' => 'backseatcinemaOfficial@gmail.com',
				'smtp_pass' => 'puheifwlvvvdzgly',
				'_smtp_auth' => TRUE,
				'smtp_timeout' => 30,
				'starttls' => TRUE,
				'smtp_crypto' => 'tls',
				'mailtype' => 'html',
				'wordwrap' => TRUE
			);

			$message = 	"
						<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering ".$name.".</h2>
							<p>Your Account:</p>
							<p>Email: ".$email."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='".base_url()."BSController/activate/".$id."/".$code."'>Activate My Account</a></h4>
						</body>
						</html>
						";

			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($config['smtp_user']);
			$this->email->to($email);
			$this->email->subject('Signup Verification Email');
			$this->email->message($message);

			if($this->email->send()){
				$this->session->set_flashdata('message','Activation code sent to email');
			}
			else if($exists){
				$this->session->set_flashdata('message','Account not yet activated. Activation code sent to email');
			}
			else{
				$this->session->set_flashdata('message', $this->email->print_debugger());
			}
		}

		public function activate(){
			$id =  $this->uri->segment(3);
			$code = $this->uri->segment(4);
			
			$user = $this->BSModel->get_user($id);
	 
			if($user['VerificationCode'] == $code){
				$data['Active'] = true;
				$query = $this->BSModel->activate($data, $id);
	 
				if($query){
					$this->session->set_flashdata('message', 'User activated successfully');
				}
				else{
					$this->session->set_flashdata('message', 'Something went wrong in activating account');
				}
			}
			else{
				$this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
			}
	 
			redirect('signup');
		}

		public function logout(){
			session_destroy();
			redirect('main');
		}

		public function admin(){
			redirect('admin/movies');
		}

		public function adminmovies(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "user"){
					redirect('user');
				}
			}
			else{
				$this->logout();
			}

			$config = array();
			$config["base_url"] = base_url()."admin/movies";
        	$config["total_rows"] = $this->BSModel->get_count('tblmovies');
        	$config["per_page"] = 10;
        	$config["uri_segment"] = 3;
			$config["use_page_numbers"] = TRUE;


        	$this->pagination->initialize($config);

        	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			if($page!=0){
				$page--;
				$page *= $config["per_page"];
			}

        	$data["links"] = $this->pagination->create_links();

        	$data['movies'] = $this->BSModel->get_data('tblmovies',$config["per_page"], $page);

			$this->load->view('AdminHeader');

			$action = $this->input->post('action');

			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('description','Description','required');
			$this->form_validation->set_rules('date','Date','required');
			$this->form_validation->set_rules('cost','Cost','required');

			$config['upload_path']   = './uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 10000; 
            $config['max_width']     = 8000;
            $config['max_height']    = 8000;
            $this->load->library('upload', $config);
			
			if($this->form_validation->run() == FALSE){
                $this->load->view('AdminMovies', $data);
			}
			else if($action == 'clear'){
				unset($_SESSION['MovieID']);
				$this->load->view('AdminMovies', $data);
			}
            else if (!$this->upload->do_upload('poster') && $action == 'add') {
                $error = $this->upload->display_errors();
				$this->session->set_flashdata('message', $error);
                $this->load->view('AdminMovies', $data);
            }
			else if($action == 'delete') {
				$this->BSModel->delete_movie($_SESSION['MovieID']);
				$this->session->set_flashdata('message', 'Movie Successfully Deleted!');
				unset($_SESSION['MovieID']);
				redirect('admin/movies');
			}
			else{
				if($action == 'add') {
					$moviedata['Title'] = $this->input->post('title');
					$upload_data = $this->upload->data();
                	$moviedata['Poster'] = $upload_data['file_name'];
					$moviedata['Description'] = $this->input->post('description');
					$moviedata['Date'] = $this->input->post('date');
					$moviedata['Cost'] = $this->input->post('cost');

					$this->BSModel->add_movie($moviedata);
					$this->session->set_flashdata('message', 'Movie Successfully Added!');
				}
				elseif($action == 'update') {
					$moviedata['Title'] = $this->input->post('title');
					$moviedata['Description'] = $this->input->post('description');
					$moviedata['Date'] = $this->input->post('date');
					$moviedata['Cost'] = $this->input->post('cost');

					$this->BSModel->update_movie($moviedata,$_SESSION['MovieID']);
					$this->session->set_flashdata('message', 'Movie Successfully Updated!');
					unset($_SESSION['MovieID']);
				}
				redirect('admin/movies');
			}
		}

		public function adminviewmovie(){
			$movie = $this->BSModel->get_movie($this->input->post('id'));
			$this->session->set_userdata($movie);
			redirect('admin/movies');
		}

		public function adminusers(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "user"){
					redirect('user');
				}
			}
			else{
				$this->logout();
			}

			$config = array();
			$config["base_url"] = base_url()."admin/users";
        	$config["total_rows"] = $this->BSModel->get_count('tblusers');
        	$config["per_page"] = 10;
        	$config["uri_segment"] = 3;
			$config["use_page_numbers"] = TRUE;


        	$this->pagination->initialize($config);

        	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			if($page!=0){
				$page--;
				$page *= $config["per_page"];
			}

        	$data["links"] = $this->pagination->create_links();

        	$data['users'] = $this->BSModel->get_data('tblusers',$config["per_page"], $page);

			$this->load->view('AdminHeader');

			$action = $this->input->post('action');

			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password', 'required|min_length[7]|max_length[30]');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('position','Position','required');

			if($this->form_validation->run() == FALSE){
                $this->load->view('AdminUsers', $data);
			}
			else if($action == 'clear'){
				unset($_SESSION['user']);
				$this->load->view('AdminUsers', $data);
			}
			else if($action == 'delete') {
				$this->BSModel->delete_user($_SESSION['user']['UserID']);
				$this->session->set_flashdata('message', 'User Successfully Deleted!');
				unset($_SESSION['user']);
				redirect('admin/users');
			}
			else{
				if($action == 'add') {
					$userdata['Email'] = $this->input->post('email');
					$userdata['Password'] = $this->input->post('password');
					$userdata['Position'] = $this->input->post('position');
					$userdata['Name'] = $this->input->post('name');
					$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$userdata['VerificationCode'] = substr(str_shuffle($set), 0, 12);
					$userdata['Active'] = 1;

					$this->BSModel->add_user($userdata);
					$this->session->set_flashdata('message', 'User Successfully Added!');
				}
				elseif($action == 'update') {
					$userdata['Email'] = $this->input->post('email');
					$userdata['Password'] = $this->input->post('password');
					$userdata['Position'] = $this->input->post('position');
					$userdata['Name'] = $this->input->post('name');

					$this->BSModel->update_user($userdata,$_SESSION['user']['UserID']);
					$this->session->set_flashdata('message', 'User Successfully Updated!');
					unset($_SESSION['user']);
				}
				redirect('admin/users');
			}
		}

		public function adminviewuser(){
			$user = $this->BSModel->get_user($this->input->post('id'));
			$_SESSION['user'] = $user;
			redirect('admin/users');
		}
		
		public function admintransactions(){
			$this->load->view('AdminHeader');

			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "user"){
					redirect('user');
				}
			}
			else{
				$this->logout();
			}

			$config = array();
			$config["base_url"] = base_url()."admin/transactions";
        	$config["total_rows"] = $this->BSModel->get_count('tbltransactions');
        	$config["per_page"] = 10;
        	$config["uri_segment"] = 3;
			$config["use_page_numbers"] = TRUE;


        	$this->pagination->initialize($config);

        	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			if($page!=0){
				$page--;
				$page *= $config["per_page"];
			}

        	$data["links"] = $this->pagination->create_links();

        	$data['transactions'] = $this->BSModel->get_transactions($config["per_page"], $page);

			$this->load->view('AdminTransactions',$data);
		}

		public function user(){
			redirect('user/movies');
		}

		public function usermovies(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "admin"){
					redirect('admin');
				}
			}
			else{
				$this->logout();
			}
			$this->load->view('UserHeader');

			$config = array();
			$config["base_url"] = base_url()."user/movies";
        	$config["total_rows"] = $this->BSModel->count_upcoming_movies();
        	$config["per_page"] = 3;
        	$config["uri_segment"] = 3;
			$config["use_page_numbers"] = TRUE;


        	$this->pagination->initialize($config);

        	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			if($page!=0){
				$page--;
				$page *= $config["per_page"];
			}

        	$data["links"] = $this->pagination->create_links();

        	$data['movies'] = $this->BSModel->get_upcoming_movies($config["per_page"], $page);

			$this->load->view('UserMovies',$data);
		}

		public function userbuy(){
			$movie = $this->BSModel->get_movie($this->input->post('movieid'));
			$quantity = $this->input->post('quantity');

			if($quantity<=0){
				echo '<script>alert("Please Enter Valid Quantity");window.location.href="http://localhost/FINALS/index.php/user/movies"</script>'; 
			}
			else{
				$trandata['UserID'] = $_SESSION['UserID'];
				$trandata['MovieID'] = $movie['MovieID'];
				$trandata['Quantity'] = $quantity;
				$trandata['TotalCost'] = $quantity * $movie['Cost'];
				$this->BSModel->add_transaction($trandata);

				echo '<script>alert("Succesfully Purchased Ticket!\nMovie: '.$movie['Title'].'\nQuantity: '.$quantity.'\nTotal Cost: '.$quantity * $movie['Cost'].'");window.location.href="http://localhost/FINALS/index.php/user/movies";</script>';
			}
		}

		public function usertransactions(){
			if(isset($_SESSION['Position'])){
				if($_SESSION['Position'] == "admin"){
					redirect('admin');
				}
			}
			else{
				$this->logout();
			}

			$this->load->view('UserHeader');

			$config = array();
			$config["base_url"] = base_url()."user/mytransactions";
        	$config["total_rows"] = $this->BSModel->get_usertransaction_count($_SESSION['UserID']);
        	$config["per_page"] = 10;
        	$config["uri_segment"] = 3;
			$config["use_page_numbers"] = TRUE;


        	$this->pagination->initialize($config);

        	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			if($page!=0){
				$page--;
				$page *= $config["per_page"];
			}

        	$data["links"] = $this->pagination->create_links();

        	$data['transactions'] = $this->BSModel->get_usertransactions($_SESSION['UserID'],$config["per_page"], $page);

			$this->load->view('UserTransactions',$data);
		}
    }
?>