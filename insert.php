<?php

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Age = $_POST['Age'];
$Role = $_POST['Role'];
$User-rating = $_POST['User-rating'];
$Liked-thing = $_POST['Liked-thing'];
$Improvements = $_POST['Improvements'];
$Comments = $_POST['Comments'];

if( !empty($Name) || !empty($Email) || !empty($Age) ||
	!empty($Current-role) ||!empty($User-rating) ||!empty($Liked-thing) ||!empty($Improvements) ){
	
	$host= "localhost";
	$dbUsername= "root";
	$dbPassword= "";
	$dbname= "users_information";
	
	//creating connection
	
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
	if(mysqli_connect_error){
		die('connect Error('. mysqli_connect_error().')'mysqli_connect_error());
	}
	else{
		$SELECT = "SELECT Email From users_data Where Email = ? Limit 1";
		$INSERT = "INSERT Into users_data (Name, Email, Age, Role, User-rating, Liked-thing, Improvements, Comments) values(?,?,?,?,?,?,?,?)";
		
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if($rnum == 0){
			$stmt->colese();
			
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("ssisssss", $Name, $Email, $Age, $Role, $User-rating, $Liked-thing, $Improvements, $Comments);
			$stmt->execute();
			echo "New Information Recorder Succefully";
		}
		else{
			echo "You Have Already Filled The Form";
		}
		$stmt->close();
		$conn->close();
}
else{
	echo "All feilds are Required";
	die();
?>