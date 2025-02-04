CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    civility VARCHAR(10),
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    telephone VARCHAR(20),
    pass VARCHAR(255)
);