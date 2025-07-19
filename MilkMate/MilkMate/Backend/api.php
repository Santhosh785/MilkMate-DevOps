<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$input = file_get_contents("php://input"); // Get raw input
$data = json_decode($input, true); // Decode JSON

echo json_encode([
    "raw_input" => $input,         // Show raw input
    "decoded" => $data,            // Show decoded object
    "status" => $data ? "success" : "failed"
]);
