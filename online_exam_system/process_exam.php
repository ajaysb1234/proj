<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Exam.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if(!$user->loggedIn()) {
	header("Location: index.php");
}

$exam = new Exam($db);
if(!empty($_GET['exam_id'])) {
	$exam->exam_id = $_GET['exam_id'];
	$examDetails = $exam->getExamInfo();	
}

$exam->examProcessUpdate();
$examProcessDetails = $exam->getExamProcessDetails();

$remainingMinutes = '';
$examDateTime = $examProcessDetails['start_time'];
$duration = $examDetails['duration'] . ' minute';
$examEndTime = strtotime($examDateTime . '+' . $duration);
$examEndTime = date('Y-m-d H:i:s', $examEndTime);
$remainingMinutes = strtotime($examEndTime) - time();
$currentTime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));
include('inc/header.php');
?>
<title>Online Exam System with PHP & MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="css/TimeCircles.css" />
<script src="js/TimeCircles.js"></script>
<script src="js/user_exam.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div class="container" style="background-color:#f4f3ef;">  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>	
	<br>	
	<div id="processExamId" data-exam_id="<?php echo $examDetails['id']; ?>"> 	
<?php 
if($currentTime < $examEndTime) {
?>	
	<div class="col-md-8">
		<div class="card">			
			<div class="card-body">
				<div id="single_question_area"></div>
			</div>
		</div>
		<br />
		<div id="question_navigation_area"></div>
	</div>
	<div class="col-md-4">
		<br />
		<div align="center">
			<div id="examTimer" data-timer="<?php echo $remainingMinutes; ?>" style="max-width:400px; width: 100%; height: 200px;"></div>
		</div>
		<br />
		<div id="user_details_area"></div>		
	</div>
<?php } ?>	

<?php
if($currentTime >= $examEndTime) {	
	$examResult =  $exam->getExamResults();		
?>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-md-8">Online Exam Result</div>				
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tr>
						<th>Question</th>
						<th>Option 1</th>
						<th>Option 2</th>
						<th>Option 3</th>
						<th>Option 4</th>
						<th>Your Answer</th>
						<th>Answer</th>
						<th>Result</th>
						<th>Marks</th>
					</tr>
					<?php					
					foreach($examResult as $results) {						
						$examResults  = $exam->getQuestopnOptions($results["question_id"]);						
						$userAnswer = '';
						$orignalAnswer = '';
						$questionResult = '';
						if($results['marks'] == '0'){
							$questionResult = '<h4 class="badge badge-dark">Not Attend</h4>';
						}
						if($results['marks'] > '0')	{
							$questionResult = '<h4 class="badge badge-success">Right</h4>';
						}
						if($results['marks'] < '0')	{
							$questionResult = '<h4 class="badge badge-danger">Wrong</h4>';
						}
						echo '
						<tr>
							<td>'.$results['question'].'</td>';

						foreach($examResults as $questionOption){
							echo '<td>'.$questionOption["title"].'</td>';
							if($questionOption["option"] == $results['user_answer_option']) {
								$userAnswer = $questionOption['title'];
							}
							if($questionOption['option'] == $results['answer']){
								$orignalAnswer = $questionOption['title'];
							}
						}
						echo '
						<td>'.$userAnswer.'</td>
						<td>'.$orignalAnswer.'</td>
						<td>'.$questionResult.'</td>
						<td>'.$results["marks"].'</td>
					</tr>';
					}
					$marksResult = $exam->getExamTotalMarks();
					foreach($marksResult as $marks){
					?>
					<tr>
						<td colspan="8" align="right">Total Marks</td>
						<td align="right"><?php echo $marks["mark"]; ?></td>
					</tr>
					<?php	
					}
					?>
				</table>
			</div>
		</div>
	</div>
<?php
}
?>		
</div>
 <?php include('inc/footer.php');?>
