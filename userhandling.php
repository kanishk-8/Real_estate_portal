// old userhandling function

<?php
// require_once 'session.php';
// include 'database.php';

$email = null;

$message = "<div class='success-message'>Wellcome please Login to continue!!</div>";
if (isset($_POST['login']) && $_POST['email'] && $_POST['password']) {
    // $userdetails = ($mysqli->query("SELECT * FROM users where email = '{$_POST['email']}'")->fetch_assoc());
    $userdetails = $mysqli->query("SELECT users.*, roles.role_name FROM users JOIN roles ON users.role_id = roles.id WHERE users.email = '{$_POST['email']}'")->fetch_assoc();

    if (!$userdetails) {
        $message = "<div class='error-message'>Invalid email!!</div>";
    } else {
        $email = $userdetails['email'];
        $passwords = $userdetails['password'];
        $role = $userdetails['role_name'];
        if (!password_verify($_POST['password'], $passwords)) {
            $message = "<div class='error-message'>Invalid password!!</div>";
        } elseif (password_verify($_POST['password'], $passwords)) {
            // $message = "<div class='success-message'>Welcome, " . $_POST['email'] . "!</div>";
            $_SESSION['login'] = true;
            $_SESSION['email'] = $userdetails['email'];
            $_SESSION['profileImage'] = $userdetails['profileImage'];
            $_SESSION['username'] = $userdetails['username'];
            $_SESSION['role'] = $userdetails['role_name'];
            $_SESSION['loginstring'] = hash('sha512', $_POST['email'] . rand());
            if ($_SESSION['role'] == 'admin') {
                header('Location: admin.php');
                exit();
            } else {
                header('Location: homepage.php');
                exit();
            }
        }
    }
} elseif (isset($_POST['signup']) && $_POST['email'] && $_POST['password'] && $_POST['username']) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
        $profileImage = $_FILES['profileImage']['name'];
        $extension = pathinfo($profileImage, PATHINFO_EXTENSION);
        $hashedEmail = hash('sha256', $email);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $hashedEmail . '.' . $extension;

        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFile)) {
            // File successfully uploaded
        } else {
            $targetFile = null; // No file uploaded or upload failed
            $message = "<div class='error-message'>Image upload failed!</div>";
        }
    } else {
        $targetFile = null; // No file uploaded or upload failed
    }

    $userdetails = ($mysqli->query("SELECT * FROM users where email = '{$_POST['email']}'")->fetch_assoc());
    if ($userdetails && $userdetails['email'] == $email) {
        $message = "<div class='error-message'>Email already exists!!</div>";
    } else {
        $mysqli->query("INSERT INTO users (profileImage, username, email, password) VALUES ('$targetFile', '$username', '$email', '$password')");
        $message = "<div class='success-message'>Wellcome, " . $email . "!</div>";

        header('Location: index.php');
        exit();

        // $message = "<div class='success-message'>Wellcome, " . $email . "!</div>";
    }
} else {
    if (isset($_POST['email']) && empty($_POST['email'])) {
        $message = "<div class='error-message'>Can't signup without email!</div>";
    }
    if (isset($_POST['password']) && empty($_POST['password'])) {
        $message = "<div class='error-message'>Can't signup without password!</div>";
    }
    if (isset($_POST['username']) && empty($_POST['username'])) {
        $message = "<div class='error-message'>Can't signup without name!</div>";
    }
}



// old navbar
// <php? include 'session.php'; 
?>
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

        .profile-btn {
            border: none;
            background: none;
            padding: 0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-color: #fff;
        }

        .profile-img {
            border-radius: 50%;
            /* width: 40px; */
            height: 40px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg border-body text-bg-dark" style="height: 50px;" data-bs-theme="dark">
        <a class="navbar-brand mr-auto" href="/Home">DailyBlogs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#basic-navbar-nav" aria-controls="basic-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end align-items-center" style="padding-right: 20px;" id="basic-navbar-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if ($_SESSION['role'] == 'admin') {
                        echo '<a class="nav-link"  href="/website/admin.php" style="padding-right: 30px;">Admin</a>';
                    } ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/website/homepage.php" style="padding-right: 30px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/website/blog.php" style="padding-right: 30px;">blog</a>
                </li>
                <li class="nav-item">
                    <button class="profile-btn">
                        <a href="/website/account.php">
                            <img src="<?php echo $_SESSION['profileImage']; ?>" alt="" class="profile-img">
                        </a>
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>