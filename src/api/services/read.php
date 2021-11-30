<?php
// headers
header('Access-Control-Allow-Origin: *'); // allow requests from any origin
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../entities/Services.php';


// instantiate database and connect
$database = new Database();
$connection = $database->connect();

// instantiate services object
$services = new Services($connection);

// get data
$stmt = $services->read();
// get row count
$count = $stmt->rowCount();

// check if there is data
if ($count > 0) {
    // initialize services array
    $services_arr = array();
    $services_arr['data'] = array();

    // loop through all rows
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // map data to new array (unnecessary step in this case, but allows key renaming in other cases)
        $service_data = array(
            'ref' => $ref,
            'centre' => $centre,
            'service' => $service,
            'country' => $country,
        );

        // push to data array
        array_push($services_arr['data'], $service_data);
    }

    // encode to JSON and output
    echo json_encode($services_arr);
} else {
    // if no data
    echo json_encode(
        array(
            'data' => array()
        )
    );
}
