<?php
/*
 * Proxy connection to the phpmotors database.
 */

function phpmotorsConnect() {
    $server = "localhost";
    $dbname = "phpmotors";
    $username = "proxyClient";
    $password = "Wm@E9vnxprJ9/3Sn";
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        $link = new PDO($dsn, $username, $password, $options);
        // echo "It worked!";
        /* if (is_object($link)) {
        } */
        return $link;
    } catch (PDOException $e) {
        // echo "It didn't work. Error: " . $e->getMessage();
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}

// phpmotorsConnection();

?>