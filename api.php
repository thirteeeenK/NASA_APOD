<?php
header('Content-Type: application/json');

// Your NASA API Key
$apiKey = "GsK6WdJMvERexXn5CodCuiJsI93N5eRJsR40FPmH";

// URL to fetch
$url = "https://api.nasa.gov/planetary/apod?api_key=" . $apiKey;

// Initialize cURL
$ch = curl_init();

// Set options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for local dev if needed

// Execute
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)){
    http_response_code(500);
    echo json_encode(['error' => curl_error($ch)]);
} else {
    echo $response;
}

// Close
curl_close($ch);
?>
