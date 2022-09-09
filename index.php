
<?php 
    include 'config/database_connect.php';
    $surname = $firstname = $middlename= $gender=$phonenumber=$emailaddress= '';
    $update = false;
    //$_GET['update']= '';
    if(isset($_GET['update']))
    {
        $update = true;
        $profile_id = $_GET['update'];
        $sql = "SELECT * FROM profileData_tbl WHERE profile_id = '$profile_id'";
        if($result=$conn->query($sql)){
            while($row=$result->fetch_assoc()){
                $surname = $row['surname'];
                $firstname = $row['firstname'];
                $middlename = $row['middlename'];
                $gender = $row['gender'];
                $phonenumber = $row['phonenumber'];
                $emailaddress = $row['emailaddress'];
                $id = $row['profile_id'];
        }
       }

    }
    if(isset($_GET['delete']))
    {
        $profile_id = $_GET['delete'];
        $sql = "DELETE FROM profileData_tbl WHERE profile_id = '$profile_id'";
        if($result=$conn->query($sql)){
            echo "Profile Successfully Deleted";
        }
        else{
            //exit("Profile can not be deleted [' . $conn->error . ']'");
        }
       }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fulid">
        <div class="container">
            <?php 
                if($update == false):?>
                    <center><h4 class="text-danger">Add Profile Data</h4></center>
            <?php endif?>
            <?php 
                if($update == true):?>
                    <center><h4 class="text-Info">Update Profile Data</h4></center>
            <?php endif?>
            <form action="process.php" method="POST">
                <div class="row form-group mb-2">
                    <div class="col-5">
                        <label class="form-label">Surname</label>
                        <input type="text" class="form-control" id="surname" value="<?php echo $surname ?>" name="surname">
                        <input type="hidden" value="<?php echo $id; ?>" name="id">
                    </div>
                    <div class="col-5">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" value="<?php echo $firstname ?>" name="firstname">
                    </div>
                </div>
                <div class="row form-group mb-2">
                    <div class="col-5">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" value="<?php echo $middlename ?>" name="middlename">
                    </div>
                    <div class="col-5">
                        <label class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phonenumber" value="<?php echo $phonenumber ?>"  name="phonenumber">
                    </div>
                </div>
                <div class="row form-group mb-2">
                 <div class="col-5">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" value="<?php echo $emailaddress ?>" id="emailaddress" name="emailaddress">
                        </div>
                        <div class="col-5">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" class="form-check-input" id="gender" value="Male" name="gender">&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" class="form-check-input" id="gender" value="Female" name="gender">&nbsp;Female
                        </div>
                    </div>
                    <?php if($update== false):?>
                        <center><button type="submit" class="btn btn-primary" name="save_profile">Save Profile</button></center>
                    <?php endif; ?>
                    <?php if($update== true):?>
                        <center><button type="submit" class="btn btn-success" name="update_profile">Update Profile</button></center>
                    <?php endif; ?>
                </form>
                <hr>
                <center><h4 class="text-success">Saved Profile Data</h4></center>
                <table class="table table-striped ml-5">
                    <thead>
                        <th>#</th>
                        <th>Surname</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $sql ="SELECT * FROM profileData_tbl  ORDER BY surname ASC";
                            if($result=$conn->query($sql)){
                                $i= 0;
                                while($row=$result->fetch_assoc()){
                                    $i++
                        ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['surname'];?></td>
                                        <td><?php echo $row['firstname'];?></td>
                                        <td><?php echo $row['middlename'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td><?php echo $row['phonenumber'];?></td>
                                        <td><?php echo $row['emailaddress'];?></td>
                                        <td>
                                            <a href="index.php?update=<?php echo $row['profile_id'];?>"><button class="btn btn-primary" name="update">Update</button></a>
                                            <a href="index.php?delete=<?php echo $row['profile_id'];?>"><button class="btn btn-danger" name="delete">Remove</button></a>
                                        </td>
                        <?php   }
                                    
                            }
                            else{
                            die("SQL Error [' . $conn->error . ']'");
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>