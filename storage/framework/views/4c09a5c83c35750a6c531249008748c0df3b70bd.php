<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="image/logo_adidas_300px.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/fb3e250c04.js" crossorigin="anonymous"></script>
        <title>Design</title>
    </head>
    <body>
        <div class="struc">

            <div class="bloc1">
                <a href="#"><i class="fas fa-bars"></i></a>

                <div class="logo">
                    <img src="image/logo_adidas_100px.png" alt="logo Adidas">
                </div> 

                <nav>
                    <ul>
                        <li><a href="#">mens</a></li>
                        <li><a href="#">womens</a></li>
                        <li><a href="#">kids</a></li>
                        <li><a href="#">other</a></li>
                    </ul>
                </nav>

                <div class="slideshow-container">
                    <!-- Full-width images with number and caption text -->
                    <div class="mySlides fade">
                        <img src="image/A_vitality_1.png">
                    </div>

                    <div class="mySlides fade">
                        <img src="image/A_vitality_2.png">
                    </div>

                    <div class="mySlides fade">
                        <img src="image/A_vitality_3.png">
                    </div>
                </div>
                <br>

                <!-- Little points -->
                <div class="three-points">
                    <i class="fas fa-circle" onclick="currentSlide(1)"></i>
                    <i class="fas fa-circle" onclick="currentSlide(2)"></i>
                    <i class="fas fa-circle" onclick="currentSlide(3)"></i>
                </div>
            </div>



            <div class="bloc2">
                <div class="top-part">
                    <div class="search-box">
                        <form action="post">
                            <input class="search-text" type="text" placeholder="Search">
                            <a href="#"><i class="fas fa-search"></i></a>
                        </form>
                    </div>
                
                    <div class="log">
                        <p>Pas encore de compte ? <a href="#">Inscrivez-vous</a></p>
                        <p>Sinon <a href="#">Connectez-vous</a></p>
                    </div>
                </div>

                <div class="product-description">
                    <div class="product-name">
                        <h1>Adidas X Vitality</h1>
                    </div>
                    <div class="product-ref">
                        <p>Edition Spécial</p>
                    </div>
                    <div class="product-size-qty">
                        <!-- <input list="type_car" name="Car Type">
                            <datalist id="type_car"> -->
                            <select>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                            <!-- </datalist> -->
                            </select>
                    </div>
                    <div class="product-buy">
                        <button>buy now</button>
                    </div>
                    <div class="product-availability"></div>
                </div>
                
                
            </div>
        </div>
    </body>
    <script language="javascript">
        var slideIndex = 1;
        showSlides(slideIndex);

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        // for (i = 0; i < dots.length; i++) {
        //     dots[i].className = dots[i].className.replace(" active", "");
        // }
        slides[slideIndex-1].style.display = "block";
        // dots[slideIndex-1].className += " active";
        }
    </script>
</html><?php /**PATH Z:\laragon\www\Design\resources\views/accueil.blade.php ENDPATH**/ ?>