<?php include_once 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 30px;
            padding-left: 15px;
            padding-top: 10px;
            font-family: 'Fanwood Text', serif;
            font-weight: bold;
        }

        .acc-link {
            display: none;
        }

        .profile-btn {
            border: none;
            background: none;
            padding: 0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-color: #fff;
            box-shadow: #fff 0 0 10px;
        }

        .profile-img {
            border-radius: 50%;
            height: 40px;
            object-fit: cover;
        }

        #content {
            padding: 20px;
        }

        .navbar-dark {
            background-color: #000 !important;
        }

        /* Custom styles for responsive behavior */
        .nav-link {
            margin-left: 15px;
            /* Adjust the value as needed */
            margin-right: 15px;
            /* Adjust the value as needed */
        }

        @media (max-width: 990px) {
            .profile-section {
                order: -1;
                text-align: center;
                margin-bottom: 10px;
                /* Adjust as needed */
                display: none;
            }

            .acc-link {
                display: inline-block;
            }

            .nav-links {
                text-align: center;
            }

            .profile-btn {
                border: none;
                background: none;
                padding: 0;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                background-color: #fff;
            }

            .profile-img {
                border-radius: 50%;
                height: 60px;
                object-fit: cover;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DailyBlogs</a>
            <button class="navbar-toggler profile-btn" type="button" data-bs-toggle="collapse" data-bs-target="#basic-navbar-nav" aria-controls="basic-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="" class="profile-img">
            </button>
            <div class="collapse navbar-collapse" id="basic-navbar-nav">
                <div class="d-flex flex-column flex-lg-row w-100 align-items-center justify-content-end">
                    <ul class="navbar-nav nav-links d-flex flex-row justify-content-space-around">
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-url="/website/admin.php">Admin</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-url="/website/homepage.php">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-url="/website/listing.php">listing</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-url="/website/messages.php">Message</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link acc-link" href="#" data-url="/website/account.php">Account</a>
                        </li>
                    </ul>
                    <div class="profile-section">
                        <a href="#" data-url="/website/account.php" class="profile-link">
                            <button class="profile-btn">
                                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="" class="profile-img">
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>