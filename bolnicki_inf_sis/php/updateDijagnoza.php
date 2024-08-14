<?php
session_start();
include ("baza.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['dijagnoza_id']) && isset($_POST['naziv']) && isset($_POST['opis'])) {
        $dijagnoza_id = $_POST['dijagnoza_id'];
        $naziv = $_POST['naziv'];
        $opis = $_POST['opis'];

        $query = $mysqli->prepare("UPDATE dijagnoze SET naziv = ?, opis = ? WHERE dijagnoza_id = ?");
        $query->bind_param("ssi", $naziv, $opis, $dijagnoza_id);

        if ($query->execute()) {
            header("Location: ../pacijent.php?success=1");
        } else {
            echo "Greška pri ažuriranju dijagnoze: " . $query->error;
        }
    } else {
        echo "Nedostaju podaci za ažuriranje.";
    }
} else {
    header("Location: ../pacijent.php");
    exit();
}
?>