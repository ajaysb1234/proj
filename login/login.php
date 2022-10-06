<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log IN </title>
  <link rel="stylesheet" href="student.css">
  <link rel="script" href="student.js" type="text/javascript">
  <link rel="stylesheet" href="/login/student.css">
  <script>
    function validpass() {
      var pw = document.myform.pass.value;

      if (pw.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/)) {

        return true;
      } else {
        alert('Enter valid password.. eg.User@12');
        return false;
      }

    }
  </script>
</head>

<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title login"> Login </div>
    </div>
    <div class="form-container">
    </div>
    <div class="form-inner">
      <form action="welcome.php" name="myform" class="login" onsubmit="return validpass()">
        <div class="field">
          <input type="text" name="name1" placeholder="Username" required>
        </div>
        <div class="field">
          <input type="password" name="pass" placeholder="Password" required>
        </div>
        <div class="pass-link"><a href="#">Forgot password?</a></div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Login">
        </div>
        <div class="signup-link">Not a member? <a href="signup.php">Signup now</a></div>
      </form>

    </div>
  </div>
  </div>

</body>

</html>