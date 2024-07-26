<?php
    // Execute the Python script
    $output = shell_exec("python3 C:Users/DELL/PycharmProjects/pythonProject/AttendanceProjectBasicCode/AttendanceProjectBasicCode/web/modified11.py");
    // Return the output to the client
    echo $output;
?>
