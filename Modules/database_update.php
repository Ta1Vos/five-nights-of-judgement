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

function updateCategoryTable(string $id, string $name, string $picture, string $description):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("UPDATE category SET name=:name AND picture=:picture AND description=:description WHERE id=:id");
        $query->bindParam("id", $id);
        $query->bindParam("name", $name);
        $query->bindParam("picture", $picture);
        $query->bindParam("description", $description);

        if ($query->execute()) {
            return true;
        }

        return false;
    } catch (PDOException $exception) {
        echo "<b>Something went wrong:</b><br><br>$exception<br><br>";
        return false;
    }
}
