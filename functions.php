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

class University
{
	public $name; 
	public $location;
	public $description;
	public $students;
	
	public function __construct($name, $location, $description, $students) 
	{
              $this->name = $name;
			  $this->location = $locaton;
			  $this->description = $description;
			  $this->students = $students;
    }
}

class Event_Location
{
		public $time;
		public $date;
		public $e_name;
		public $category;
		public $e_desc;
		public $contact_phone;
		public $contact_email;
		public $type;
		public $up_votes;
		public $d_votes;
		public $super_approval;
		public $admin_approval;
		public $loc_name;
		public $latitude;
		public $longitude;
		
	public function __construct($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $up_votes, $d_votes, $super_approval, $admin_approval, $loc_name, $latitude, $longitude) 
	{
              $this->time = $time;
			  $this->date = $date;
			  $this->e_name = $e_name;
			  $this->category = $category;
			  $this->e_desc = $e_desc;
			  $this->contact_phone = $contact_phone;
			  $this->contact_email = $contact_email;
			  $this->type = $type;
			  $this->up_votes = $up_votes;
			  $this->d_votes = $d_votes;
			  $this->super_approval = $super_approval;
			  $this->admin_approval = $admin_approval;
			  $this->loc_name = $loc_name;
			  $this->latitude = $latitude;
			  $this->longitude = $longitude;
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

function createEvent($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $loc_name, $latitude, $longitude)
{
	$conn = createConnection();
	
	
	
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT * FROM event
	WHERE time = '$time'";
	$result = $conn->query($sql);
	
	//Event Conflict 
	if ($result->num_rows == 0)
	{
		$result->close();
		$sql = "SELECT * FROM location
		WHERE name = '$loc_name'";
		$result = $conn->query($sql);
		
		if ($result->num_rows == 0)
		{
			$result->close();
			$sql = "INSERT INTO event (time, date, name, category, description, contact_phone, contact_email, type, super_approval, admin_approval, up, down)
			VALUES('$time', '$date', '$e_name', '$category', '$e_desc', '$contact_phone', '$contact_email', '$type', 0, 0, 0, 0)";
			$result = $conn->query($sql);
			
			if ($result == TRUE)
			{
				//$result->close();
				$sql = "INSERT INTO location (name, latitude, longitude)
				VALUES('$loc_name', '$latitude', '$longitude')";
				$result = $conn->query($sql);
				
				if ($result == TRUE)
				{
					//$result->close();
					$sql = "INSERT INTO have_location (time, name)
					VALUES('$time', '$loc_name')";
					$result = $conn->query($sql);
					if ($result == TRUE)
					{
						return true;
					}
					else
					{
						$error = $conn->error;
						endConnection($conn);
						return $error;
					}
				}
			}
			
		}
		else
		{
			$error = $conn->error;
			endConnection($conn);
			return $error;
		}
		
	}
	else
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

//returns true if user accounnt was created or false if username is taken 
function createSuperAdmin($name, $password, $email)
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
		$error = $conn->error;
		endConnection($conn);
		return "username taken";
	}
	else 
	{
		//$result->close();
		$sql = "INSERT INTO user (name, password, email)
		VALUES('$name', '$password', '$email')";
		$result = $conn->query($sql);
		
		
		if ($result == TRUE)
		{
			$sql = "SELECT * FROM user
			WHERE name = '$name'";
			
			$result = $conn->query($sql);
			
			
			$row = $result->fetch_assoc();
			$sid = $row["sid"];
			$result->close();
			
			$sql = "INSERT INTO super_admin (sid, name, password, email)
			VALUES('$sid', '$name', '$password','$email')";
			$result = $conn->query($sql);
			
			if ($result == TRUE)
			{
				$error = $conn->error;
				endConnection($conn);
				return $error;
			}
		}
		else
		{
			endConnection($conn);
			return "fail";
		}
	}
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}



//returns object containing user information or false if user not found
function getSuperAdmin($name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT *
	FROM super_admin WHERE name='$name'";
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
		$error = $conn->error;
		endConnection($conn);
		return $error;
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
	
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

//returns university object or false if could not be found
function getUniversity($name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
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
	
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
	
}
	


function createLocation($loc_name, $latitude, $longitude)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
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
	
	
	$error = $conn->error;
		endConnection($conn);
		return $error;
}

function getLocation($loc_name)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
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

function createAdmin($name, $password, $email)
{
	$conn = createConnection();
	if ($conn->connect_error) 
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT * FROM admin
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
		$sql = "INSERT INTO admin (name, password, email)
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