<?php
include("conn.php");
if(isset($_POST["submit"])){
session_start();
$user=$_POST["username"];
$pass=$_POST["password"];

$sql="select * from login where username='$user' and password='$pass'";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

if($count>0){
    $_SESSION['name']=$user;
    header("location:q1.php");
}
else{
    echo "Error".mysqli_error($conn);
}
}
?>
<html>
<head>
    <style>
        body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background: linear-gradient(#A0ECC6,lightblue,pink);
        padding: 20px;
    }
    h1{
        color: #1A6F45;
    }

    form {
        width: 300px;
        margin: 0 auto;
        background-color: #1A6F45;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
    
    label {
        display: block;
        margin-bottom: 10px;
        color: white;
    }
    
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        color:#1A6F45;
        font-size: 15px;
        font-weight: bold;
    }
    
    input[type="submit"] {
        background: linear-gradient(#A0ECC6,lightblue,pink);
        color: #125C37;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 15px;
        font-weight: bold;
    }
    
    h3{
        color:#125C37;
    }

</style>
</head>
<body>
    <h1 align="center">Admin Log-in</h1>
    <form action="" method="POST">
    <label>Username</label><input type="text" name="username"><br><br>
    <label>Password</label><input type="password" name="password">
    <input type="submit" name="submit" value="Login">
    </form>
    <h3 align="center">New Admin Registration? Click below</h3>
    <h3 align="center"><a href="signup.php">Sign-Up</a></h3>
</body>
</html>
