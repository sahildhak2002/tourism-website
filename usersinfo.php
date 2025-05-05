<?php

// Establish database connection
$con = mysqli_connect('localhost', 'root');
if ($con) {
    echo "Connection successful";
} else {
    die("No connection: " . mysqli_connect_error());
}

// Select database
mysqli_select_db($con, 'travelusersdata');

// Accessing form data safely
$FullName = isset($_POST['FullName']) ? $_POST['FullName'] : '';
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
$Email = isset($_POST['Email']) ? $_POST['Email'] : '';
$Destination = isset($_POST['Destination']) ? $_POST['Destination'] : '';

// Check for empty fields
if (empty($FullName) || empty($mobile) || empty($Email) || empty($Destination)) {
    die("Error: All fields are required.");
}

// Validate destination
$allowedDestinations = ['Thailand', 'Dubai', 'Italy', 'New York', 'Paris', 'Tokyo'];
if (!in_array($Destination, $allowedDestinations)) {
    die("Error: Destination must be one of the following: " . implode(', ', $allowedDestinations));
}

// Insert query
$query = "INSERT INTO usersinfodata (`Full Name`, `mobile`, `Email`, `Destination`) 
VALUES ('$FullName', '$mobile', '$Email', '$Destination')";

// Debugging output to ensure query is correct
echo $query;

// Execute query
if (mysqli_query($con, $query)) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . mysqli_error($con);
}

// Close connection
mysqli_close($con);

?>
