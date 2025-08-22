<?php
session_start();
$user_email = $_SESSION['email'];

$mysqli = new mysqli("localhost", "db_user", "db_pass", "db_name");
$stmt = $mysqli->prepare("SELECT job_title, company, location, status, applied_on FROM jobs_applied WHERE user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$jobs = [];
while ($row = $result->fetch_assoc()) {
  $jobs[] = $row;
}
echo json_encode($jobs);
?>