<?php
if(isset($_POST['adno']) && isset($_POST['username1']) && isset($_POST['email1']) && isset($_POST['pass1']) && isset($_POST['pass2']))
{
  $adno_p = $_POST["adno"];
  $username_p = $_POST["username1"];
  $email_p = $_POST["email1"];
  $password_p = $_POST["pass1"];
  $cpassword_p= $_POST["pass2"];
}
  $servername="localhost";
	$username="root";
	$password="";
	$dbname="studlogin";

	$conn=mysqli_connect($servername,$username,$password,$dbname);
	
	if (isset($_POST['save'])) 
		{

		if (!$conn)
		{
			die('could not connect:' .mysqli_connect_error());
		}
		else
		{
			$sql="INSERT INTO `signup` (`srno`, `adno`, `username`, `Email`, `Password`,``CPassword`)VALUES('',$adno_p','$username_p','$email_p','$password_p','$cpassword_p')";
			mysqli_query($conn,$sql);
			$conn->close();
		}
	}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="student.css">
  <title>SignUp</title>
  <script>
    function validpass()
    {
          var add=document.myform.adno.value;
          var em=document.myform.email1.value;
          var pw=document.myform.pass1.value;
          var pw2=document.myform.pass2.value;
            if(!add.match(/^([0-9]{4})+([A-Z]{2})+([0-9]{4})$/))
            {
               alert('Enter valid Addmision number....');
            return false;
            }
            else if(!em.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})+\.([A-Za-z]{2,4})+\.([A-Za-z]{2,4})$/))
            {
              alert('Enter valid mes email....');
            return false;
            }

            else if(!pw.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/)) 
            { 
              
              alert('Enter valid password....eg.User@123');
            return false;
            }
            
            else if(pw != pw2) 
            {
              alert('Enter Both password same....');
            return false;
            }
            else
            {
              return true
            }
          
    }
  </script>
  
</head>

<body>

  <div class="container my-4">
    <h1 class="text-center" style="color:white ;" >Signup to our website</h1>
    <form action="/login/login.php" method="POST" name="myform" class="sigup" onsubmit="return validpass()">
    <div class="form-group">
        <label for="adno"  style="color:white ;" >Admission No</label>
        <input type="text" class="form-control" id="username" name="adno" aria-describedby="emailHelp" required>

      </div>  
    <div class="form-group">
        <label for="username" style="color:white ;" >Username</label>
        <input type="text" class="form-control" id="username" name="username1" aria-describedby="emailHelp" required>

      </div>
      <div class="form-group">
        <label for="email" style="color:white ;" >Email</label>
        <input type="email" class="form-control" id="username" name="email1" aria-describedby="emailHelp" required>

      </div>
      <div class="form-group">
        <label for="password" style="color:white ;" >Password</label>
        <input type="password" class="form-control" id="password" name="pass1" required>
      </div>
      <div class="form-group">
        <label for="cpassword" style="color:white ;"  >Confirm Password</label>
        <input type="password" class="form-control" id="cpassword" name="pass2" required>
        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
      </div>

      <button type="submit" name="save" class="btn btn-primary">SignUp</button>
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>