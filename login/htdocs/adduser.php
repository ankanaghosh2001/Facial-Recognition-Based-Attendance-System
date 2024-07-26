<?php
include("conn.php");
if(isset($_POST["submit"])){
    session_start();
    $name=$_POST["name"];
    $sql="Insert into student_info(name) values('$name')";
    mysqli_query($conn,$sql);
    header("location:adduser.html");
}
?>

<html>
<head>
<style>
    body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
        padding: 20px;
    }

    form {
        width: 300px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    label {
        display: block;
        justify-items: center;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 20px;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-weight: bold;
        font-size: 15px;
    }

    input[type="submit"] {
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 15px;
    }

    h1{
        color: white;
    }
</style>
</head>
<body>
    <h1 align="center">Add New Student</h1>
    <form method="POST">
        <label>Enter the name of student :</label><br>
        <input type="text" placeholder="Enter your name" name="name"><br>
        <input type="submit" name="submit" value="Click">

    </form>
</body>
</html>