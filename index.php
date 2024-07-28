<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
    <style>
        #message {
            color: red;
            margin-top: 10px;
        }

        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-bottom: 10px; */
        }

        .profile-icon {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ccc;
            box-shadow: darkgray 0 0 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #signup-message,
        #signin-message {
            text-align: center;
            margin-top: 10px;
        }

        @media (max-width: 768px) {

            .toggle-panel p {
                font-size: 12px;
                /* Increased font size */
            }

            .toggle-panel h1 {
                font-size: 18px;
                /* Increased font size */
            }

            .toggle-panel button {
                font-size: 12px;
                /* Increased font size */
                padding: 8px 20px;
                /* Reduced padding */
            }

            .container {
                padding: 20px;
                /* Reduced padding */
            }

            body {
                padding: 4px;
            }

            .form-container {
                padding: 10px;
                /* Reduced padding */
            }

            .form-container h1 {
                font-size: 18px;
                /* Increased font size */
            }

            .container input {
                font-size: 12px;
                /* Increased font size */
                padding: 8px 12px;
                /* Reduced padding */
                width: 100%;
                margin: 5px 0;
            }



            .form-container input {
                font-size: 12px;
                padding: 6px 10px;
                /* Increased font size */
            }

            .container form {
                padding: 4px;
                /* Reduced padding */
            }


        }
    </style>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up" id="signUpForm">
            <form id="signup-form" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <br>
                <div class="profile-container">
                    <div class="profile-icon" onclick="document.getElementById('fileInput').click();">
                        <img id="profileImage" height="100px" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
                    </div>
                    <input type="file" id="fileInput" name="profileImage" style="display: none;" onchange="uploadImage()">
                </div>
                <div id="signup-message"><br></div>
                <input type="email" placeholder="Email" id="signup-email" name="email" autocomplete="off">
                <input type="text" placeholder="Name" id="signup-username" name="username" autocomplete="off">
                <input type="password" placeholder="Password" id="signup-password" name="password" autocomplete="off">
                <button type="button" onclick="signup()">SignUp</button>
            </form>
        </div>
        <div class="form-container sign-in" id="signInForm">
            <form id="signin-form">
                <h1>Sign In</h1>
                <div id="signin-message"><br></div>
                <input type="email" placeholder="Email" id="signin-email" name="email">
                <input type="password" placeholder="Password" id="signin-password" name="password">
                <button type="button" onclick="login()">Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Already a part of our community? Sign in with your credentials to continue</p>
                    <button class="hidden" id="showSignIn">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>New to dailyblogs? Create an account and become part of our community</p>
                    <button class="hidden" id="showSignUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const validImageFormats = ['jpg', 'jpeg', 'png', 'gif'];

        function uploadImage() {
            var fileInput = document.getElementById('fileInput');
            var profileImage = document.getElementById('profileImage');
            var messageDiv = document.getElementById('signup-message');
            var file = fileInput.files[0];

            if (file) {
                var fileExtension = file.name.split('.').pop().toLowerCase();

                if (validImageFormats.includes(fileExtension)) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    }

                    reader.readAsDataURL(file);
                    messageDiv.innerHTML = '<br>'; // Clear any previous messages
                } else {
                    messageDiv.innerHTML = 'Invalid image format!.';
                    messageDiv.style.color = 'red'; // Ensure the message is red on error
                    fileInput.value = ''; // Clear the input
                }
            }
        }

        function sendAjaxRequest(url, formData, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", url, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        callback(response);
                    } else {
                        console.error('Request failed with status:', xhr.status);
                    }
                }
            };
            xhr.send(formData);
        }

        function signup() {
            var form = document.getElementById('signup-form');
            var formData = new FormData(form);

            sendAjaxRequest('signup.php', formData, function(response) {
                var messageDiv = document.getElementById('signup-message');
                if (response.success) {
                    messageDiv.innerHTML = response.message;
                    messageDiv.style.color = 'green'; // Change text color to green for success
                    document.getElementById('signup-form').reset();
                    document.getElementById('profileImage').src = 'https://cdn-icons-png.flaticon.com/512/149/149071.png';
                } else {
                    messageDiv.innerHTML = response.message;
                    messageDiv.style.color = 'red'; // Change text color to red for errors
                }
            });
        }

        function login() {
            var form = document.getElementById('signin-form');
            var formData = new FormData(form);

            sendAjaxRequest('login.php', formData, function(response) {
                var messageDiv = document.getElementById('signin-message');
                if (response.success) {
                    messageDiv.innerHTML = response.message;
                    messageDiv.style.color = 'green'; // Change text color to green for success
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                } else {
                    messageDiv.innerHTML = response.message;
                    messageDiv.style.color = 'red'; // Change text color to red for errors
                }
            });
        }

        function handleEnterKey(event, formId, callback) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default form submit action
                callback(); // Call the appropriate function (signup or login)
            }
        }

        document.getElementById('signup-form').addEventListener('keydown', function(event) {
            handleEnterKey(event, 'signup-form', signup);
        });

        document.getElementById('signin-form').addEventListener('keydown', function(event) {
            handleEnterKey(event, 'signin-form', login);
        });

        const container = document.getElementById('container');
        const showSignUp = document.getElementById('showSignUp');
        const showSignIn = document.getElementById('showSignIn');

        const currentForm = localStorage.getItem('currentForm') || 'signIn';

        if (currentForm === 'signUp') {
            container.classList.add('active');
        }

        showSignUp.addEventListener('click', () => {
            container.classList.add('active');
            localStorage.setItem('currentForm', 'signUp');
        });

        showSignIn.addEventListener('click', () => {
            container.classList.remove('active');
            localStorage.setItem('currentForm', 'signIn');
        });
    </script>
</body>

</html>