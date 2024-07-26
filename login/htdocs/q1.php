<?php
session_start();
if($_SESSION['name']){
echo "<h2 align = \"center\">Hi, ".$_SESSION['name']."</h2>";
}
else{
    header("location:login.php");
}

?>

<?php
include("conn.php");

$sql="select * from student_att";
$result=mysqli_query($conn,$sql);

?>

<html>
<head>
    <title>Student Attendance Record</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom,pink,coral);
        padding: 20px;
    }

    table {
        border-collapse: collapse;
        width: 50%;
        margin: 0 auto;
        border: 5px solid black;
    }

    th, td {
        border: 5px solid black;
        padding: 8px;
    }

    th {
        background-color: bisque;
        color: crimson;
    }

    tr{
        background-color: crimson;
        color:bisque;
        font-weight: 20px;
        border: 5px solid black;
    }
     
    h3{
        color: crimson;
    }
    </style>
</head>
<body>
    <table border="5px" width="50%" align="center" border-style="solid" border-color="black">
        <tr align = "center" border="5px" border-style="solid">
            <th>Student Name</th>
            <th>Attendance Time</th>

        </tr>
        <?php
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr align=\"center\" border=\"5px\" border-style=\"solid\">";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['time1']."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <h3 align="center">Go back to</h3>
    <h3 align="center"><a href="ui1.html">Main Page</a></h3>
</body>
</html>
