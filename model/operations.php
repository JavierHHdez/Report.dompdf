<?php 
	
	$id 			= $_POST['id'];
	$nameCountry 	= $_POST['name'];
	$sahortDesc 	= $_POST['shortDesc'];
	$longDesc 		= $_POST['longDesc'];
	$username 		= $_POST['username'];
	$password 		= $_POST['password'];

	require_once('../dbconfig/connection.php');
	$database = Connection::getInstance();

	if(isset($_POST['key'])){

		switch ($_POST['key']) {
			case 'AddNew':
					$response = $database->crud("INSERT INTO country(countryName,shortDesc,longDesc) VALUES('".$nameCountry."','".$sahortDesc."','".$longDesc."')");
   					die(json_encode($response == true ? 'Update successfully' : 'Failed Operation'));
				break;

			case 'Update':
					$response = $database->crud("UPDATE country SET countryName = '".$nameCountry."', shortDesc = '".$sahortDesc."', longDesc = '".$longDesc."' WHERE id = '".$id."'");

   					die(json_encode($response == true ? 'Update successfully' : 'Failed Operation'));

				break;

			case 'Delete':
					$response = $database->crud("DELETE FROM country WHERE id = '".$id."' ");
   					die(json_encode('Delete successfully'));
				break;

			case 'getById':
					$response = $database->getById("SELECT * FROM country WHERE id = '".$id."' ");

					$data = $response->fetch_array();

					$jsonArray = [
						'id' 			=> $data['id'],
						'countryName' 	=> $data['countryName'],
						'shortDesc' 	=> $data['shortDesc'],
						'longDesc' 		=> $data['longDesc'],
					];

					exit(json_encode($jsonArray));

				break;

			case 'Login':
					
					session_start();

					$response = $database->getById("SELECT name, user_type FROM usuarios WHERE username = '".$username."' AND password = '".$password."' ");

					if ($response->num_rows == 1) {
						
						$data = $response->fetch_assoc();
						
						$_SESSION['usuario'] = $data;

						die(json_encode(['error' => false, 'tipo' => $data['user_type']]));
					}else {
						die(json_encode(['error' => true]));
					}

				break;
			
			default:
					 die(json_encode("No Found Operations Specific"));

				break;
		}
	}
?>
