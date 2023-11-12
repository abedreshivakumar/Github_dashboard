<!-- graph.php -->
<?php
// Include the database connection file
include_once 'db_connect.php';

// Retrieve repository ID from the URL parameter
$repositoryId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$repositoryId) {
    // Handle the case where no ID is provided
    echo 'Invalid repository ID.';
    exit();
}

// Fetch data for the selected repository
$stmt = $pdo->prepare("SELECT * FROM repositories WHERE id = :id");
$stmt->bindParam(':id', $repositoryId, PDO::PARAM_INT);
$stmt->execute();
$repositoryData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$repositoryData) {
    // Handle the case where no repository is found with the provided ID
    echo 'Repository not found.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Repository Chart</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Add this in the head section of your HTML file -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    /* styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

h1 {
    text-align: center;
    color: #333;
}

div {
    width: 80%;
    margin: 20px auto;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

p {
    margin-bottom: 10px;
}

#repositoryChartContainer {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#repositoryChart {
    width: 100%;
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
    <h1>GitHub Repository Chart</h1>

    <div>
        <p>Repository Name: <?= $repositoryData['name'] ?></p>
        <p>Repository URL: <a href="<?= $repositoryData['url'] ?>" target="_blank"><?= $repositoryData['url'] ?></a></p>
    </div>

    <!-- Add a chart container in your HTML file -->
    <div id="repositoryChartContainer">
        <canvas id="repositoryChart"></canvas>
    </div>

    <script>
        function showRepositoryChart(stars, forks, watchers) {
            // Update the chart with the fetched data
            updateChart(stars, forks, watchers);
        }

        function updateChart(stars, forks, watchers) {
            // Access the canvas and create a chart
            const ctx = document.getElementById('repositoryChart').getContext('2d');
            const repositoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Stars', 'Forks', 'Watchers'],
                    datasets: [{
                        label: 'GitHub Repository Stats',
                        data: [stars, forks, watchers],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Sample usage:
        showRepositoryChart(
            <?= $repositoryData['stars'] ?>,
            <?= $repositoryData['forks'] ?>,
            <?= $repositoryData['watchers'] ?>
        );
    </script>

    <!-- Back to Index link -->
    <p><a href="index.php">Back to Index</a></p>
</body>
</html>
