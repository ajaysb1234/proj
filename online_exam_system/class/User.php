<?php
class User {	
   
	private $userTable = 'online_exam_user';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password && $this->loginType) {			
			$sqlQuery = "
				SELECT * FROM ".$this->userTable." 
				WHERE email = ? AND password = ? AND role= ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);			
			$stmt->bind_param("sss", $this->email, $password, $this->loginType);	
			$stmt->execute();
			$result = $stmt->get_result();			
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];
				$_SESSION["role"] = $this->loginType;
				$_SESSION["name"] = $user['first_name']." ".$user['last_name'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["userid"]) && $_SESSION["userid"]) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function listUsers(){			
		$sqlQuery = "
			SELECT id, first_name, last_name, gender, email, mobile, created, role
			FROM ".$this->userTable." ";
				
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id ASC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare($sqlQuery);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	
		while ($user = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $user['id'];
			$rows[] = ucfirst($user['first_name']." ".$user['last_name']);
			$rows[] = $user['email'];
			$rows[] = $user['gender'];
			$rows[] = $user['mobile'];
			$userRole = '';
			if($user['role'] == 'admin')	{
				$userRole = '<span class="label label-danger">Admin</span>';
			} else if($user['role'] == 'user') {
				$userRole = '<span class="label label-warning">Member</span>';
			}	
			$rows[] = $userRole;			
			$rows[] = '<button  type="button" name="view" id="'.$user["id"].'" class="btn btn-info btn-xs view"><span title="View Tasks">View Details</span></button>';	
			$rows[] = '<button type="button" name="update" id="'.$user["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$rows[] = '<button type="button" name="delete" id="'.$user["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getUser(){
		if($this->id) {
			$sqlQuery = "
			SELECT id, first_name, last_name, gender, email, mobile, address, created
			FROM ".$this->userTable."			
			WHERE id = ?";		
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$records = array();		
			while ($user = $result->fetch_assoc()) { 				
				$rows = array();			
				$rows[] = $user['id'];
				$rows[] = ucfirst($user['first_name']." ".$user['last_name']);					
				$rows[] = $user['gender'];
				$rows[] = $user['email'];	
				$rows[] = $user['mobile'];
				$rows[] = $user['address'];
				$rows[] = $user['created'];
				$records[] = $rows;
			}		
			$output = array(			
				"data"	=> 	$records
			);
			echo json_encode($output);
		}
	}

	public function getUserDetails(){		
		if($this->userid) {		
			$sqlQuery = "
				SELECT id, first_name, last_name, gender, email, mobile, address, role
				FROM ".$this->userTable." 
				WHERE id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->userid);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$row = $result->fetch_assoc();
			echo json_encode($row);
		}		
	}
	
	public function insert() {      
		if($this->email) {		              
			$this->newPassword = md5($this->newPassword);			
			$queryInsert = "
				INSERT INTO ".$this->userTable."(first_name, last_name, gender, mobile, email,  role, address, password) 
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";				
			$stmt = $this->conn->prepare($queryInsert);
			$stmt->bind_param("ssssssss", $this->firstName, $this->lastName, $this->gender, $this->mobile, $this->email, $this->role, $this->address, $this->newPassword);	
			$stmt->execute();					
		}
	}	
	
	public function update() {      
		if($this->updateUserId && $this->email) {		              
			
			$changePassword = '';
			if($this->newPassword) {
				$this->newPassword = md5($this->newPassword);
				$changePassword = ", password = '".$this->newPassword."'";
			}
			
			$queryUpdate = "
				UPDATE ".$this->userTable." 
				SET first_name = ?, last_name = ?, gender = ?, mobile = ?, email = ?, role = ?, address = ? $changePassword
				WHERE id = '".$this->updateUserId."'";				
			$stmt = $this->conn->prepare($queryUpdate);
			$stmt->bind_param("sssssss", $this->firstName, $this->lastName, $this->gender, $this->mobile, $this->email, $this->role, $this->address);	
			$stmt->execute();			
		}
	}
	
	public function delete() {      
		if($this->deleteUserId) {		          
			$queryDelete = "
				DELETE FROM ".$this->userTable." 
				WHERE id = ?";				
			$stmt = $this->conn->prepare($queryDelete);
			$stmt->bind_param("i", $this->deleteUserId);	
			$stmt->execute();		
		}
	}
}
?>