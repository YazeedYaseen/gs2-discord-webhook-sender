<?php
// Define the webhook URL (replace with your actual webhook URL)
$webhook_url = "https://discord.com/api/webhooks/1244958003174703114/qAIZnB6kz_njEZDCnyXNX6VgUQywQruBAPSEKlVT0z4EvNaKqqQPHcjl7GETz8YG5hDl";

// Get query parameters
$username = isset($_GET['username']) ? $_GET['username'] : null;
$content = isset($_GET['content']) ? $_GET['content'] : null;

// Validate query parameters
if (!$username) {
    echo "Error: 'username' query string not defined.";
    exit;
}

if (!$content) {
    echo "Error: 'content' query string not defined.";
    exit;
}

// Prepare the data to send
$data = json_encode([
    "username" => $username,
    "content" => $content
]);

// Initialize cURL
$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Send the request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Check for errors
if ($http_code != 204) {
    echo "Error: Failed to send webhook. HTTP Status Code: " . $http_code;
    echo " Response: " . $response;
} else {
    echo "Webhook sent successfully.";
}
?>
