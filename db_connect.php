<?php
$host = "localhost";
$dbname = "github_data";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert sample data if the table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM repositories");
    $rowCount = $stmt->fetchColumn();

    if ($rowCount == 0) {
        // Insert sample data
        $pdo->exec("INSERT INTO repositories (name, url, stars, forks, watchers) VALUES
            ('Sample Repo 1', 'https://github.com/sample/repo1', 100, 50, 80),
            ('Sample Repo 2', 'https://github.com/sample/repo2', 150, 70, 120)");
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
