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
<title>Online Exam System</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/exam.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="background-color:#f4f3ef;">  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>	
	<br>
	<h4>Exam</h4>	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" id="addExam" class="btn btn-info" title="Add Exam"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="examListing" class="table table-bordered table-striped">
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Exam Title</th>					
					<th>Duration (Minute)</th>
					<th>Total Question</th>
					<th>R/Q Mark</th>
					<th>W/Q Mark</th>					
					<th>Status</th>	
					<th>Questions</th>	
					<th>Enroll Users</th>						
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="examModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="examForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Exam</h4>
					</div>
					<div class="modal-body">
						<div class="form-group"
							<label for="project" class="control-label">Examm Title</label>
							<input type="text" class="form-control" id="exam_title" name="exam_title" placeholder="Exam title" required>			
						</div>						
						
						<div class="form-group"
							<label for="project" class="control-label">Duration</label>
							<select name="exam_duration" id="exam_duration" class="form-control">
	                				<option value="">Select</option>
									<option value="1">1 Minute</option>
									<option value="2">2 Minute</option>
									<option value="3">3 Minute</option>
									<option value="4">4 Minute</option>
	                				<option value="5">5 Minute</option>
	                				<option value="30">30 Minute</option>
	                				<option value="60">1 Hour</option>
	                				<option value="120">2 Hour</option>
	                				<option value="180">3 Hour</option>
	                			</select>	
						</div>
						
						<div class="form-group"
							<label for="project" class="control-label">Total Question</label>
							<select name="total_question" id="total_question" class="form-control">
								<option value="">Select</option>
								<option value="1">1 Question</option>
								<option value="2">2 Question</option>
								<option value="3">3 Question</option>
								<option value="4">4 Question</option>
								<option value="5">5 Question</option>
								<option value="10">10 Question</option>
								<option value="25">25 Question</option>
								<option value="50">50 Question</option>
								<option value="100">100 Question</option>
								<option value="200">200 Question</option>
								<option value="300">300 Question</option>
							</select>		
						</div>
						
						<div class="form-group"
							<label for="project" class="control-label">Marks For Right Answer</label>
							<select name="marks_right_answer" id="marks_right_answer" class="form-control">
								<option value="">Select</option>
								<option value="1">+1 Mark</option>
								<option value="2">+2 Mark</option>
								<option value="3">+3 Mark</option>
								<option value="4">+4 Mark</option>
								<option value="5">+5 Mark</option>
							</select>			
						</div>
						
						<div class="form-group"
							<label for="project" class="control-label">Marks For Wrong Answer</label>
							<select name="marks_wrong_answer" id="marks_wrong_answer" class="form-control">
								<option value="">Select</option>
								<option value="1">-1 Mark</option>
								<option value="1.25">-1.25 Mark</option>
								<option value="1.50">-1.50 Mark</option>
								<option value="2">-2 Mark</option>
							</select>			
						</div>
						
						<div class="form-group"
							<label for="status" class="control-label">Status</label>
							<select name="status" id="status" class="form-control">
								<option value="">Select</option>
								<option value="Created">Created</option>
								<option value="Pending">Pending</option>
								<option value="Started">Started</option>
								<option value="Completed">Completed</option>
							</select>			
						</div>
								
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			
</div>
 <?php include('inc/footer.php');?>
