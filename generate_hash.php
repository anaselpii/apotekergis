<?php
$password = 'admin123'; // password yang kamu mau
$hash = password_hash($password, PASSWORD_BCRYPT);
echo $hash;
