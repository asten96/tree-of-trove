<?php
	//connect to database
	
	$mysqli = new mysqli('localhost', 'James', 'leadbucketpipe', 'TestDB');
	echo "poopcycle";
	$action=0;

	//depending on the action value, run a different function
	switch ($action) {
	    case 0:
	    	insertData($mysqli);
	        break;
	    case 1:
	    	deleteData($mysqli);
	    	break;
		case 2:
			getData($mysqli);
			break;
		case 3:
			getDataById($mysqli);
			break;
		case 4:
			login($mysqli);
			break;
	}

	function insertData($mysqli) {
		//insert data
       	$person_firstname="Jaems";
		$person_lastname="Gret";
		echo "InsertDate";
		//if one of the names is missing, do nothing
		// if (($person_firstname == null) || ($person_lastname == null)) {
		// 	return;
		// }

		$query = "INSERT INTO Persons(FirstName, LastName, Age) VALUES ('" . $person_firstname . "', '" . $person_lastname . "', 100)";
		$result = $mysqli->query($query);
		echo "<br>" . repr($result);
	}

	function makeTable($mysqli) {
		$sql  = "CREATE TABLE Persons(FirstName CHAR(30), LastName CHAR(30), Age INT)";
		echo "fuck";
		if(mysqli_query($mysqli, $sql)) {
			echo "Table person created successfully";
		} else {
			echo "ECHOISDJFOISDJFOISDJFOSDJIF" .mysqli_error($con);
		}

	}

	function deleteData($mysqli) {
		//delete data 
        $person_id=$_POST["personId"];

        //if there is no user id, do nothing
        if ($person_id == null) {
			return;
		}

		$query = "DELETE FROM test_table WHERE id=" . $person_id;
		$result = $mysqli->query($query);
	}
	
	function getData($mysqli) {
		//get data
		$query = "SELECT * FROM test_table";
		$result = $mysqli->query($query);
		
		while(list($id, $first_name, $last_name) = $result->fetch_row()) {
			echo $id . " " . $first_name . " " .  $last_name . "<br/>";
		}
	}
	
	function getDataById($mysqli) {
		//get data for row with a particular id
		$person_id=$_POST["personId"];
			
		$query = "SELECT * FROM test_table WHERE id=" . $person_id;
		$result = $mysqli->query($query);
		
		while(list($id, $first_name, $last_name) = $result->fetch_row()) {
			echo $first_name . " " .  $last_name . "<br/>";
		}
	}

	function login($mysqli) {
		//check user login
		$username=$_POST["firstName"];
		$password=$_POST["lastName"];

		if (($username == null) || ($password == null)) {
			echo false;
		}

	    $query = "SELECT * FROM test_table WHERE first_name='$username' AND last_name='$password'";
		$result = $mysqli->query($query);

		//check if user details are in the database
		if (list($first_name, $last_name) = $result->fetch_row()) {
		    echo true;
		} else {
			echo false;
		}
	}

	$mysqli->close();
?>