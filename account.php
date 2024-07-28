<?php
require_once 'session.php';
include 'database.php';
$userdetails = ($mysqli->query("SELECT * FROM users where email = '{$_SESSION['email']}'")->fetch_assoc());
$username = $userdetails['username'];
$email = $userdetails['email'];
$target = $userdetails['profileImage'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            overflow: hidden;
        }

        .profilepicture {
            border-radius: 50%;
            height: 110px;
            width: 110px;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
        }

        .profilepicture img {
            border-radius: 50%;
            height: 100px;
        }

        .container {
            padding-top: 40px;
            padding-bottom: 100px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;

        }

        .accountpage {
            display: flex;
            justify-content: start;
            padding: 20px;
            width: 45%;
            border-radius: 30px;
            align-items: center;
            background-color: black;
            height: auto;
            flex-direction: column;
            color: white;
        }

        .accountdetails {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        @media (max-width: 990px) {
            .container {
                flex-direction: column;
            }

            .accountpage {
                width: 90%;
                margin-bottom: 20px;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="accountpage">
            <h1>user account</h1>
            <div class="profilepicture">
                <img height="110px" src="<?php echo $target ?>" alt="">
            </div>
            <h3><?php echo 'Hello ' . $username; ?></h3>
            <div class="accountdetails">
                <h2>your user details are:</h2>
                <h4>email : <?php echo $email; ?></h4>
                <h4>you are: <?php echo $_SESSION['role']; ?></h4>
            </div>
            <br>
            <a class="btn btn-danger btn-lg" href="/website/logout.php?token=<?php echo $_SESSION['loginstring']; ?>">Logout</a>
        </div>
        <div class="accountpage">
            <h1>User Options</h1>

        </div>
    </div>

</body>

</html>