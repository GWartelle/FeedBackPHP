<?php
session_start();

// destroy the session
session_destroy();
header('Location: /FeedBackPHP/13_sessions.php');
