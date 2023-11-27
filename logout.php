<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('You are logged out successfully!')</script>";
echo "<script>window.open('login.php','_self')</script>";
