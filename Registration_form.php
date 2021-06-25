<?php 
	define("filepath", "user.json");
	$fullName = $address=  $phone=  $userName = $password = "";
	$isValid = true;
	$fullNameErr  = $addressErr =   $phoneErr = $userNameErr = $passwordErr = "";
	$successfulMessage = $errorMessage = "";
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$fullName = $_POST['fullname'];
		
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$userName = $_POST['username'];
		$password = $_POST['password'];
		if(empty($fullName)) {
			$fullNameErr = "Full name can not be empty!";
			$isValid = false;
		}
		
		
		if(empty($address)) {
			$addressErr = "Address can not be empty!";
			$isValid = false;
		}
		if(empty($phone)) {
			$phoneErr = "Phone Number can not be empty!";
			$isValid = false;
		}
		
		if(empty($userName)) {
			$userNameErr = "User name can not be empty!";
			$isValid = false;
         }
		if(empty($password)) {
			$passwordErr = "Password can not be empty!";
			$isValid = false;
		}
		if($isValid) {
			$fullName = test_input($fullName);
			
			$address = test_input($address);
			$phone = test_input($phone);
			$userName = test_input($userName);
			$password = test_input($password);

			$arr1 = array('fullname' => $fullName,'address' => $address,'phone' => $phone, "username" => $userName, "password" => $password);
			$arr1_encode = json_encode($arr1);
			$response = write($arr1_encode);
			if($response) {
				$successfulMessage = "Successfully saved.";
			}
			else {
				$errorMessage = "Error while saving.";
			}
		}
	}
	function write($content) {
			$resource = fopen(filepath, "a");
			$fw = fwrite($resource, $content . "\n");
			fclose($resource);
			return $fw;
	}
	function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<body style="background-color:#1c87c9;">
	<meta charset="utf-8">
	<title>Registration Form</title>
</head>
<body>
	<h1 style="background-color:violet;">Bus Management System</h1>
<fieldset>
	<legend>Registration Form</legend>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		
			

			<label for="fullname">Full Name:</label>
			<input type="text" name="fullname" id="fullname">
			<span style="color:red"><?php echo $fullNameErr; ?></span>

			<br><br>
            <label for="address">Address:</label>
			<input type="text" name="address" id="address">
			<span style="color:red"><?php echo $addressErr; ?></span>

			<br><br>
			<label for="phone">Phone Number:</label>
			<input type="tel" name="phone" id="phone">
			<span style="color:red"><?php echo $phoneErr; ?></span>

			<br><br>

			<label for="username">Username:</label>
			<input type="text" name="username" id="username">
			<span style="color:red"><?php echo $userNameErr; ?></span>

			<br><br>

			<label for="password">Password:</label>
			<input type="password" name="password" id="password">
			<span style="color:red"><?php echo $passwordErr; ?></span>

			<br><br>

			<input type="submit" name="submit" value="Register">
		</fieldset>
	</form>

	<p style="color:green;"><?php echo $successfulMessage; ?></p>
	<p style="color:red;"><?php echo $errorMessage; ?></p>

	<br>

	<p>Back to<a href="http://localhost/Lab/BUS%20MANAGEMENT%20SYSTEM/Home_page.php">Login</a></p>

</body>
</html>