<?php 
include "../settings/core.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Homepage</title>
    <link rel="stylesheet" href="../css/home_about.css">
</head>
<body>

<header>
    <h1>Lost and Found</h1>
    <nav>
        <ul>
            <li><a href="../view/home_about.php">Home/About</a></li>
            <li><a href="#">Contact</a></li>
        
        </ul>
    </nav>
</header>

<section id="description">
    <h2>Project Description</h2>
    <p>Team 15 is developing a data powered website to help individuals in the Ashesi Community solve the problem of efficiently searching for and reclaiming their lost items. This website is made specifically for the entire Ashesi University community. This includes students, faculty, and staff. These users will actively engage with the platform to report and search for lost items.</p>
    <p>Students, in the Ashesi Student Council Welfare Committee will also be in charge of managing and updating the database to help other students, faculty, and staff easily find and get back their lost items within the university.</p>
    <p></p>
</section>
<div id="middle">
    <button class="button2" onclick="window.location.href = '../login/signup_view.php';">Register</button>
    <button class="button2" onclick="window.location.href = '../login/login_view.php';">Login</button>
</div>
<section id="team">
    <h2 style="text-align: center;">Our Team</h2>
    <div class="member">
        <img src="../images/freda.png" alt="Member 1" style="padding-right: 15px;">
        <h3>Freda-Marie Beecham</h3>
        <p id="bio">Meet Freda-Marie, a Computer Science student at Ashesi University. She's passionate about both coding and African literature. Problem-solving is her forte, whether it's debugging code or enjoying a mystery movie.</p>
    </div>
    <div class="member">
        <img src="../images/kiki.png" alt="Member 2" style="padding-right: 15px;">
        <h3>Nyameye Akumia</h3>
        <p id="bio">Nyameye Akumia is a Computer Science major with a background in engineering and the arts. He is very passionate about utilizing his creativity to enhance his productivity, synthesizing his interdisciplinary skills to innovate.</p>
    </div>
    <div class="member">
        <img src="../images/elton.png" alt="Member 3" style="padding-right: 15px;">
        <h3>Elton Gamor Fafali</h3>
        <p id="bio">Elton Fafali Gamor is a Management information Systems junior at Ashesi University with a background in Java and python programming languages as well as an intermediate level HTML, CSS and JavaScript. I specialize in crafting intuitive user interfaces and seamless user experiences.</p>
    </div>
    <div class="member">
        <img src="../images/sandra.jpeg" alt="Member 4" style="padding-right: 15px;">
        <h3>Sandra Nettey</h3>
        <p id="bio">Sandra Nettey: A 4th year CS student at Ashesi</p>
    </div>
    <div class="member">
        <img src="../images/heidi.jpeg" alt="Member 5" style="padding-right: 15px;">
        <h3>Heidi Hat</h3>
        <p id="bio">Heidi Hat, a computer science major student. Just want to make a functional website.</p>
    </div>
</section>

<footer>
    <p>&copy; 2024 Lost and Found. All rights reserved.</p>
</footer>

</body>
</html>
