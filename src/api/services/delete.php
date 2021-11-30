<?php
// headers
header('Access-Control-Allow-Origin: *'); // allow requests from any origin
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// delete service
if ($services->delete()) {
    echo 'Service deleted';
} else {
    echo 'Service not deleted';
}
