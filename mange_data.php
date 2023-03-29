<?php

//Function to insert data just two in all the tables to database
function insertdata_firstime($conn, $dataname)
{
    //Verifying connexion to database
    if (connexion_todemo($conn, $dataname)) {
        $conn->begin_transaction();

        //Change the values to insert the firsts datas to database 
        $query = "INSERT INTO chantier (name_chantier) VALUES ('Chantier1')";
        $conn->query($query);
        //Getting id from the last one value inserted in database
        $id_chantier = $conn->insert_id;

        $query1 = "INSERT INTO prestation (name_prestations) VALUES ('Remise en état mensuelle')";
        $conn->query($query1);
        //Getting id from the last one value inserted in database
        $id_prestation = $conn->insert_id;

        $query2 = "INSERT INTO mois (Janvier, Fevrier, Mars, Avril, MAi, Juin, Julliet, AOut, Septembre, Octobre, 
      Novembre, Decembre, id_prestation, id_chantier) VALUES (4, 1, 5, 9, 7, 6, 2, 80, 4, 2, 6, 1, $id_prestation, $id_chantier)";
        $conn->query($query2);

        if ($conn->errno) {
            echo "Error : " . $conn->error;
            $conn->rollback();
        } else {
            echo "Data inserted correctly";
            $conn->commit();
        }
        mysqli_close($conn);
    }
}
//Calling the function to insert firsts datas
//insertdata_firstime($conn, $dataname);

if (isset($_POST["acc"])) {
    switch ($_POST["acc"]) {
            //Case initialisation
        case 'init':

            if (connexion_todemo($conn, $dataname)) {
                //Selecting data from database
                $query =   "SELECT c.*, p.*, m.* FROM mois m LEFT JOIN chantier c ON m.id_chantier = c.id 
                INNER JOIN prestation p ON m.id_prestation = p.id";
                $result = mysqli_query($conn, $query);
                $output = array();

                //Fetching keys and values from database with MYSQLI_ASSOC
                foreach (mysqli_fetch_all($result, MYSQLI_ASSOC) as $data) {
                    //Saving the datas in array . array multidimensionnal 
                    array_push($output, $data);
                }
                //Sending the array in a json array
                echo json_encode($output);
                mysqli_close($conn);
            }

            break;

            //Case to remove data
        case 'remove':
            //Fetching the key from ajax 
            $id_mois = $_POST["id_mois"];
            if (connexion_todemo($conn, $dataname)) {
                $query =   "DELETE from mois WHERE id_mois = $id_mois";
                $result = mysqli_query($conn, $query);
                echo "Good work my friend";
                mysqli_close($conn);
            } else {
                echo "Imposible to remove";
            }
            break;

            //Case to insert data
        case "insert":
            if (connexion_todemo($conn, $dataname)) {
                //Getting Selected values 
                $name_chantier = $_POST["heure_chantier"];
                $name_prestation = $_POST["heure_prestation"];

                //Getting Values introduced in inputs
                $janvier = $_POST["heure_mois_1"];
                $fevrier = $_POST["heure_mois_2"];
                $mars = $_POST["heure_mois_3"];
                $avril = $_POST["heure_mois_4"];
                $mai = $_POST["heure_mois_5"];
                $juin = $_POST["heure_mois_6"];
                $julliet = $_POST["heure_mois_7"];
                $oaut = $_POST["heure_mois_8"];
                $septembre = $_POST["heure_mois_9"];
                $octobre = $_POST["heure_mois_10"];
                $novembre = $_POST["heure_mois_11"];
                $decembre = $_POST["heure_mois_12"];

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //Inserting values
                $query = "INSERT INTO mois (Janvier, Fevrier, Mars, Avril, MAi, Juin, Julliet, AOut, Septembre, Octobre, Novembre, Decembre, id_prestation, id_chantier) VALUES ($janvier, $fevrier, $mars, $avril, $mai, $juin, $julliet, $oaut, $septembre, $octobre, $novembre, $decembre, $name_chantier, $name_prestation)";
                $conn->query($query);
                //encoding response with status
                echo json_encode(array("statusCode" => 200));
                mysqli_close($conn);
            }
            break;
    }
}
