<?php
require_once 'session.php';
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px;
            z-index: 1000;
        }

        .content {
            /* margin-top: 50px; */
            /* Adjust this if the navbar height changes */
            padding: 20px;
            height: calc(100vh - 50px);
            /* Adjust this if the navbar height changes */
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="content" id="content">
        <!-- Content will be loaded here -->
    </div>
    <script>
        function loadContent(url) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('content').innerHTML = xhr.responseText;
                } else {
                    console.error('Failed to load content:', xhr.statusText);
                }
            };
            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Load the default page content
            loadContent('/website/homepage.php');

            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var url = this.getAttribute('data-url');
                    loadContent(url);
                });
            });

            // Add event listener for profile button
            document.querySelector('.profile-link').addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.getAttribute('data-url');
                loadContent(url);
            });
        });
    </script>
</body>

</html>