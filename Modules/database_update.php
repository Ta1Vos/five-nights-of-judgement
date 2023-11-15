<?php

function updateVisits($tableName, $id){
global $pdo;
//Selects the visits out of the database
    $query = $pdo->prepare("SELECT visits FROM $tableName WHERE id=$id");
    $query->execute();
    //Updates the visits by one
    $visits = $query->fetchAll(PDO::FETCH_CLASS, 'Category');
    $visits = $visits[0]->visits;
    $visits++;
    //Updates the visits in the database
    $query = $pdo->prepare("UPDATE $tableName SET visits=:visits WHERE id=:id");
    $query->bindParam("visits", $visits);
    $query->bindParam("id", $id);
    if (!$query->execute()){
        echo "Er is iets fout gegaan";
    }
}
?>