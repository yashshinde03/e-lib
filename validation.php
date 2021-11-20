<?php


if(isset($_POST['submit1'])) {


        $con = mysqli_connect("localhost", "root", "yrs@1234", "e_lib");
        if (!$con) {
            die('Could not connect : ' . mysqli_error());
        }

        $E_mail= $_POST['E_mail'];
        $password = $_POST['password'];


        $query = "select E_mail,password from registration_user where E_mail ='$E_mail' AND password='$password'";


        $result = mysqli_query($con,$query);



        if (mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['E_mail'] = $E_mail;
//            include('registration2.php');
            header("Location: book.html");
        } else {
            echo "Incorrect UserName or Password. Please try again.";
        }

        mysqli_close($con);
    }

    else {
    echo "missing form values";
   }



?>
