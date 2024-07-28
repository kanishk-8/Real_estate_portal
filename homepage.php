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
        .card-holder {
            display: flex;
            justify-content: space-around;
            align-items: start;
            padding-top: 50px;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .card-img-top {
            height: 150px;
        }
    </style>
</head>

<body>
    <div>
        <h1>Wellcome <?php echo $_SESSION['email']; ?> </h1>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>