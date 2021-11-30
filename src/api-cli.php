<?php
// define host, user and password
define('HOST', 'localhost');
define('PORT', '8080');
define('USER', 'root');
define('PASS', 'f@stNoise77');

// get all services
function read()
{
    // init cURL session and provide endpoint
    $handle = curl_init(HOST . ':' . PORT . '/api/services/read.php');

    // tell the API who is sending the request (unnecessary in these cases, but it bothered me excluding it)
    curl_setopt($handle, CURLOPT_USERPWD, USER . ':' . PASS);

    // execute the curl request
    curl_exec($handle);
}

// get services by country
function read_by_country($country_code)
{
    // init cURL session and provide endpoint
    $handle = curl_init(HOST . '/api/services/read_by_country.php?country=' . $country_code);

    // tell the API who is sending the request 
    curl_setopt($handle, CURLOPT_USERPWD, USER . ':' . PASS);

    // execute the cURL request
    curl_exec($handle);
}

// create new service entry
function create($ref, $centre, $service, $country)
{
    // encode user input as JSON
    $data = json_encode(
        array(
            "ref" => $ref,
            "centre" => $centre,
            "service" => $service,
            "country" => $country
        )
    );

    // init cURL session and provide endpoint
    $handle = curl_init(HOST . '/api/services/create.php');

    // add JSON header to cURL request
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // tell the API who is sending the request
    curl_setopt($handle, CURLOPT_USERPWD, USER . ':' . PASS);

    // have cURL send a POST request
    curl_setopt($handle, CURLOPT_POST, 1);

    // give cURL the data to send
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

    // execute the cURL request
    curl_exec($handle);
}

// update service entry
function update($ref, $centre, $service, $country)
{
    // encode user input as JSON
    $data = json_encode(
        array(
            "ref" => $ref,
            "centre" => $centre,
            "service" => $service,
            "country" => $country
        )
    );

    // init cURL session and provide endpoint
    $handle = curl_init(HOST . '/api/services/update.php');

    // add JSON header to cURL request
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // tell the API who is sending the request
    curl_setopt($handle, CURLOPT_USERPWD, USER . ':' . PASS);

    // have cURL send a PUT request
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');

    // give cURL the data to send
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

    // execute the cURL request
    curl_exec($handle);
}

// delete service entry
function delete($ref)
{
    // encode user input as JSON
    $data = json_encode(
        array(
            "ref" => $ref
        )
    );

    // init cURL session and provide endpoint
    $handle = curl_init(HOST . '/api/services/delete.php');

    // add JSON header to cURL request
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // tell the API who is sending the request
    curl_setopt($handle, CURLOPT_USERPWD, USER . ':' . PASS);

    // have cURL send a PUT request
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');

    // give cURL the data to send
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

    // execute the cURL request
    curl_exec($handle);
}

// handle user response to initial prompt
function handle_response($response)
{
    switch ($response) {
        case 1:
            // return all services
            read();
            break;
        case 2:
            // prompt for country code and return all matches
            $country_code = (string)readline('Enter country code: ');
            read_by_country($country_code);
            break;
        case 3:
            // prompt for necessary fields and add to database
            $ref = (string)readline('Enter reference number: ');
            $centre = (string)readline('Enter centre: ');
            $service = (string)readline('Enter service: ');
            $country = (string)readline('Enter country: ');
            create($ref, $centre, $service, $country);
            break;
        case 4:
            // prompt for necessary fields and update database
            $ref = (string)readline("Enter the reference number for the entry you'd like to update: ");
            $centre = (string)readline('Enter new centre value: ');
            $service = (string)readline('Enter new service value: ');
            $country = (string)readline('Enter new country value: ');
            update($ref, $centre, $service, $country);
            break;
        case 5:
            // prompt for reference and delete database
            $ref = (string)readline("Enter the reference number for the entry you'd like to delete: ");
            delete($ref);
            break;
        default:
            echo "\nYour choice was " . $response . ". Please enter a number between 1 and 5 or press Ctrl+C to quit.\n";
            init();
    }
}

// initial user prompt
function init()
{
    echo "Enter 1 to see all services\r\nEnter 2 to see services by country code\r\nEnter 3 to add a new service to the database\r\nEnter 4 to update a service\r\nEnter 5 to delete a service: ";
    $response = (int)readline();
    handle_response($response);
}

init();
