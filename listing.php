<!-- add home page code here -->
<!-- abhigyan -->
<?php
require_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CureTech</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            padding-top: 20px;
            /* display: flex; */
            /* width: 100%; */
            /* justify-content: center;
            align-items: center; */
        }

        .blogpage {
            display: flex;
            justify-content: start;
            padding: 10px;
            width: 100%;
            border-radius: 30px;
            align-items: center;
            background-color: black;
            height: auto;
            flex-direction: column;
            color: white;
        }

        .carousel {
            width: 640px;
            height: 360px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="blogpage">
            <h1>listed properties</h1>
        </div>

    </div>
    <div id="carouselExampleAutoplaying" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>


</html>