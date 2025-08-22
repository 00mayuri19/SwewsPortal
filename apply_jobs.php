<?php
session_start();
$user_email = $_SESSION['email'];
$data = json_decode(file_get_contents("php://input"), true);
$jobId = $data['jobId'];

$mysqli = new mysqli("localhost", "db_user", "db_pass", "db_name");

// Get job info
$stmt = $mysqli->prepare("SELECT job_title, company, location FROM available_jobs WHERE id = ?");
$stmt->bind_param("i", $jobId);
$stmt->execute();
$job = $stmt->get_result()->fetch_assoc();

// Insert into jobs_applied
$stmt = $mysqli->prepare("INSERT INTO jobs_applied (user_email, job_title, company, location, status, applied_on) VALUES (?, ?, ?, ?, 'Applied', CURDATE())");
$stmt->bind_param("ssss", $user_email, $job['job_title'], $job['company'], $job['location']);
$stmt->execute();

echo json_encode(["success" => true]);
?>