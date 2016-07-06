<?php

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

function endConnection($conn)
{
	$conn->close();
	return;
}

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
		return "account found";
	}
	else 
	{
		endConnection($conn);
		return "not found";
	}
	
	
	endConnection($conn);
	return "tacos";
}

function createUser($username, $password)
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
		$sql = "INSERT INTO Users (username, password)
		VALUES('$username', '$password')";
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


