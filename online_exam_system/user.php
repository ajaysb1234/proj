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
<script src="js/user.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="background-color:#f4f3ef;">  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>
	<br>	
	<h4>User List</h4>
	<br>	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add New</button>
				</div>
			</div>
		</div>
		<table id="userListing" class="table table-bordered table-striped">
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Name</th>					
					<th>Email</th>
					<th>Gender</th>						
					<th>Mobile</th>	
					<th>Role</th>
					<th></th>
					<th></th>
					<th></th>									
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="userForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
					</div>
					<div class="modal-body">
						<div class="form-group"
							<label for="firstName" class="control-label">First Name*</label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required>			
						</div>
						
						<div class="form-group"
							<label for="lastName" class="control-label">Last Name*</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="last name" required>			
						</div>
						
						<div class="form-group"
							<label for="username" class="control-label">Email*</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>			
						</div>
						
						<div class="form-group"
							<label for="mobile" class="control-label">Mobile*</label>
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile" required>			
						</div>
						
						<div class="form-group"
							<label for="address" class="control-label">Address*</label>
							<textarea class="form-control" id="address" name="address" placeholder="address" required></textarea>		
						</div>
						
						<div class="form-group">
							<label for="status" class="control-label">Role</label>				
							<select id="role" name="role" class="form-control">
							<option value="admin">Admin</option>				
							<option value="user">User</option>	
							</select>						
						</div>	
						
						<div class="form-group">
							<label for="gender" class="control-label">Gender</label>				
							<select id="gender" name="gender" class="form-control">
							<option value="Male">Male</option>				
							<option value="Female">Female</option>	
							</select>						
						</div>

						<div class="form-group"
							<label for="username" class="control-label">New Password</label>
							<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">			
						</div>											
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="userId" id="userId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
	<div id="userDetails" class="modal fade">
		<div class="modal-dialog">    		
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> User Details</h4>
				</div>
				<div class="modal-body">
					<table id="" class="table table-bordered table-striped">
						<thead>
							<tr>						
								<th>Id</th>					
								<th>Name</th>					
								<th>Email</th>
								<th>Gender</th>						
								<th>Mobile</th>	
								<th>Address</th>	
								<th>Created</th>														
							</tr>
						</thead>
						<tbody id="userList">							
						</tbody>
					</table>								
				</div>    				
			</div>    		
		</div>
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
