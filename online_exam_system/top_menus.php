<h3><?php if($_SESSION["userid"]) { echo "Logged in: ".ucfirst($_SESSION["name"]); } ?> | <a href="logout.php">Logout</a> </h3><br>
<p><strong>Welcome <?php echo ucfirst($_SESSION["role"]); ?></strong></p>	
<ul class="nav nav-tabs">	
	<?php if($_SESSION["role"] == 'admin') { ?>
		<li id="exam" class="active"><a href="exam.php">Exam</a></li>
		<li id="user"><a href="user.php">Users</a></li>				
	<?php } ?>	
	<?php if($_SESSION["role"] == 'user') { ?>
		<li id="enroll_exam"><a href="enroll_exam.php">Enrol Exam</a></li>
		<li id="view_exam"><a href="view_exam.php">My Exam</a></li>			
	<?php } ?>
</ul>