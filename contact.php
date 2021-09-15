<?php
include 'functions.php';
?>

<?= template_header('Accueil') ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Accueil</a></li>
                <li>Contact</li>
            </ol>
            <h2>Contact</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Notre Adresse</h3>
                        <p>La Grande Arche, 92044 Paris La Défense, France</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email</h3>
                        <p>gestschool@gmail.com</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>Appelez Nous</h3>
                        <p>Tél: 06.44.64.90.21</p>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6 ">
                <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2623.1641522733007!2d2.2355634!3d48.8932087!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9dce86817f537c!2sGrande%20Arche%20de%20la%20D%C3%A9fense!5e0!3m2!1sfr!2sfr!4v1631612188601!5m2!1sfr!2sfr" width="100%" height="384px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Votre Nom" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Chargement</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Votre message a été envoyé. Merci!</div>
                        </div>
                        <div class="text-center"><button type="submit">Envoyer Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<?= template_footer() ?>