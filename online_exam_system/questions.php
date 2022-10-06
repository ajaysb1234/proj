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
<script src="js/questions.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="background-color:#f4f3ef;">  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>
	<br>	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" id="addQuestions" class="btn btn-info" title="Add Questions"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="questionsListing" data-exam-id="<?php echo $_GET['exam_id']; ?>" class="table table-bordered table-striped">
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Question</th>					
					<th>Right Option</th>					
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="questionsModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="questionsForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit questions</h4>
					</div>
					<div class="modal-body">
						
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Question Title <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="question_title" id="question_title" autocomplete="off" class="form-control" />
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Option 1 <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="option_title_1" id="option_title_1" autocomplete="off" class="form-control" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Option 2 <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="option_title_2" id="option_title_2" autocomplete="off" class="form-control" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Option 3 <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="option_title_3" id="option_title_3" autocomplete="off" class="form-control" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Option 4 <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="option_title_4" id="option_title_4" autocomplete="off" class="form-control" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Answer <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<select name="answer_option" id="answer_option" class="form-control">
										<option value="">Select</option>
										<option value="1">1 Option</option>
										<option value="2">2 Option</option>
										<option value="3">3 Option</option>
										<option value="4">4 Option</option>
									</select>
								</div>
							</div>
						</div>					
								
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="exam_id" id="exam_id" />
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
