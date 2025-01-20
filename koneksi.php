<?php

$conn = mysqli_connect("localhost", "root", "", "php-kos");


function tampil_satu($table, $where = "")
{
    global $conn;
    $query = "SELECT * FROM $table $where";
    $execute = $conn->query($query);
    $lihat = mysqli_fetch_assoc($execute);
    return $lihat;
}

function pindah($views)
{
    header("location:../$views");
}