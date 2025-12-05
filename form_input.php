<?php
/**
 * Program memanfaatkan Program 10.2 untuk membuat form inputan sederhana.
 */

include "form.php";

echo "<html><head><title>Mahasiswa</title></head><body>";

$form = new Form("", "Input Form");
$form->addField("txtnim", "NIM");
$form->addField("txtnama", "Nama");
$form->addField("txtalamat", "Alamat");

echo "<h3>Silahkan isi form berikut ini :</h3>";
$form->displayForm();


// ============================
// TAMPILKAN DATA YANG DITERIMA
// ============================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nim    = $_POST['txtnim'];
    $nama   = $_POST['txtnama'];
    $alamat = $_POST['txtalamat'];

    echo "<h3>Data yang diterima:</h3>";
    echo "<ul>";
    echo "<li><strong>nim:</strong> $nim</li>";
    echo "<li><strong>nama:</strong> $nama</li>";
    echo "<li><strong>alamat:</strong> $alamat</li>";
    echo "</ul>";
}

echo "</body></html>";
?>