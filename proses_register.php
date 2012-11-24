<?php
/* 
 * Script untuk memproses form register.
 */

    require_once "autoload.php";

    // extract hasil field kiriman dari form.
    extract($_POST);
    
    // melakukan proses register.
    $client = new SoapClient(PEER4); // mesin kita sendiri.
    echo $client->register($field_id, $field_nama, HERE);
    
    // pesan
    echo "Register telah dilakukan.<br />";
    echo "Mohon periksa kembali apakah datanya sudah ada sebelumnya.<br /><br />";
    echo "<a href=\"interface/home.php\">Kembali</a>";
    
?>
