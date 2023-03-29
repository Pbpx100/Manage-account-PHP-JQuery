<?php
//Cretate database and tables
require_once('connexion.php');
//Function to connect to database
$conn = connexion();
//Defining database name
$dataname = "demo";

//Function to create database and tables
function create_database_and_tables($conn, $dataname)
{
    if ($conn) {
        echo "Connecting to database";
    } else {
        echo "Connecting error" . mysqli_error($conn);
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $dataname";
    if (mysqli_query($conn, $sql)) {
        echo "Successfully database created";
    }
    //Selecting our database
    mysqli_select_db($conn, $dataname);

    //Creating table mois
    $sql_table1 = "CREATE TABLE IF NOT EXISTS mois (id_mois INT(10) AUTO_INCREMENT NOT NULL PRIMARY KEY, 
        Janvier FLOAT NOT NULL,
        Fevrier FLOAT NOT NULL,
        Mars FLOAT NOT NULL,
        Avril FLOAT NOT NULL,
        MAi FLOAT NOT NULL,
        Juin FLOAT NOT NULL,
        Julliet FLOAT NOT NULL,
        AOut FLOAT NOT NULL,
        Septembre FLOAT NOT NULL,
        Octobre FLOAT NOT NULL,
        Novembre FLOAT NOT NULL,
        Decembre FLOAT NOT NULL,
        id_chantier INT NOT NULL,
        id_prestation INT NOT NULL,
        FOREIGN KEY (id_prestation) REFERENCES prestation(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
        FOREIGN KEY (id_chantier) REFERENCES chantier(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE

)";
    if (mysqli_query($conn, $sql_table1) === TRUE) {
        echo "Successfully table created";
    }

    //Creating table chantier
    $sql2 = "CREATE TABLE IF NOT EXISTS chantier(id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
name_chantier VARCHAR(255) NOT NULL,  PRIMARY KEY (id))";
    if (mysqli_query($conn, $sql2) === TRUE) {
        echo "Successfully table created";
    }

    //Creating table prestation
    $sql3 = "CREATE TABLE IF NOT EXISTS prestation(id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
name_prestations VARCHAR(255) NOT NULL, PRIMARY KEY (id))";
    if (mysqli_query($conn, $sql3) === TRUE) {
        echo "Successfully table created";
    }
}

//Function to select our database
function connexion_todemo($conn, $dataname)
{
    return mysqli_select_db($conn, $dataname);
}
