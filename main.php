<?php 

include 'db_connection.php';

if (isset($_POST['clientForm'])) {
    addClient();
}


function addClient() 
{
	$data = [
	    'name' => isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : "Bobby",
		'surname' => isset($_POST['surname']) && !empty($_POST['surname']) ? $_POST['surname'] : "Drake",
		'phone' =>  isset($_POST['phone']) && !empty($_POST['phone']) ? $_POST['phone'] : "",
		'commentary' =>  isset($_POST['commentary']) && !empty($_POST['commentary']) ? $_POST['commentary'] : "Heya",
	];

	if (validate($data) != true) {
	    echo "Wrong form data has been sent";
	} else { 
		$name = $data['name'];
		$surname = $data['surname'];
		$phone = $data['phone'];
		$commentary = $data['commentary']; 
		
		$conn = OpenCon();
		$sql = "INSERT INTO clients (name, surname, phone, commentary)       
		        VALUES ('{$name}', '{$surname}', '{$phone}', '{$commentary}')";
		$res = $conn->query($sql) or die(mysqli_error($conn));
		
		CloseCon($conn);
		
		header("Location: public/index.html");
	}
}


function validate($data) {
	$name = $data['name'];
	$surname = $data['surname'];
	$phone = $data['phone'];
	$commentary = $data['commentary'];
	
	if (preg_match('/^[a-zA-Z\-]{2,150}$/', $name) == false) return false;
	if (preg_match('/^[a-zA-Z\-]{2,150}$/', $surname) == false) return false;
    if (preg_match('/^[0-9]{10}$/', $phone) == false) return false;
	
	
	return true;
}


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$res = getClients();
	echo json_encode($res);							
} 


function getClients() 
{
	$conn = OpenCon(); 
	
	$sql = "SELECT * FROM clients ORDER BY name ASC, surname DESC";
	$res = $conn->query($sql) or die(mysqli_error($conn));
	
	$arr = array();
	while ($r = mysqli_fetch_assoc($res)) {
	   	$arr[] = $r;
	}
    
	
	return $arr;
}
