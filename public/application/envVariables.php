<?php
    $envFilePath = '../../.env';
    $envContents = file_get_contents($envFilePath);
    if ($envContents === false) {
        die('.env file not found or cannot be read.');
    }
    $envVariables = [];
    // Split the content into lines and parse key-value pairs
    $lines = explode("\n", $envContents);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $envVariables[$key] = $value;
        }
    }
    return $envVariables;
?>
