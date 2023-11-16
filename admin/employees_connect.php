<?php
    $employee_id = $_POST['employee_id'];
    $employee_password = $_POST['employee_password'];
    $employee_name = $_POST['employee_name'];
    $employee_email = $_POST['employee_email'];
    $employee_phone = $_POST['employee_phone'];
    $hire_date = $_POST['hire_date'];
    $job_title = $_POST['job_title'];
    $salary = $_POST['salary'];
    $store_id = $_POST['store_id'];
    $admin_id = $_POST['admin_id'];

    // DB connection
    $conn = new mysqli('localhost','root','','aquadb');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into Employees values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssss", $employee_id, $employee_name, $employee_email, $employee_phone, $hire_date,$job_title,$salary,$store_id,$admin_id, $employee_password);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>
