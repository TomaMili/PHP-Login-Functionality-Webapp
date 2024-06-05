<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toma_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konekcija nije uspjela: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO korisnici (ime, prezime, email, korisnicko_ime, lozinka, drzava) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $ime, $prezime, $email, $korisnicko_ime, $lozinka, $drzava);


    $ime = $_POST['firstname'];
    $prezime = $_POST['lastname'];
    $email = $_POST['email'];
    $korisnicko_ime = $_POST['username'];
    $lozinka = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $drzava = $_POST['country'];

    if ($stmt->execute()) {
        echo "Registracija uspješna.";
    } else {
        echo "Greška prilikom registracije: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
