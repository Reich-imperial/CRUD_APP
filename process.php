<?php
    include 'config/database_connect.php';
    function validate_input($input)
        {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
        }
    if(isset($_POST['save_profile']))
    {
        $surname = validate_input($_POST['surname']);
        $firstname = validate_input($_POST['firstname']);
        $middlename = validate_input($_POST['middlename']);
        $phonenumner = validate_input($_POST['phonenumber']);
        $emailaddress = validate_input($_POST['emailaddress']);
        $gender = validate_input($_POST['gender']);

        //prepare to send into the database table
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn,$_POST['middlename']);
        $phonenumner = mysqli_real_escape_string($conn,$_POST['phonenumber']);
        $emailaddress =mysqli_real_escape_string($conn,$_POST['emailaddress']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        //Send data in to the database
        $sql = "INSERT INTO profiledata_tbl (surname, firstname, middlename, gender, phonenumber, emailaddress)
        VALUES ('$surname', '$firstname', '$middlename', '$gender', '$phonenumner', '$emailaddress')";
        if($result = $conn->query($sql))
        {
            header('location:index.php');
        }
        else{
            die("Profile not submitted [' . $conn->error . ']'");
        }
    }
    if(isset($_POST['update_profile']))
    {
        $surname = validate_input($_POST['surname']);
        $firstname = validate_input($_POST['firstname']);
        $middlename = validate_input($_POST['middlename']);
        $phonenumner = validate_input($_POST['phonenumber']);
        $emailaddress = validate_input($_POST['emailaddress']);
        $gender = validate_input($_POST['gender']);

        //prepare to send into the database table
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn,$_POST['middlename']);
        $phonenumner = mysqli_real_escape_string($conn,$_POST['phonenumber']);
        $emailaddress =mysqli_real_escape_string($conn,$_POST['emailaddress']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $id = $_POST['id'];
        //Send data in to the database
        $sql = "UPDATE profileData_tbl SET surname = '$surname', firstname = '$firstname', middlename= '$middlename', gender ='$gender', phonenumber = '$phonenumner', emailaddress='$emailaddress' WHERE profile_id='$id'";
        if($result = $conn->query($sql))
        {
            header('location:index.php');
        }
        else{
            die("Profile not update [' . $conn->error . ']'");
        }
    }
?>