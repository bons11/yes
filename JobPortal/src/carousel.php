<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap Carousel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Your carousel will be inserted here -->
    <div class="container mt-5">
        <?php
        // Include the database connection and data fetching code here
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mbb_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT event_name, event_details, event_image FROM tbl_announcement";
        $result = $conn->query($sql);

        $announcements = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $announcements[] = $row;
            }
        } else {
            echo "0 results";
        }
        $basePath = 'uploads/';
        $conn->close();
        ?>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
            <ol class="carousel-indicators">
                <?php foreach ($announcements as $index => $announcement): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($announcements as $index => $announcement): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo $basePath . $announcement['event_image']; ?>" class="d-block w-100" alt="<?php echo $announcement['event_name']; ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $announcement['event_name']; ?></h5>
                            <p><?php echo $announcement['event_details']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
