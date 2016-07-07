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
	$dbname = "myDB";
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
function getUser($username, $password)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT *
	FROM Users WHERE username='$username' 
	AND password='$password'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$user = new User($row["sid"], $row["username"], $row["password"], $row["email"]);
		endConnection($conn);
		return $user;
	}
	else 
	{
		endConnection($conn);
		return FALSE;
	}
	
	
	endConnection($conn);
	return $conn->error;
}

//returns object containing user information or false if username is taken 
function createUser($username, $password, $email)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT * FROM Users
	WHERE username = '$username'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return "Username Taken.";
	}
	else 
	{
		 $result->close();
		$sql = "INSERT INTO Users (username, password, email)
		VALUES('$username', '$password', '$email')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return "Account Created.";
		}
	}
	
	
	endConnection($conn);
	return "tattateatata";
}

//returns object containing university information or false if name is taken
function createUniversity($name, $location, $description, $students)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT * FROM University
	WHERE name = '$name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return "University Name Taken.";
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
			return "University Created.";
		}
	}
	
	
	endConnection($conn);
	return "tattateatata";
}


function getUniversity($name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
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
		return "not found";
	}
	
	
	endConnection($conn);
	return "tacos";
}

function createEvent($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $up_votes, $d_votes, $super_approval, $admin_approval)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT * FROM Event
	WHERE time = '$time'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return "Event Time Taken.";
	}
	else 
	{//check time function
		$result->close();
		$sql = "INSERT INTO Event (time, date, e_name, category, e_desc, contact_phone, contact_email, type, up_votes, d_votes, super_approval, admin_approval)
		VALUES(time(), '$date', '$e_name', '$category', '$e_desc', '$contact_phone', '$contact_email', '$type', '$up_votes', '$d_votes', '$super_approval', '$admin_approval')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{
			endConnection($conn);
			return "Event Created.";
		}
	}
	
	
	endConnection($conn);
	return "tattateatata";
}

function getEvent($time)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT *
	FROM Event WHERE time='$time'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
	{
		return "event found";
	}
	else 
	{
		endConnection($conn);
		return "not found";
	}
	
	
	endConnection($conn);
	return "tacos";
}

function createLocation($loc_name, $latitude, $longitude)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT * FROM Location
	WHERE loc_name = '$loc_name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return "Location Taken.";
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
			return "Event Created.";
		}
	}
	
	
	endConnection($conn);
	return "tattateatata";
}

function getLocation($loc_name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
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
		return "not found";
	}
	
	
	endConnection($conn);
	return "tacos";
}

function getRSO($name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
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
		return "not found";
	}
	
	
	endConnection($conn);
	return "tacos";
}

function createRSO($r_name, $s_count, $university, $rso_desc)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		return "error connecting";
	}
	
	$sql = "SELECT * FROM RSO
	WHERE r_name = '$r_name'";
	$result = $conn->query($sql);
	
	//username taken
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return "RSO Name Taken.";
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
			return "RSO Created.";
		}
	}
	
	
	endConnection($conn);
	return "tattateatata";
}