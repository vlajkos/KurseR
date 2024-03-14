<?php
require "handler/dbBroker.php";
require "model/user.php";

$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password, 'Kurser');



$sqlDropDatabase = "DROP DATABASE IF EXISTS kurser";
if ($conn->query($sqlDropDatabase) === TRUE) {
    echo "Database 'kurser' dropped (if it existed).\n";
} else {
    echo "Error dropping database: " . $conn->error . "\n";
}


$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS kurser";
if ($conn->query($sqlCreateDatabase) === TRUE) {
    echo "Database 'kurser' created successfully.\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}
$conn = Database::connectDatabase();
// Select the "kurser" database
$conn->select_db("kurser");

//CREATE USERS

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    birthday DATE,
    phone VARCHAR(20),
    is_admin BOOLEAN DEFAULT FALSE
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'users' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

function createUser($username, $password, $name, $surname, $email, $birthday, $phone, $isAdmin = false)
{
    $conn = Database::connectDatabase();
    // Prepare the SQL statement
    $sql = "INSERT INTO users (username, password, name, surname, email, birthday, phone, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $username, $password, $name, $surname, $email, $birthday, $phone, $isAdmin);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User created successfully.\n";
    } else {
        echo "Error creating user: " . $stmt->error . "\n";
    }
}

// ADMINI
createUser("jana", "jana1234", "Jana", "Dzeletovic", "jana@example.com", '2000-26-08', "0669385469", true);
createUser("admin", "admin1234", "John", "Doe", "admin@example.com", "1995-05-05", "9876543210", true);


createUser("Jovan", "sifra1", "Jovan", "Petrović", "jovan@gmail.com", "1998-01-02", "0646589431", false);
createUser("Ana", "sifra2", "Ana", "Janković", "ana@gmail.com", "1998-02-03", "0631234567", false);
createUser("Stefan", "sifra3", "Stefan", "Đorđević", "stefan@gmail.com", "1998-03-04", "0619876543", false);
createUser("Marija", "sifra4", "Marija", "Marković", "marija@gmail.com", "1998-04-05", "0641234567", false);
createUser("Nikola", "sifra5", "Nikola", "Nikolić", "nikola@gmail.com", "1998-05-06", "0639876543", false);
createUser("Teodora", "sifra6", "Teodora", "Teodorović", "teodora@gmail.com", "1998-06-07", "0611234567", false);
createUser("Luka", "sifra7", "Luka", "Lukić", "luka@gmail.com", "1998-07-08", "0649876543", false);
createUser("Milica", "sifra8", "Milica", "Milić", "milica@gmail.com", "1998-08-09", "0631234567", false);
createUser("Stefana", "sifra9", "Stefana", "Stefanović", "stefana@gmail.com", "1998-09-10", "0619876543", false);
createUser("Marko", "sifra10", "Marko", "Marković", "marko@gmail.com", "1998-10-11", "0647890123", false);
createUser("Ivana", "sifra11", "Ivana", "Ivanović", "ivana@gmail.com", "1998-11-12", "0641234876", false);
createUser("Nemanja", "sifra12", "Nemanja", "Nemanjić", "nemanja@gmail.com", "1998-12-13", "0637890123", false);
createUser("Tamara", "sifra13", "Tamara", "Todorović", "tamara@gmail.com", "1998-01-14", "0612345678", false);
createUser("Vuk", "sifra14", "Vuk", "Vučić", "vuk@gmail.com", "1998-02-15", "0645678901", false);
createUser("Maja", "sifra15", "Maja", "Milošević", "maja@gmail.com", "1998-03-16", "0638901234", false);
createUser("Lazar", "sifra16", "Lazar", "Lazarević", "lazar@gmail.com", "1998-04-17", "0612345678", false);
createUser("Jovana", "sifra17", "Jovana", "Jovanović", "jovana@gmail.com", "1998-05-18", "0645678901", false);
createUser("Andrija", "sifra18", "Andrija", "Andrić", "andrija@gmail.com", "1998-06-19", "0638901234", false);
createUser("Dunja", "sifra19", "Dunja", "Dunjić", "dunja@gmail.com", "1998-07-20", "0612345678", false);
createUser("Aleksandar", "sifra20", "Aleksandar", "Aleksandrović", "aleksandar@gmail.com", "1998-08-21", "0645678901", false);
createUser("Sofija", "sifra21", "Sofija", "Sofijanović", "sofija@gmail.com", "1998-09-22", "0638901234", false);
createUser("Stefan", "sifra22", "Stefan", "Stefanović", "stefan@gmail.com", "1998-10-23", "0645678901", false);
createUser("Teodora", "sifra23", "Teodora", "Teodorović", "teodora@gmail.com", "1998-11-24", "0612345678", false);
createUser("Filip", "sifra24", "Filip", "Filipović", "filip@gmail.com", "1998-12-25", "0638901234", false);
createUser("Anastasija", "sifra25", "Anastasija", "Anastasijević", "anastasija@gmail.com", "1999-01-26", "0645678901", false);
createUser("Nikola", "sifra26", "Nikola", "Nikolić", "nikola@gmail.com", "1999-02-27", "0612345678", false);
createUser("Jovanka", "sifra27", "Jovanka", "Jovanković", "jovanka@gmail.com", "1999-03-28", "0638901234", false);
createUser("Dušan", "sifra28", "Dušan", "Dušanović", "dusan@gmail.com", "1999-04-29", "0645678901", false);
createUser("Tamara", "sifra29", "Tamara", "Tamarović", "tamara@gmail.com", "1999-05-30", "0612345678", false);
createUser("Luka", "sifra30", "Luka", "Lukić", "luka@gmail.com", "1999-06-01", "0638901234", false);
createUser("Neda", "sifra31", "Neda", "Nedeljković", "neda@gmail.com", "1999-07-02", "0645678901", false);
createUser("Aleksandar", "sifra32", "Aleksandar", "Aleksandrović", "aleksandar@gmail.com", "1999-08-03", "0612345678", false);
createUser("Vesna", "sifra33", "Vesna", "Veselinović", "vesna@gmail.com", "1999-09-04", "0638901234", false);
createUser("Branislav", "sifra34", "Branislav", "Branislavić", "branislav@gmail.com", "1999-10-05", "0645678901", false);
createUser("Maja", "sifra35", "Maja", "Majković", "maja@gmail.com", "1999-11-06", "0612345678", false);
createUser("Dragan", "sifra36", "Dragan", "Dragić", "dragan@gmail.com", "1999-12-07", "0638901234", false);
createUser("Ivana", "sifra37", "Ivana", "Ivanović", "ivana@gmail.com", "2000-01-08", "0645678901", false);
createUser("Stevan", "sifra38", "Stevan", "Stevanović", "stevan@gmail.com", "2000-02-09", "0612345678", false);
createUser("Jasna", "sifra39", "Jasna", "Jasenković", "jasna@gmail.com", "2000-03-10", "0638901234", false);
createUser("Milan", "sifra40", "Milan", "Milanović", "milan@gmail.com", "2000-04-11", "0645678901", false);
createUser("Jovana", "sifra41", "Jovana", "Jovanović", "jovana@gmail.com", "2000-05-12", "0612345678", false);
createUser("Nemanja", "sifra42", "Nemanja", "Nemanjić", "nemanja@gmail.com", "2000-06-13", "0638901234", false);
createUser("Katarina", "sifra43", "Katarina", "Katarinović", "katarina@gmail.com", "2000-07-14", "0645678901", false);
createUser("Lazar", "sifra44", "Lazar", "Lazarević", "lazar@gmail.com", "2000-08-15", "0612345678", false);
createUser("Marija", "sifra45", "Marija", "Marić", "marija@gmail.com", "2000-09-16", "0638901234", false);
createUser("Stefan", "sifra46", "Stefan", "Stefanović", "stefan@gmail.com", "2000-10-17", "0645678901", false);
createUser("Ana", "sifra47", "Ana", "Anić", "ana@gmail.com", "2000-11-18", "0612345678", false);
createUser("Nikola", "sifra48", "Nikola", "Nikolić", "nikola@gmail.com", "2000-12-19", "0638901234", false);
createUser("Jelena", "sifra49", "Jelena", "Jelenić", "jelena@gmail.com", "2001-01-20", "0645678901", false);
createUser("Marko", "sifra50", "Marko", "Marković", "marko@gmail.com", "2001-02-21", "0612345678", false);









include 'CourseSeeder.php';
include 'InstructorSeeder.php';
include 'CourseInstructorSeeder.php';
include 'ApplicationSeeder.php';













$conn->close();
?>
