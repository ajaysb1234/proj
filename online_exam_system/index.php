<?php 
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($user->loggedIn()) {	
	if(!empty($_SESSION["role"]) && $_SESSION["role"] == 'admin') {
		header("Location: exam.php");	
	} else if (!empty($_SESSION["role"]) && $_SESSION["role"] == 'user'){
		header("Location: view_exam.php");	
	}
}

$loginMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["loginType"]) && $_POST["loginType"]) {	
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];	
	$user->loginType = $_POST["loginType"];
	if($user->login()) {
		if($_SESSION["role"] == 'admin') {
			header("Location: exam.php");	
		} else if ($_SESSION["role"] == 'user'){
			header("Location: view_exam.php");	
		}		
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
} else if (empty($_POST["login"]) || empty($_POST["email"]) || empty($_POST["password"])|| empty($_POST["loginType"])){
	$loginMessage = 'Enter email, pasword and select user type to login.';
}
include('inc/header.php');
?>
<title>Online Exam System with PHP & MySQL</title>
<?php include('inc/container.php');?>
<div class="content"> 
	<div class="container-fluid">
		<h2>Online Exam System</h2>			
        <div class="col-md-6">                    
		<div class="panel panel-info">
			<div class="panel-heading" style="background:#167ce6ba;color:white;">
				<div class="panel-title">Log In</div>                        
			</div> 
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">                                    
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="email" style="background:white;" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="password" required>
					</div>	
					<label class="radio-inline"><strong>User Type:</strong></label>
					<label class="radio-inline">
					  <input type="radio" name="loginType" value="admin">Administrator
					</label>
					
					<label class="radio-inline">
					  <input type="radio" name="loginType" value="user">User
					</label>
					
					<div style="margin-top:10px" class="form-group">                               
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Login" class="btn btn-info">						  
						</div>						
					</div>						
				</form>  
				<p>
				Admin Login<br>
				Email: admin@webdamn.com<br>
				Password: 123				
				</p>
				<p>
				User Login<br>
				Email: user2@test.com<br>
				Password: 123
				</p>
			</div>                     
		</div>  
	</div>       
    </div>        
		
<?php include('inc/footer.php');?>
