<?php
// this will be your backend
// some things this file should do
// get query string 
// handle get requests
// open and read data.csv file
// handle post requests
// (optional) write to csv file. 
// format data into an array of objects 
// return all data for every request. 
// set content type of response.
// return JSON encoded data

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];

/**read csv file*/
function readData() {
	$data = array();
	if (($file_handle = fopen("data.csv", "r")) !== FALSE) {
		$count=1;
		while (($d = fgetcsv($file_handle, 1000, ",")) !== FALSE) {
			if($count==1) {$count++; continue;}
			$obj = (object) ["id"=>$d[0], "name"=>$d[1], "state"=>$d[2], "zip"=>$d[3], "amount"=>$d[4], "qty"=>$d[5], "item"=>$d[6]];
			array_push($data, $obj);
		}
		fclose($file_handle);
		return $data;
	}
}

/**write data*/
function writeData() {
	$input = (array) json_decode(file_get_contents('php://input'), TRUE);
	$data = readData();
	$obj = (object) ["id"=>$input['id'], "name"=>$input['name'], "state"=>$input['state'], "zip"=>$input['zip'], "amount"=>$input['amount'], "qty"=>$input['qty'], "item"=>$input['item']];
	array_push($data, $obj);
	return $data;
}

/**findById data*/
function findById() {
	$id = $_GET['id'];
	$data = readData();
	$updatedArray = array();

	foreach($data as &$value) {
		if($value->id == $id) {
			return $value;	
		} 		
	}
	return $updatedArray;
}


/**update data*/
function updateData() {
	$input = (array) json_decode(file_get_contents('php://input'), TRUE);
	$data = readData();
	$updatedArray = array();

	foreach($data as &$value) {
		if($value->id == $input['id']) {
			array_push($updatedArray, $input);	
		} else{
			array_push($updatedArray, $value);	
		}		
	}
	return $updatedArray;
}

/**delete data*/
function deleteData() {
	$id = $_GET['id'];
	$data = readData();
	$updatedArray = array();

	foreach($data as &$value) {
		if($value->id != $id) {
			array_push($updatedArray, $value);	
		}	
	}
	return $updatedArray;
}

if($requestMethod == 'GET'){	
	if(isset($_GET['id'])) {
		echo json_encode(findById());
	} else {
		echo json_encode(readData());
	}
	
} elseif($requestMethod == 'POST'){
	echo json_encode(writeData());
} elseif($requestMethod == 'PUT'){
	echo json_encode(updateData());
} elseif($requestMethod == 'DELETE'){
	echo json_encode(deleteData());
}
?>