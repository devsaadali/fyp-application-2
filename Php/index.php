<?php
header("Content-Type: text/html; charset=UTF-8");

// Node.js API URL
$node_api_url = "http://api:3000/moviesdetail"; // Update if needed

// Initialize cURL session
$ch = curl_init($node_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

// Execute cURL request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check for errors
if (curl_errno($ch)) {
    echo "<p>Error: " . curl_error($ch) . "</p>";
} elseif ($http_code !== 200) {
    echo "<p>Error: Failed to fetch data, HTTP Code: $http_code</p>";
} else {
    // Decode JSON response
    $movies = json_decode($response, true);
    
    // HTML Header
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Movies List</title>';
    // Link to CSS file
    echo '<link rel="stylesheet" type="text/css" href="static/styles.css">';
    echo '</head>';
    echo '<body>';
    echo '<h1>Welcome to PHP App</h1>';
    echo '<br>';
    // Display data in a table
    if (is_array($movies) && count($movies) > 0) {
        echo '<h2>Movies List</h2>';
        echo '<table>';
        echo '<thead>';
        echo '<tr><th>Title</th><th>Genre</th><th>Year</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        
        foreach ($movies as $movie) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($movie['title']) . '</td>';
            echo '<td>' . htmlspecialchars($movie['genre']) . '</td>';
            echo '<td>' . htmlspecialchars($movie['year']) . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>No movies data available</p>";
    }

    // Closing HTML tags
    echo '</body>';
    echo '</html>';
}

// Close cURL session
curl_close($ch);
?>
