<?php
session_start(); // Ensure the session is started

// Unset all session variables and destroy the session
$_SESSION = array();
session_destroy();

// JavaScript for alert and redirect
echo '<script type="text/javascript">';
echo 'alert("You have been successfully logged out.");';
echo 'window.location.href = "../html/index.html";'; // Redirect to the homepage or login page
echo '</script>';

exit();
?>