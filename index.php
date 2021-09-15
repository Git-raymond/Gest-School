<?php
include 'functions.php';
session_start();
?>

<?= template_header('Accueil') ?>

<!-- ======= Hero Section ======= -->
<section id="hero">
	<div class="hero-container">
		<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

			<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

			<div class="carousel-inner" role="listbox">

				<!-- Slide 1 -->
				<div class="carousel-item active" style="background: url(assets/img/slide/slide-1.jpg)">
					<div class="carousel-container">
						<div class="carousel-content">
							<h2 class="animate__animated animate__fadeInDown">Bienvenue sur <span>GEST-SCHOOL</span></h2>
							<p class="animate__animated animate__fadeInUp">L'éducation est l'essence de tout succès.</p>
							<a href="" class="btn-get-started animate__animated animate__fadeInUp">En savoir plus</a>
						</div>
					</div>
				</div>

				<!-- Slide 2 -->
				<div class="carousel-item" style="background: url(assets/img/slide/slide-2.jpg)">
					<div class="carousel-container">
						<div class="carousel-content">
							<h2 class="animate__animated fanimate__adeInDown">Les meilleurs cours <span>GEST-SCHOOL</span></h2>
							<p class="animate__animated animate__fadeInUp">Venez découvrir une nouvelle façon d'apprendre.</p>
							<a href="" class="btn-get-started animate__animated animate__fadeInUp">En savoir plus</a>
						</div>
					</div>
				</div>

				<!-- Slide 3 -->
				<div class="carousel-item" style="background: url(assets/img/slide/slide-3.jpg)">
					<div class="carousel-container">
						<div class="carousel-content">
							<h2 class="animate__animated animate__fadeInDown">Inscrivez-vous sur <span>GEST-SCHOOL</span></h2>
							<p class="animate__animated animate__fadeInUp">Dépêchez-vous les places sont limitées ! </p>
							<a href="" class="btn-get-started animate__animated animate__fadeInUp">En savoir plus</a>
						</div>
					</div>
				</div>

			</div>

			<a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
				<span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
			</a>

			<a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
				<span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
			</a>

		</div>
	</div>
</section><!-- End Hero -->

<main id="main">

	<!-- ======= Featured Section ======= -->
	<section id="featured" class="featured">
		<div class="container">

			<div class="row">
				<div class="col-lg-4">
					<div class="icon-box">
						<i class="bi bi-card-checklist"></i>
						<h3><a href="">Enseignement de qualité</a></h3>
						<p>Nous recrutons des enseignants dont les compétences sont en adéquation avec le référentiel de compétences professionnelles.</p>
					</div>
				</div>
				<div class="col-lg-4 mt-4 mt-lg-0">
					<div class="icon-box">
						<i class="bi bi-bar-chart"></i>
						<h3><a href="">Taux de réussite élevé</a></h3>
						<p>En 2020, le taux de réussite a été de 99% avec 99% de mentions (moyenne 19,5).</p>
					</div>
				</div>
				<div class="col-lg-4 mt-4 mt-lg-0">
					<div class="icon-box">
						<i class="bi bi-binoculars"></i>
						<h3><a href="">Préparer l'avenir</a></h3>
						<p>L'enseignant innovateur met en oeuvre un dispositif opératoire de formation préparant à l'autonomisation.</p>
					</div>
				</div>
			</div>

		</div>
	</section><!-- End Featured Section -->

	<!-- ======= About Section ======= -->
	<section id="about" class="about">
		<div class="container">

			<div class="row">
				<div class="col-lg-6">
					<img src="assets/img/about.jpg" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 pt-4 pt-lg-0 content">
					<h3>GEST-SCHOOL dispense un enseignement général conformément au programme officiel de l’Education National.</h3>
					<p class="fst-italic">
						Il a pour objectifs la réussite et l'épanouissement des élèves.
					</p>
					<ul>
						<li><i class="bi bi-check-circle"></i> La progression de chacun des élèves.</li>
						<li><i class="bi bi-check-circle"></i> L’instauration d’un climat scolaire apaisé propice aux apprentissages.</li>
						<li><i class="bi bi-check-circle"></i> Le développement de leur ambition scolaire et professionnelle,.</li>
					</ul>
					<p>
						Notre établissement veut permettre à chaque élève d’exprimer son potentiel en lui proposant des aides personnalisées et en lui transmettant les règles de vie en société. Il y découvrira l’importance de la vie collective, ses droits et ses devoirs, la richesse de la différence et le sentiment d’appartenance.
					</p>
				</div>
			</div>

		</div>
	</section><!-- End About Section -->

	<!-- ======= Services Section ======= -->
	<section id="services" class="services">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
					<div class="icon-box">
						<div class="icon"><i class="bx bxl-dribbble"></i></div>
						<h4><a href="">Le désir de transmettre</a></h4>
						<p>L’envie de communiquer son savoir reste une qualité primordiale de l’enseignant. Donner aux élèves les compétences pour construire étage par étage l’édifice de leurs connaissances doit constituer la motivation première de l’enseignant.

							Sans elle, la profession risque de paraître fade et peu gratifiante, car l’observation des progrès et des efforts accomplis par les élèves est sûrement l’une des plus belles récompenses du métier. Lorsque le résultat des efforts déployés tarde à se manifester chez les élèves, cette envie d’apprendre peut devenir source de frustration. Elle reste quoi qu’il en soit indispensable à l’exercice de la profession.</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
					<div class="icon-box">
						<div class="icon"><i class="bx bx-file"></i></div>
						<h4><a href="">La faculté d’adaptation</a></h4>
						<p>Pour permettre aux élèves de construire leurs compétences, l’enseignant doit toujours tenter d’utiliser les «outils» les mieux appropriés et les plus actuels, une tâche rendue toujours plus ardue par l’accélération de l’apparition de nouvelles technologies.

							L’enseignant doit par ailleurs s’adapter constamment aux résultats de la recherche en pédagogie pour revoir la dynamique et le contenu de ses cours et prendre en compte les modifications des lois et du système d’enseignement. La profession n’a rien de figé ou de traditionaliste: l’enseignant est aux premières loges de l’évolution de la société!</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
					<div class="icon-box">
						<div class="icon"><i class="bx bx-world"></i></div>
						<h4><a href="">La capacité à collaborer</a></h4>
						<p>Savoir travailler en équipe est une des compétences clés de l’enseignant. Il doit être capable de collaborer efficacement avec l’équipe d’enseignants de son école, mais aussi être à même de travailler avec des psychologues, des travailleurs sociaux et des psychiatres et de dialoguer régulièrement avec les autorités.

							L’enseignant doit également représenter un interlocuteur professionnel et digne de confiance face aux parents d’élèves qui attendent parfois d’être rassurés. Loin d’être une profession individualiste, l’enseignement est un véritable travail d’équipe.</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
					<div class="icon-box">
						<div class="icon"><i class="bx bx-tachometer"></i></div>
						<h4><a href="">La gestion des responsabilités</a></h4>

						<p>L’enseignement est une fonction qui implique des responsabilités importantes. Ce sont les savoirs et les compétences transmis durant leur scolarité qui permettront aux élèves de construire leurs connaissances, leurs opinions et à terme, leur identité.

							Avant de se lancer dans la formation, le futur enseignant doit être conscient du niveau élevé de responsabilité qu’il devra être capable d’assumer durant sa carrière.</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
					<div class="icon-box">
						<div class="icon"><i class="bx bx-slideshow"></i></div>
						<h4><a href="">La réactivité et la sensibilité</a></h4>
						<p>L’incertitude est inhérente à la profession. Tout au long de sa carrière, l’enseignant doit savoir réagir à des situations très diverses et faire preuve de créativité. Cette aptitude est d’autant plus importante que notre société devient toujours plus multiculturelle. Les classes s’internationalisent et l’imprévu s’ancre encore davantage dans le quotidien. La gestion de cette diversité exige de l’enseignant qu’il fasse preuve d’une sensibilité accrue aux différences culturelles afin de réagir au mieux aux nouvelles situations qui se présentent à lui.</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
					<div class="icon-box">
						<div class="icon"><i class="bx bx-arch"></i></div>
						<h4><a href="">L'aptitude à être porteur de savoir</a></h4>
						<p>L’enseignement est une profession exigeante. Elle requiert de l’enseignant qu’il maîtrise parfaitement les disciplines qu’il enseigne mais aussi qu’il en possède une vision critique et en connaisse les limites. Il doit aussi être capable de présenter différents points de vue qui correspondent à la diversité des courants théoriques.

							Le rôle de porteur de savoir implique aussi que l’enseignant porte un regard critique sur lui-même et sur sa fonction. Il doit être conscient de ses propres habitudes culturelles et de la manière dont elles influencent sa manière d’enseigner.</p>
					</div>
				</div>

			</div>

		</div>
	</section><!-- End Services Section -->

	<!-- ======= Clients Section ======= -->
	<section id="clients" class="clients">
		<div class="container">

			<div class="section-title">
				<h2>Nos partenaires</h2>
				<p>Constamment en quête de l'excellence dans l'enseignement et en formation continue notre ambition est de placer l'humain au cœur de l'apprentissage.

					Nous avons mis en place une politique RH intégrant le recrutement et le maintien dans l'emploi des collaborateurs en situation de handicap.</p>
			</div>

			<div class="clients-slider swiper-container">
				<div class="swiper-wrapper align-items-center">
					<div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
					<div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
				</div>
				<div class="swiper-pagination"></div>
			</div>

		</div>
	</section><!-- End Clients Section -->

</main><!-- End #main -->

<?= template_footer() ?>