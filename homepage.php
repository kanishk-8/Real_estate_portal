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

        .houselistings {
            padding-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .houseinfo {
            display: flex;
            justify-content: start;
            padding: 20px;
            width: 90%;
            border-radius: 30px;
            align-items: center;
            background-color: black;
            height: auto;
            flex-direction: column;
            color: white;
        }



        .details-map {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-content: space-between;
            padding: 10px;
        }

        .rounded-map {
            border-radius: 30px;
        }

        .priceinfo {
            font-size: 40px;
            font-weight: bold;
            color: white;
        }

        .info {
            text-align: start;
            margin-right: 20px;
        }

        .houseimg {
            border-radius: 30px;
            width: 97%;
            max-height: 400px;
            object-fit: cover;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 30px;
            margin-right: 30px;
        }

        .listings {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            padding: 10px;
        }

        .listing-item {
            background-color: #444;
            color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .listing-item img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include 'fetch_listings.php'; ?>

    <script>

    </script>
</body>

</html>