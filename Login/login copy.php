
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="../common.css"> -->
    <link rel="stylesheet" href="login1.css">
    <link rel="stylesheet" href="login.css">
    <style>
        

    </style>
</head>
<body>
    <header class="header">
        <h1>Course Recommender</h1>
    </header>
    <div class="main-container">

<?php
    require '../connection.php';
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql="SELECT * FROM `College` WHERE Email = '$email'";
        $data=mysqli_query($dbcon,$sql);
        if($data){
            $rows=mysqli_num_rows($data);
            if($rows>0){
                $row=mysqli_fetch_array($data);
                if($password==$row['Password']){
                    if($row['Status']==1){
                    echo $row['Name'];
                    session_start();
                    $_SESSION['UserName']=$row['Name'];
                    $_SESSION['Collegeid']=$row['Collegeid'];
                    header('location:../College/index1.php'); 
                    echo "hai".$row['Name'];
                    }
                    else{
                        echo "Application Not approved";
                    }
                }
                else{
                    echo "Wrong Password";
                }
            }
            else{
                echo "Invalid Email";
            }
        }
    }
?>
</div>

<!-- <script src="login.js"></script> -->
</body>
</html>