<?php 
$wachtwoord = "123";

$gehashedWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

echo "Gehashed wachtwoord " . $gehashedWachtwoord;
?>