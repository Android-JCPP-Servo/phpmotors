<?php
unset($_SESSION['clientData']);
session_destroy();
header('Location: /phpmotors');
?>