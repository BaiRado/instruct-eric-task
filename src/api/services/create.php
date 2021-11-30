<?php
// headers
header('Access-Control-Allow-Origin: *'); // allow requests from any origin
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header(
    'Access-Control-Allow-Headers: 
        Access-Control-Allow-Headers,
        Content-Type,
        Access-Control-Allow-Methods,
        Authorization,
        X-Requested-With'
);

include_once '../../config/Database.php';
include_once '../../entities/Services.php';


// instantiate database and connect
$database = new Database();
$connection = $database->connect();

// instantiate services object
$services = new Services($connection);

// get raw posted data
$data = json_decode(file_get_contents('php://input'));

// map input data to services properties
$services->ref = $data->ref;
$services->centre = $data->centre;
$services->service = $data->service;
$services->country = $data->country;

// create service
if ($services->create()) {
    echo 'Service created';
} else {
    echo 'Service not created';
}
