<?php

$user = "admin";
$pass = "plop";

$db = new PDO('mysql:host=localhost;dbname=crm-bdd', $user, $pass);

$newName = $_POST["name"];
$newAdress = $_POST["adress"];

echo "$newName";
echo "$newAdress";

// $insertline = $db->prepare("INSERT INTO Business VALUES (NULL, $newAdress, $newName, NULL)");
// $insertline->execute();

$insertLine = $db->prepare("INSERT INTO `Business` (`id`, `name`, `address`, `customer_id`) VALUES (NULL, 'azerty', 'azerty', '3'))";
 $insertLine->execute();
 echo "lolilol";

?>
