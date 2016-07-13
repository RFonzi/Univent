<?php

class EventHelper
{
	public $name;
	public $time;
	
	public function __construct($name, $time)
	{
              $this->name = $name;
			  $this->time = $time;
    }
}

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

	public function __toString()
	{
		return $this->sid . "/" . $this->username . "/" . $this->password . "/" . $this->email;
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
			  $this->location = $location;
			  $this->description = $description;
			  $this->students = $students;
    }
}

class Comment
{
	public $sid;
	public $time;
	public $name;
	public $timestamps;
	public $text;
	
	public function __construct($sid, $time, $name, $timestamps, $text)
	{
              $this->sid = $sid;
			  $this->time = $time;
			  $this->name = $name;
			  $this->timestamps = $timestamps;
			  $this->text = $text;
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

class RSO
{
	public $rid;
	public $name;
	public $students;
	public $university;
	public $description;
	
	public function __construct($rid, $name, $students, $university, $description)
	{
              $this->rid = $rid;
			  $this->name = $name;
			  $this->students = $students;
			  $this->university = $university;
			  $this->description = $description;
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

function getMyRSO($user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT rid FROM ownsrso WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	
	//return $user->sid;
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}
	else
	{
		$row = $result->fetch_assoc();
		$temp = $row["rid"];
		endConnection($conn);
		return $temp;
	}
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function checkEmail($email, $university)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT sid FROM student where email = '$email'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$temp =  $row["sid"];
	
	$sql = "SELECT name from univ_affil WHERE sid = '$temp'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	if($row["name"] != $university)
	{
		endConnection($conn);
		return false;
	}
	else
	{
		endConnection($conn);
		return true;
	}
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function upVote($time, $name)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT * from have_location WHERE time = '$time' AND name = '$name'";
	$result = $conn->query($sql);
	
	if($result == null)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}
	
	$sql = "UPDATE event set up = up + 1 WHERE time = '$time'";
	$result = $conn->query($sql);
	
	if($result == true)
	{
		endConnection($conn);
		return true;
	}
	
	//$sql = "UPDATE rso set students = students + 1 WHERE rid = '$rid';";
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function downVote($time, $name)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "SELECT * from have_location WHERE time = '$time' AND name = '$name'";
	$result = $conn->query($sql);
	
	if($result == null)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}
	
	$sql = "UPDATE event set down = down + 1 WHERE time = '$time'";
	$result = $conn->query($sql);
	
	if($result == true)
	{
		endConnection($conn);
		return true;
	}
	
	//$sql = "UPDATE rso set students = students + 1 WHERE rid = '$rid';";
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function getComments($time, $name)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	$comments = array();
	
	$sql = "SELECT * from comments WHERE time = '$time' AND name = '$name'";
	$result = $conn->query($sql);
	
	//SELECT *
	//FROM joinsrso WHERE sid = '$user->sid' AND rid = $rid";
	
	if($result == null)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}
	
	while($row = $result->fetch_assoc())
	{
		$comments[] = new Comment($row["sid"], $row["time"], $row["name"], $row["timestamps"], $row["text"]);
	}
	//$locations[] = new EventHelper($row["name"], $times[$i]);
	endConnection($conn);
	return $comments;
	
	//public function __construct($sid, $time, $name, $timestamps, $text)
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function createComment($sid, $time, $name, $text)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}
	
	$sql = "INSERT INTO comments (sid, time, name, timestamps, text)
	VALUES ('$sid', '$time', '$name', now(), '$text')";
	$result = $conn->query($sql);
	
	if($result == true)
	{
		endConnection($conn);
		return true;
	}
	$result->close();
	
	
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}


function joinRSO($rid, $name, $university, $user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	//user is a student/admin
	if(getUserLevel($user->sid) == 3 || getUserLevel($user->sid) == 0)
	{
		endConnection($conn);
		return false;
	}

	
	//getting uni name
	$sql = "SELECT *
	FROM univ_affil WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$c_name = $row["name"];
	$result->close();


	$sql = "SELECT *
	FROM university WHERE name = 'UCF'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	//user is joining a rso from their uni
	if ($university != $row['name'])
	{
		endConnection($conn);
		return false;
	}

	$result->close();
	
	//user is not a part of this rso already
	$sql = "SELECT *
	FROM joinsrso WHERE sid = '$user->sid' AND rid = $rid";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}

	$result->close();

	//user does not own this rso
	$sql = "SELECT *
	FROM ownsrso WHERE sid = '$user->sid' AND rid = $rid";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}

	$result->close();

	$sql = "INSERT INTO joinsrso (rid, sid)
			VALUES('$rid', '$user->sid')";
	$result = $conn->query($sql);
	if ($result == True)
	{
		$sql = "UPDATE rso set students = students + 1 WHERE rid = '$rid';";
		$result = $conn->query($sql);
		if ($result == True)
		{
			endConnection($conn);
			return true;
		}
	}

	$error = $conn->error;
	endConnection($conn);
	return $error;

}

function joinUniversity($name, $user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	if(getUserLevel($user->sid) == 3 || getUserLevel($user->sid) == 2 || getUserLevel($user->sid) == 1)
	{
		endConnection($conn);
		return false;
	}

	$sql = "SELECT *
	FROM university WHERE name = '$name'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}

	$result->close();

	$sql = "SELECT *
	FROM univ_affil WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}

	$result->close();

	$sql = "INSERT INTO student (sid, name, password, email)
			VALUES('$user->sid', '$user->username', '$user->password', '$user->email')";
	$result = $conn->query($sql);
	if ($result == True)
	{
		$sql = "INSERT INTO univ_affil (name, sid)
		VALUES('$name', '$user->sid')";

		$result = $conn->query($sql);
		if ($result == True)
		{
			$sql = "UPDATE university set students = students + 1 WHERE name = '$name'";
			$result = $conn->query($sql);
			if ($result == True)
			{
				endConnection($conn);
				return true;
			}
		}
	}



	$error = $conn->error;
	endConnection($conn);
	return $error;

}

function createRSO($rname, $uni_name, $rso_desc, $user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	if(getUserLevel($user->sid) == 3 || getUserLevel($user->sid) == 2 || getUserLevel($user->sid) == 0)
	{
		return false;
	}

	$temp = $user->sid;
	//return $user->sid;

	$sql = "SELECT *
	FROM RSO WHERE name = '$rname'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}
	else


	{
		//result->close();
		$sql = "INSERT INTO rso (name, students, university, description)
		VALUES('$rname', 1, '$uni_name', '$rso_desc')";
		$result = $conn->query($sql);
		if ($result == TRUE)
		{

			$last_id = $conn->insert_id;
			//return $conn->error;

			//$result->close();
			$sql = "INSERT INTO ownsrso (rid, sid)
			VALUES('$last_id', '$temp')";
			$result = $conn->query($sql);

			if ($result == TRUE)
			{
				//$result->close();
				$sql = "INSERT INTO admin (sid, name, password, email)
				VALUES('$user->sid', '$user->username', '$user->password', '$user->email')";
				$result = $conn->query($sql);

				if ($result == TRUE)
				{
					$sql = "INSERT INTO createsrso (rid, sid)
					VALUES('$last_id', '$temp')";
					$result = $conn->query($sql);
					if ($result == TRUE)
					{
						endConnection($conn);
						return true;
					}
				}

			}
		}
	}

	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function getUserLevel($sid)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	$sql = "SELECT *
	FROM super_admin WHERE sid = '$sid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return 3;
	}

	$result->close();

	$sql = "SELECT *
	FROM admin WHERE sid = '$sid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return 2;
	}
	$result->close();

	$sql = "SELECT *
	FROM student WHERE sid = '$sid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return 1;
	}

	$sql = "SELECT *
	FROM user WHERE sid = '$sid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return 0;
	}

	endConnection($conn);
	return -1;
}

function getPublicEvents()
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	//$level = getUserLevel($user->sid);
	$locatons = array();
	$times = array();
	$final = array();

	$sql = "SELECT *
	FROM event WHERE category = 'public'";
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}

	
	

	while($row = $result->fetch_assoc())
	{
		$times[] = $row["time"];
		
	}
	//return $times;
	
	$result->close();
	
	$sql = "SELECT *
		FROM have_location";
		$result = $conn->query($sql);
	
	//get all place names
	while($row = $result->fetch_assoc())
	{
		for($i = 0; $i < count($times); $i++)
		{
			if($row["time"] == $times[$i])
			{
				$locations[] = new EventHelper($row["name"], $times[$i]);
			}
			
		}
		
	}
	//return $locations;
	$result->close();
	
	for($i = 0; $i < count($locations); $i++)
	{
		//events
		$timehelper = $locations[$i]->time;
		$sql = "SELECT *
		FROM event WHERE time ='$timehelper'";
		$result = $conn->query($sql);
		
		//locations
		$namehelper = $locations[$i]->name;
		$sql = "SELECT *
		FROM location WHERE name = '$namehelper'";
		$result2 = $conn->query($sql);
		
		$row = $result->fetch_assoc();
		$row2 = $result2->fetch_assoc();
		
		$final[] = new Event_Location ($row["time"], $row["date"], $row["name"], $row["category"], $row["description"], $row["contact_phone"], 
		$row["contact_email"], $row["type"], $row["up"], $row["down"], $row["super_approval"], $row["admin_approval"], $row2["name"], 
		$row2["latitude"], $row2["longitude"]);
		
		$result->close();
		$result2->close();
		
	}
	endConnection($conn);
	return $final;
	//public function __construct($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $up_votes, $d_votes, 
	//$super_approval, $admin_approval, $loc_name, $latitude, $longitude)
	//$user = new User($row["sid"], $row["name"], $row["password"], $row["email"]);y
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function getRSOEvents($user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	//$level = getUserLevel($user->sid);
	$locations = array();
	$times = array();
	$final = array();
	$studentrso = array();
	$rso_loc = array();
	
	//get rsos of student
	$sql = "SELECT *
	FROM joinsrso WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc())
	{
		$studentrso[] = $row["rid"];
	}
	
	$result->close();
	
	$sql = "SELECT *
	FROM ownsrso WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	
	if($result != null)
	{
		while($row = $result->fetch_assoc())
		{
			$studentrso[] = $row["rid"];
		}
	}
	$result->close();
	//return $studentrso;
	
	$sql = "SELECT *
	FROM event WHERE category = 'RSO'";
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}

	
	

	while($row = $result->fetch_assoc())
	{
		$times[] = $row["time"];
		
	}
	//return $times;
	
	$result->close();
	
	$sql = "SELECT *
		FROM have_location";
		$result = $conn->query($sql);
	
	//get all place names
	while($row = $result->fetch_assoc())
	{
		for($i = 0; $i < count($times); $i++)
		{
			if($row["time"] == $times[$i])
			{
				$locations[] = new EventHelper($row["name"], $times[$i]);
			}
			
		}
		
	}
	//return $locations;
	$result->close();
	
	//filter
	for($i = 0; $i < count($locations); $i++)
	{
		$timehelper2 = $locations[$i]->time;
		$namehelper2 = $locations[$i]->name;
		$sql = "SELECT rid
		FROM admin_creates_event WHERE name = '$namehelper2' AND time = '$timehelper2'";
		$result = $conn->query($sql);
		$row3 = $result->fetch_assoc();
		
		//$searchrid = $row3["rid"];
		$result->close();
		
		/*
		$sql = "SELECT name
		FROM univ_affil WHERE sid = '$searchsid'";
		$result = $conn->query($sql);
		$row3 = $result->fetch_assoc();
		//return $row3["name"];
		*/
		for($j = 0; $j < count($studentrso); $j++)
		{
			if($row3["rid"] == $studentrso[$j])
			{
				$rso_loc[] = $locations[$j];
			}
		}
	}
	
	//$rso_loc = array_values($rso_loc);
	
	//return $locations;
	
	
	for($i = 0; $i < count($rso_loc); $i++)
	{
		//events
		$timehelper = $rso_loc[$i]->time;
		$sql = "SELECT *
		FROM event WHERE time ='$timehelper'";
		$result = $conn->query($sql);
		
		//locations
		$namehelper = $rso_loc[$i]->name;
		$sql = "SELECT *
		FROM location WHERE name = '$namehelper'";
		$result2 = $conn->query($sql);
		
		$row = $result->fetch_assoc();
		$row2 = $result2->fetch_assoc();
		
		$final[] = new Event_Location ($row["time"], $row["date"], $row["name"], $row["category"], $row["description"], $row["contact_phone"], 
		$row["contact_email"], $row["type"], $row["up"], $row["down"], $row["super_approval"], $row["admin_approval"], $row2["name"], 
		$row2["latitude"], $row2["longitude"]);
		
		$result->close();
		$result2->close();
		
	}
	
	endConnection($conn);
	return $final;
	//public function __construct($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $up_votes, $d_votes, 
	//$super_approval, $admin_approval, $loc_name, $latitude, $longitude)
	//$user = new User($row["sid"], $row["name"], $row["password"], $row["email"]);y
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function getPrivateEvents($user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	//$level = getUserLevel($user->sid);
	$locaitons = array();
	$times = array();
	$final = array();
	
	//get uni of student
	$sql = "SELECT *
	FROM univ_affil WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$student_uni = $row["name"];
	$result->close();
	//return $student_uni;
	
	$sql = "SELECT *
	FROM event WHERE category = 'private'";
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}

	
	

	while($row = $result->fetch_assoc())
	{
		$times[] = $row["time"];
		
	}
	//return $times;
	
	$result->close();
	
	$sql = "SELECT *
		FROM have_location";
		$result = $conn->query($sql);
	
	//get all place names
	while($row = $result->fetch_assoc())
	{
		for($i = 0; $i < count($times); $i++)
		{
			if($row["time"] == $times[$i])
			{
				$locations[] = new EventHelper($row["name"], $times[$i]);
			}
			
		}
		
	}
	//	return $locations;
	$result->close();
	
	
	for($i = 0; $i < count($locations); $i++)
	{
		$timehelper2 = $locations[$i]->time;
		$namehelper2 = $locations[$i]->name;
		$sql = "SELECT sid
		FROM student_creates_event WHERE name = '$namehelper2' AND time = '$timehelper2'";
		$result = $conn->query($sql);
		$row3 = $result->fetch_assoc();
		
		$searchsid = $row3["sid"];
		$result->close();
		
		
		$sql = "SELECT name
		FROM univ_affil WHERE sid = '$searchsid'";
		$result = $conn->query($sql);
		$row3 = $result->fetch_assoc();
		//return $row3["name"];
		if($row3["name"] != $student_uni)
		{
			unset($locations[$i]);
		}
		
	}
	
	$locations = array_values($locations);
	
	//return $locations;
	
	
	for($i = 0; $i < count($locations); $i++)
	{
		//events
		$timehelper = $locations[$i]->time;
		$sql = "SELECT *
		FROM event WHERE time ='$timehelper'";
		$result = $conn->query($sql);
		
		//locations
		$namehelper = $locations[$i]->name;
		$sql = "SELECT *
		FROM location WHERE name = '$namehelper'";
		$result2 = $conn->query($sql);
		
		$row = $result->fetch_assoc();
		$row2 = $result2->fetch_assoc();
		
		$final[] = new Event_Location ($row["time"], $row["date"], $row["name"], $row["category"], $row["description"], $row["contact_phone"], 
		$row["contact_email"], $row["type"], $row["up"], $row["down"], $row["super_approval"], $row["admin_approval"], $row2["name"], 
		$row2["latitude"], $row2["longitude"]);
		
		$result->close();
		$result2->close();
		
	}
	
	endConnection($conn);
	return $final;
	//public function __construct($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $up_votes, $d_votes, 
	//$super_approval, $admin_approval, $loc_name, $latitude, $longitude)
	//$user = new User($row["sid"], $row["name"], $row["password"], $row["email"]);y
	
	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function createRSOEvent($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $loc_name, $latitude, $longitude, $user, $rid)
{
	$conn = createConnection();

	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	//user must be admin
	if(getUserLevel($user->sid)!= 2)
	{
		endConnection($conn);
		return false;
	}

	//must be rso event
	if($category != "RSO")
	{
		endConnection($conn);
		return false;
	}
	
	//user must own this rso
	$sql = "SELECT * FROM ownsrso
	WHERE rid = '$rid' AND sid = '$user->sid'";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 0)
	{
		endConnection($conn);
		return false;
	}

	//Event Conflict
	$sql = "SELECT * FROM have_location
	WHERE name = '$loc_name' AND time = $time";
	$result = $conn->query($sql);

	if ($result->num_rows == 0)
	{
		$result->close();
		$sql = "INSERT INTO event (time, date, name, category, description, contact_phone, contact_email, type, super_approval, admin_approval, up, down)
		VALUES('$time', '$date', '$e_name', '$category', '$e_desc', '$contact_phone', '$contact_email', '$type', 1, 1, 0, 0)";
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
					$sql = "INSERT INTO admin_creates_event (name, time, sid, rid)
					VALUES('$loc_name', '$time', '$user->sid', '$rid')";
					$result = $conn->query($sql);
					if ($result == TRUE)
					{
						endConnection($conn);
						return true;
					}

				}
			}
		}

	}
	else
	{
		$error = $conn->error;
		endConnection($conn);
		return false;
	}


	$error = $conn->error;
	endConnection($conn);
	return $error;
}

function createEvent($time, $date, $e_name, $category, $e_desc, $contact_phone, $contact_email, $type, $loc_name, $latitude, $longitude, $user)
{
	$conn = createConnection();

	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	//user must be student or admin
	if(getUserLevel($user->sid) == 3 || getUserLevel($user->sid) == 0)
	{
		endConnection($conn);
		return false;
	}

	if($category == "RSO")
	{
		endConnection($conn);
		return false;
	}

	//Event Conflict
	$sql = "SELECT * FROM have_location
	WHERE name = '$loc_name' AND time = $time";
	$result = $conn->query($sql);

	if ($result->num_rows == 0)
	{
		$result->close();
		$sql = "INSERT INTO event (time, date, name, category, description, contact_phone, contact_email, type, super_approval, admin_approval, up, down)
		VALUES('$time', '$date', '$e_name', '$category', '$e_desc', '$contact_phone', '$contact_email', '$type', 1, 1, 0, 0)";
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
					$sql = "INSERT INTO student_creates_event (name, time, sid)
					VALUES('$loc_name', '$time', '$user->sid')";
					$result = $conn->query($sql);
					if ($result == TRUE)
					{
						endConnection($conn);
						return true;
					}

				}
			}
		}

	}
	else
	{
		$error = $conn->error;
		endConnection($conn);
		return false;
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
				return true;
			}
		}
		else
		{
			endConnection($conn);
			return false;
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
function createUniversity($name, $location, $description, $user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	if(getUserLevel($user->sid) != 3)
	{
		return false;
	}

	$sql = "SELECT * FROM create_profile WHERE sid = '$user->sid'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		endConnection($conn);
		return false;
	}

	$result->close();
	$sql = "SELECT * FROM university
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
		$sql = "INSERT INTO university (name, location, description, students)
		VALUES('$name', '$location', '$description', 0)";
		$result = $conn->query($sql);

		if ($result == TRUE)
		{
			//$last_id = $conn->insert_id;
			//$result->close();
			$sql = "INSERT INTO create_profile (name, sid)
			VALUES('$name', '$user->sid')";
			$result = $conn->query($sql);
		}
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


function getUniversity()
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		$error = $conn->error;
		endConnection($conn);
		return $error;
	}

	$uni = array();
	
	$sql = "SELECT *
	FROM university";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$uni[] = new University($row["name"], $row["location"], $row["description"], $row["students"]);
			//public function __construct($name, $location, $description, $students)
			
		}
		return $uni;
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


//depricated
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



function getRSO($user)
{
	$conn = createConnection();
	if ($conn->connect_error)
	{
		return $conn->error;
	}
	
	$sql = "SELECT name
	FROM univ_affil WHERE sid = '$user->sid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$uni = $row["name"];
	
	$result->close();
	//return $uni;
	
	$rso = array();
	
	$sql = "SELECT *
	FROM RSO WHERE university = '$uni'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$rso[] = new RSO($row["rid"], $row["name"], $row["students"], $row["university"], $row["description"]);
			//public function __construct($rid, $name, $students, $university, $description)
			
		}
		return $rso;

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

function stringToUser($string)
{
	list($sid, $username, $password, $email) = explode('/', $string);
	return new User($sid, $username, $password, $email);
}
