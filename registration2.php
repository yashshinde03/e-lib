<?php

if (isset($_POST['submit'])) {
        if (isset($_POST['username'])) {

            $username = $_POST['username'];
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "yrs@1234";
            $dbName = "e_lib";
            $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO log_record(ACTION,Date_Time,log_number,usernames) VALUES ('Registered Successfully',now(),default,'$username')";

            mysqli_query($conn, $sql);
            header("book.html");


        }
    }


?>