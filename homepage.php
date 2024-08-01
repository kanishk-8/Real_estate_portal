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
        }

        .blogpage {
            display: flex;
            justify-content: start;
            padding: 20px;
            width: 100%;
            border-radius: 30px;
            align-items: center;
            background-color: black;
            height: auto;
            flex-direction: column;
            color: white;
        }

        .carousel-item img {
            max-height: 400px;
            object-fit: cover;
        }

        .details-map {
            width: 100%;
            display: flex;
            justify-content: end;
            align-content: end;
            padding: 10px;
        }

        .rounded-map {
            border-radius: 30px;
        }

        .carousel {
            width: 100%;
        }

        .carousel-inner {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="blogpage">
            <h1>"Modern Amenities in a Serene Neighborhood"</h1>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
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
            <div class="details-map">
                <p>Nestled in the serene outskirts of Asheville, North Carolina, this charming bungalow offers a perfect blend of rustic charm and modern convenience. The property spans over a generous 2,500 square feet and sits on a lush half-acre lot adorned with mature oak trees and vibrant flower beds. Recently renovated, the home features an updated kitchen with granite countertops, stainless steel appliances, and hardwood floors throughout. The neighborhood is known for its friendly community atmosphere and is just a short walk from local parks, boutique shops, and top-rated schools. With its picturesque setting and impeccable condition, this property is an ideal haven for families looking to settle in a welcoming and vibrant area.</p>
                <iframe class="rounded-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56012.93903622581!2d77.2996535!3d28.6654464!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfc80c7b24911%3A0xa0d3109e7de9ce89!2sShyam%20Lal%20College%2C%20University%20of%20Delhi!5e0!3m2!1sen!2sin!4v1722166719184!5m2!1sen!2sin" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>


</html>