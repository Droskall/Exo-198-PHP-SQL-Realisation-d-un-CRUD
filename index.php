<?php

require "./Classes/DB.php";

$db = DB::getInstance();

function create($nom, $prenom, $age, $db) {

    $add = $db->prepare("
            INSERT INTO eleves (nom, prenom, age)
            VALUES (:nom, :prenom, :age)
            ");
    $add->bindParam(':nom', $nom);
    $add->bindParam(':prenom', $prenom);
    $add->bindParam(':age', $age);

    return $add->execute();
}

/*create('Olivier', 'Dada', '21', $db);*/

function read($db) {
    $search = $db->prepare("SELECT * FROM eleves");

    $state = $search->execute();

    if($state) {
        $result = $search->fetchAll();
        foreach ($result as $user) {
            echo "<div> L'élève $user[id]: $user[prenom] $user[nom] à $user[age] ans</div>";
        }
    }
}

/*read($db);*/

function update($db, $nom, $prenom, $age, $id) {
    $search = $db->prepare("UPDATE eleves SET nom = :nom, prenom = :prenom, age = :age WHERE id = :id");

    $search->bindParam(':nom', $nom);
    $search->bindParam(':prenom', $prenom);
    $search->bindParam(':age', $age);
    $search->bindParam(':id', $id);

    $search->execute();
}

/*update($db, "Sparrow", "Jack", 36, 4);*/

function delete($db, $id) {
    $del = ("DELETE FROM eleves WHERE id = $id");
    $db->exec($del);
}

/*delete($db, '6');*/
