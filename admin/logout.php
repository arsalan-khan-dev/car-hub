<?php
/**
 * Car Hub - Admin Logout
 * Destroys session and redirects to login
 */
require_once '../config.php';

// Destroy session
$_SESSION = [];
session_destroy();

// Redirect to login
redirect('login.php');
