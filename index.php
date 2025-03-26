<?php
include "bd.php";

$movie = isset($_POST['movie']) ? $_POST['movie'] : '';
$director = isset($_POST['director']) ? $_POST['director'] : '';
$genre = isset($_POST['genre']) ? $_POST['genre'] : '';


$showMovies = false;

function searchMovies($pdo, $movie, $director, $genre)
{
    $sql = "
        SELECT 
            movie.id, 
            movie.title, 
            movie.director, 
            genre.name AS genre_name,
            movie.img
        FROM movie 
        INNER JOIN movie_genre ON movie.id = movie_genre.id_movie 
        INNER JOIN genre ON movie_genre.id_genre = genre.id
        WHERE movie.title LIKE :movie
          AND movie.director LIKE :director
          AND genre.name LIKE :genre
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':movie', '%' . $movie . '%');
    $stmt->bindValue(':director', '%' . $director . '%');
    $stmt->bindValue(':genre', '%' . $genre . '%');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($firstname) || !empty($lastname)) {
    $users_result = searchMembers($pdo, $firstname, $lastname);
    $showMembers = true;
} elseif (!empty($movie) || !empty($director) || !empty($genre)) {
    $movies_result = searchMovies($pdo, $movie, $director, $genre);
    $showMovies = true;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recherche de Films et Utilisateurs</title>
</head>

<body>
    <h1>Recherche</h1>


    <form method="POST" action="">
        <label for="movie">Nom du film :</label>
        <input type="text" id="movie" name="movie" value="<?php echo htmlspecialchars($movie); ?>"><br><br>

        <label for="director">Réalisateur :</label>
        <input type="text" id="director" name="director" value="<?php echo htmlspecialchars($director); ?>"><br><br>

        <label for="genre">Genre :</label>
        <select id="genre" name="genre">
            <option value="">Select Genre</option>
            <option value="Action" <?php echo $genre === 'Action' ? 'selected' : ''; ?>>Action</option>
            <option value="Adventure" <?php echo $genre === 'Adventure' ? 'selected' : ''; ?>>Aventure</option>
            <option value="Animation" <?php echo $genre === 'Animation' ? 'selected' : ''; ?>>Animation</option>
            <option value="Animation" <?php echo $genre === 'Animation' ? 'selected' : ''; ?>>Animation</option>
            <option value="Biography" <?php echo $genre === 'Biography' ? 'selected' : ''; ?>>Biography</option>
            <option value="Comedy" <?php echo $genre === 'Comedy' ? 'selected' : ''; ?>>Comedy</option>
            <option value="Crime" <?php echo $genre === 'Crime' ? 'selected' : ''; ?>>Crime</option>
            <option value="Drama" <?php echo $genre === 'Drama' ? 'selected' : ''; ?>>Drama</option>
            <option value="Family" <?php echo $genre === 'Family' ? 'selected' : ''; ?>>Family</option>
            <option value="Fantasy" <?php echo $genre === 'Fantasy' ? 'selected' : ''; ?>>Fantasy</option>
            <option value="Horror" <?php echo $genre === 'Horror' ? 'selected' : ''; ?>>Horror</option>
            <option value="Mystery" <?php echo $genre === 'Mystery' ? 'selected' : ''; ?>>Mystery</option>
            <option value="Romance" <?php echo $genre === 'Romance' ? 'selected' : ''; ?>>Romance</option>
            <option value="Sci-Fi" <?php echo $genre === 'Sci-Fi' ? 'selected' : ''; ?>>Sci-Fi</option>
            <option value="Thriller" <?php echo $genre === 'Thriller' ? 'selected' : ''; ?>>Thriller</option>

        </select>
        <button type="submit">Rechercher</button>
    </form><br><br>


    <form method="POST" action="">

    </form>
    <a href="./user.php">
        <button>search users</button>
    </a>

    <h2>Résultats</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Réalisateur / Prénom</th>
            <th>Genre / Nom</th>
        </tr>
        <?php

        if ($showMovies) {
            foreach ($movies_result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['director']) . "</td>";
                echo "<td>" . htmlspecialchars($row['genre_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row["img"]) .  "<td/>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Aucun résultat trouvé</td></tr>";
        }
        ?>
    </table>
</body>

</html>