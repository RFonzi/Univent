<?php

class User
{
	public $sid;
	public $username;
	public $password;
	public $email;
	
	
	public function __construct($sid, $username, $password, $email) 
	{
              $this->sid = $sid;
			  $this->username = $username;
			  $this->password = $password;
			  $this->email = $email;
    }
}
// do not call this directly
function createConnection()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mydb";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error || $conn == null)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

//do not call this directly
function endConnection($conn)
{
	$conn->close();
	return;
}

//returns object containing user information or false if user not found
function getUser($name, $password)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT *
	FROM user WHERE name='$name' 
	AND password='$password'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$user = new User($row["sid"], $row["name"], $row["password"], $row["email"]);
		endConnection($conn);
		return $user;
	}
	else 
	{
		endConnection($conn);
		return FALSE;
	}
	
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

//returns true if user accounnt was created or false if username is taken 
function createUser($name, $password, $email)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT * FROM user
	WHERE name = '$name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return FALSE;
	}
	else 
	{
		$result->close();
		$sql = "INSERT INTO user (name, password, email)
		VALUES('$name', '$password', '$email')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return TRUE;
		}
	}
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

//returns true if university created successfully or false if name is taken
function createUniversity($name, $location, $description, $students)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT * FROM University
	WHERE name = '$name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}
	else 
	{
		 $result->close();
		$sql = "INSERT INTO University (name, location, description, students)
		VALUES('$name', '$location', '$description', '$students')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return true;
		}
	}
	
	
	endConnection($conn);
	return $result->error;
}

//returns university object or false if could not be found
function getUniversity($name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT *
	FROM University WHERE name='$name'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		return "university found";
	}
	else 
	{
		endConnection($conn);
		return false;
	}
	
	
	endConnection($conn);
	return $result->error;
}

function createEvent($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $up_votes, $d_votes, $super_approval, $admin_approval)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT * FROM Event
	WHERE time = '$time'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}
	else 
	{//check time function
		$result->close();
		$sql = "INSERT INTO Event (time, date, e_name, category, e_desc, contact_phone, contact_email, type, up_votes, d_votes, super_approval, admin_approval)
		VALUES($time, '$date', '$e_name', '$category', '$e_desc', '$contact_phone', '$contact_email', '$type', '$up_votes', '$d_votes', '$super_approval', '$admin_approval')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return true;
		}
	}
	
	
	endConnection($conn);
	return $result->error;
}

function getEvent($time)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT *
	FROM Event WHERE time='$time'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		return true;
	}
	else 
	{
		endConnection($conn);
		return false;
	}
	
	
	endConnection($conn);
	return $result->error;
}

function createLocation($loc_name, $latitude, $longitude)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT * FROM Location
	WHERE loc_name = '$loc_name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}
	else 
	{
		 $result->close();
		$sql = "INSERT INTO Location (loc_name, latitude, longitude)
		VALUES('$loc_name', '$latitude', '$longitude')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return true;
		}
	}
	
	
	endConnection($conn);
	return $result->error;
}

function getLocation($loc_name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT *
	FROM Location WHERE loc_name='$loc_name'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		return "location found";
	}
	else 
	{
		endConnection($conn);
		return false;
	}
	
	
	endConnection($conn);
	return $result->error;
}

function getRSO($name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT *
	FROM RSO WHERE name='$name'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		return "RSO found";
	}
	else 
	{
		endConnection($conn);
		return false;
	}
	
	
	endConnection($conn);
	return "tacos";
}

function createRSO($r_name, $s_count, $university, $rso_desc)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return $conn->error;
	}
	
	$sql = "SELECT * FROM RSO
	WHERE r_name = '$r_name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}
	else 
	{
		 $result->close();
		$sql = "INSERT INTO Location (r_name, s_count, university, rso_desc)
		VALUES('$r_name', '$s_count', '$university', '$rso_desc')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return true;
		}
	}
	
	
	endConnection($conn);
	return $result->error;
}