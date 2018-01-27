<?php 
include 'db.php';

session_start();

$errors="";
if (isset($_POST["email"]) && isset($_POST["password"])) 
{	//echo hash('sha256','MKX120035mkids');
	$email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
	$password = hash('sha256', $_POST["password"]);
	if(filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$req = "SELECT * FROM admins WHERE password = :password AND email = :email";
		$rep = $bdd-> prepare($req);
		$rep->execute(array("password" => $password, ":email" => $email));
		$rows = $rep->fetchall();

		//var_dump($rows);
		if (count($rows) == 1) 
		{
			$rows = $rows[0];
			$_SESSION["name"] = $rows["name"];
			$_SESSION["email"] = $rows["email"];

			//var_dump($_SESSION);
			header('Location: index.php');
  			exit();
		}
		else
		{
			$errors .= "<p> Password or Email are Wrong </p>";
		}
		
	}
	else
	{
		$errors .= "<p> Email Not Valid </p>";
	}

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KidsTube-Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body id="login">
	<div class="container">
		<div class="jumbotron">
			<div class="">
				<h3>Login</h3>
			</div>
			<?php if($errors !=""){ ?>
			<div class="alert alert-danger">
					<?php  echo $errors; ?>
			</div>
			<?php } ?>
			<form action="login.php" method="post">
				<div class="form-group">
					<input class="form-control" type="text" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Password">
				</div>
				<div class="form-inline text-right">
					<button class="btn btn-danger ">Forgot Password</button> 
					<button class="btn btn-primary" type ="submit">Login</button> 
				</div>
				
			</form>
		</div>
	</div>

	<div class="" id="footer">
		<div class="">
		  <p class="text"></p>
		</div>
	</div>


	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="index.js" type="text/javascript"></script>
</body>
</html>

