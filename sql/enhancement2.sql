INSERT INTO clients (clientFirstName, clientLastName, clientEmail, clientPassword, comment)
VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "\"I am the real Ironman\"");

UPDATE clients SET clientLevel = 3 WHERE client_id = 1;
SELECT * FROM clients;

UPDATE inventory SET invDescription = REPLACE(invDescription, "small", "spacious") WHERE invId = 12;
SELECT * FROM inventory;

SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification ON
inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationId = 1;

DELETE FROM inventory
WHERE invId = 1;

UPDATE inventory 
SET invImage = CONCAT("/phpmotors", invImage), invThumbnail = CONCAT("/phpmotors", invThumbnail);
SELECT * FROM inventory;