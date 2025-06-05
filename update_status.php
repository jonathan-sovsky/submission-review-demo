<?php
include 'db.php';
$id = $_POST['id'];
$status = $_POST['status'];
$stmt = $db->prepare("UPDATE submissions SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();
