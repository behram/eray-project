<?php
chdir('..');

// Send correct type
header('Content-Type: text/css; charset=UTF-8');

// Enable browser cache for 1 hour
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');

if (! empty($_GET['styles']) && is_array($_GET['styles'])) {
    
    foreach ($_GET['styles'] as $style) {
        // Sanitise filename
        $style_name = 'css';

        $path = explode("/", $style);
        foreach ($path as $index => $filename) {
            // Allow alphanumeric, "." and "-" chars only, no files starting
            // with .
            if (preg_match("@^[\w][\w\.-]+$@", $filename)) {
                $style_name .= DIRECTORY_SEPARATOR . $filename;
            }
        }

        // Output file contents
        if (preg_match("@\.css$@", $style_name) && is_readable($style_name)) {
            readfile($style_name);
        }
    }
}
