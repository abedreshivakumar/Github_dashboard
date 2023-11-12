
<?php
// Include the database connection file
include_once 'db_connect.php';

// Fetch data from the database
$stmt = $pdo->query("SELECT * FROM repositories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Repositories</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    /* styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h1 {
    text-align: center;
    color: #333;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #3498db;
    color: #fff;
}

tr:hover {
    background-color: #f5f5f5;
}

a {
    text-decoration: none;
    color: #3498db;
}

a:hover {
    text-decoration: underline;
    color: #2574a9;
}
</style>
</head>
<body>
    <h1>GitHub Repositories</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>URL</th>
            <th>View Chart</th>
            <th>Stars</th>
            <th>Forks</th>
            <th>Watchers</th>
            <th>Created At</th>
        </tr>

        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><a href="graph.php?id=<?= $row['id'] ?>" target="_blank"><?= $row['url'] ?></a></td>
                <td><a href="graph.php?id=<?= $row['id'] ?>" target="_blank">View Chart</a></td>
                <td><?= $row['stars'] ?></td>
                <td><?= $row['forks'] ?></td>
                <td><?= $row['watchers'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
