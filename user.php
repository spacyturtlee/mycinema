<?php

include  "bd.php";

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$showMembers = false;

function searchMembers($pdo, $firstname, $lastname)
{


    $sql1 = "
        SELECT *
        FROM user
        WHERE firstname LIKE :firstname
        AND lastname LIKE :lastname
    ";

    $stmt = $pdo->prepare($sql1);
    $stmt->bindValue(':firstname', '%' . $firstname . '%');
    $stmt->bindValue(':lastname', '%' . $lastname . '%');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if (!empty($firstname) || !empty($lastname)) {
    $users_result = searchMembers($pdo, $firstname, $lastname);
    $showMembers = true;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

</body>

</html>
<form action="" method="POST">
    <label for="firstname">prenom</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>"><br><br>

    <label for="lastname">nom</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>"><br><br>

    <button type="submit">Rechercher</button>
    <a href="./index.php">
        <button>return to index</button>
    </a>
</form>

<h2>Résultats</h2>
<table>
    <tr>
    <th>id</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>email</th>
        <th>address</th>
        <th>city</th>
        <th>country</th>

    </tr>
    <?php

    if ($showMembers) {
        if (!empty($users_result)) {
            foreach ($users_result as $row) {
                echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['firstname']) . "</td>
                <td>" . htmlspecialchars($row['lastname']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['address']) . "</td>
                <td>" . htmlspecialchars($row['city']) . "</td>
                <td>" . htmlspecialchars($row['country']) . "</td>
                <td>
                    <form method='post' class='form'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($row["id"]) . "'>
                        <button  type='submit' name='more' class='form-button'>More</button>
                    </form>
                </td>
            </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Aucun résultat trouvé</td></tr>";
        }
    }
    if (isset($_POST["more"])) {
        $userId = $_POST["user_id"] ?? '';
        if ($userId) {
            header("Location: more.php?id=" . $userId);
            exit();
        }
    }


    ?>