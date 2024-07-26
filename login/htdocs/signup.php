<?php
include("conn.php");
if(isset($_POST["submit"])){
    $name = $_POST["username"];
    $pswd = $_POST["password"];
    $query = "select * from login";
    $res = mysqli_query($conn,$query);
    $count = mysqli_num_rows($res);
    if($count < 2){
    $sql="insert into login(username,password) values ('$name','$pswd')";
    $result = mysqli_query($conn,$sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    }
    
    else{
        header("location:login.php");
    }
}
    else{
        echo "<h3 align = \"center\">Maximum Limit of Admin is 2.<h3>";

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
        text-align: center;
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
    <h1 align="center">New Admin Sign-up</h1>
    <form action="" method="POST">
    <label>Username</label><input type="text" name="username"><br><br>
    <label>Password</label><input type="password" name="password"><br><br>
    <input type="submit" name="submit" value="Signup">
    </form>
    <h3 align="center">Go back to</h3>
    <h3 align="center"><a href="ui1.html">Main Page</a></h3>
</body>
</html>