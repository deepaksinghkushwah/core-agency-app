<?php

include 'config.php';
unset($_SESSION['isLoggedIn']);
unset($_SESSION['user']);

header('location: index.php');
exit;
