<?php
header('Content-Type: application/json');

$apiKey = '0619d1c3b5fba7711f909ac22422d5d7'; // Replace with your OpenWeatherMap API key
$city = isset($_GET['city']) ? urlencode($_GET['city']) : '';

if (empty($city)) {
    echo json_encode(['error' => 'City name is required']);
    exit();
}

// OpenWeatherMap API URL
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

$response = file_get_contents($apiUrl);
if ($response === FALSE) {
    echo json_encode(['error' => 'Unable to fetch data']);
    exit();
}

$data = json_decode($response, true);
if ($data['cod'] !== 200) {
    echo json_encode(['error' => 'City not found']);
    exit();
}

// Prepare and output the weather data
echo json_encode([
    'city' => $data['name'],
    'country' => $data['sys']['country'],
    'temperature' => $data['main']['temp'],
    'description' => ucfirst($data['weather'][0]['description']),
    'humidity' => $data['main']['humidity'],
    'windSpeed' => $data['wind']['speed']
]);
?>
