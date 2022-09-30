<?php

//if (!empty($_POST))
//    if (isset($_POST['submit'])) {
//        if (isset($_POST['username']) && isset($_POST['Name']) &&
//            isset($_POST['E_mail']) && isset($_POST['password'])) {
//
//            $User_ID = $_POST['username'];
//            $Name = $_POST['Name'];
//            $E_mail = $_POST['E_mail'];
//            $password = $_POST['password'];
//
//
//            $host = "localhost";
//            $dbUsername = "root";
//            $dbPassword = "yrs@1234";
//            $dbName = "e_lib";
//            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
//            if ($conn->connect_error) {
//                die('Could not connect to the database.');
//            } else {
//                $Select = "SELECT E_Mail,username FROM registration_user WHERE E_Mail = ? or username LIMIT 1";
//                $Insert = "INSERT INTO registration_user(User_ID,Name,E_mail,password) values(?, ?, ?, ?)";
//                $stmt = $conn->prepare($Select);
//                $stmt->bind_param("s", $User_ID);
//                $stmt->execute();
//                $stmt->bind_result($resultUser_ID);
//                $stmt->store_result();
//                $stmt->fetch();
//                $rnum = $stmt->num_rows;
//                if ($rnum == 0) {
//                    $stmt->close();
//                    $stmt = $conn->prepare($Insert);
//
//                    $stmt->bind_param("ssss", $User_ID, $Name, $E_mail, $password);
//
//                    if ($stmt->execute()) {
//                        include 'registration2.php';
//                        header("Location: products.html");
//                    } else {
//                        echo "Email is already use already use";
//                    }
//                }
//                $stmt->close();
//
//                $conn->close();
//            }
//        } else {
//            echo "All field are required.";
//            die();
//        }
//    } else {
//        echo "Submit button is not set";
//    }

session_start();

// initializing variables
$username = "";
$email = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'yrs@1234', 'e_lib');

// REGISTER USER
if (isset($_POST['submit'])) {
    // receive all input values from the form
    $Name = mysqli_real_escape_string($db, $_POST['Name']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['E_mail']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);
    $user_check_query = "SELECT * FROM registration_user WHERE username='$username' OR E_mail='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);




    $emailCheck = $db->query($user_check_query);
    $rowCount = $emailCheck->fetch_row();

    // PHP validation
    if (!empty($_POST['username']) && !empty($_POST['Name']) &&
        !empty($_POST['E_mail']) && !empty($_POST['password'])) {

        // check if user email already exist
        if($rowCount > 0) {
            echo " Username or Email Already Exist";
        }else {
            $query = "INSERT INTO  registration_user(Name, E_mail, password,username) 
  			  VALUES('$Name', '$email', '$password_1','$username')";
            mysqli_query($db, $query);
            include('registration2.php');
            header("location: products.html");
        }


    }
    // Finally, register user if there are no errors in the form

}


?>