<?php
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>Online Exam System with PHP & MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/user_exam.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="background-color:#f4f3ef;">  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>	
	<br>
	<h4>Exam List</h4>	
	<div> 	
		
		<table id="userExamListing" class="table table-bordered table-striped">
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Exam Title</th>					
					<th>Duration</th>
					<th>Total Question</th>
					<th>R/Q Mark</th>
					<th>W/Q Mark</th>					
					<th>Status</th>	
					<th></th>									
				</tr>
			</thead>
		</table>
	</div>
			
</div>
 <?php include('inc/footer.php');?>
