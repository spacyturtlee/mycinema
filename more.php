<!DOCTYPE html>
<html>
<head>
    <title>user subscription</title>
</head>
<body>
    <h1>user subscription</h1>
 
    <?php
    include "bd.php";
 
    function changeAccount($pdo){
        $userID = $_GET["id"];
        $sql= "SELECT user.id, user.firstname, user.lastname, user.email, subscription.name AS nosub FROM user
        LEFT JOIN membership ON user.id=membership.id_user
        LEFT JOIN subscription ON membership.id_subscription=subscription.id
        WHERE user.id = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userID' => $userID]);
        $a = "";
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($row['notAccount'])) {
            $row["noAccount"] = "No subscription";
        }
        $a .= $row["firstname"]. " " . $row["lastname"] . " subscription: " . $row["nosub"];
        return $a;
    }
 
    if (isset($_POST['change_subscription'])) {
        $userID = $_POST['userID'];
        $subscriptionID = $_POST['subscription'];
       
        // Check if the user already has a membership
        $sql = "SELECT * FROM membership WHERE id_user = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userID' => $userID]);
        $membership = $stmt->fetch(PDO::FETCH_ASSOC);
 
        if (isset($_POST['delete_subscription'])) {
            $sql = "DELETE FROM membership WHERE id_user = :userID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userID' => $userID]);
        } else {
            if ($membership) {
                // Update existing membership
                $sql = "UPDATE membership SET id_subscription = :subscriptionID WHERE id_user = :userID";
            } else {
                // Insert new membership
                $sql = "INSERT INTO membership (id_user, id_subscription) VALUES (:userID, :subscriptionID)";
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['subscriptionID' => $subscriptionID, 'userID' => $userID]);
        }
    }
 
    echo changeAccount($pdo);
    ?>
 
    <form method="post" action="">
        <label for="subscription">Change Subscription:</label>
        <select name="subscription" id="subscription">
            <?php
            $sql = "SELECT id, name FROM subscription";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <input type="hidden" name="userID" value="<?php echo $_GET['id']; ?>">
        <input type="checkbox" name="delete_subscription" id="delete_subscription">
        <label for="delete_subscription">Delete Subscription</label>
        <input type="submit" name="change_subscription" value="Change">
    </form>
</body>
</html>
 