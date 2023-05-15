<?php

# To show objects/arrays and others in a pretty format
function show($any) {
    echo "<pre>";
    print_r($any);
    echo "</pre>";
}

# To escape a string to prevent scripts from running
function escape($string) {
    return htmlspecialchars($string);
}

# To clean user input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = escape($data);
    return $data;
}

# To check if user has logged in
function authenticate($user) {
    if(!isset($_SESSION[$user])) {
        header("Location: ".ROOT."/$user/login");
        die();
    }
    return $_SESSION[$user];
}