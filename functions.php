<?php
// fonction de connexion 
function pdo_connect_mysql()
{
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'root';
	$DATABASE_NAME = 'gestschool';
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	} catch (PDOException $exception) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Failed to connect to database!');
	}
}

function template_header($title)
{
	echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>'.$title.'</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		
		<!-- Vendor CSS Files -->
		<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
		<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	  
		<!-- Template Main CSS File -->
		<link href="assets/css/style.css" rel="stylesheet">
	</head>
	<body>
	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-flex align-items-center">
	  <div class="container d-flex justify-content-center justify-content-md-between">
		<div class="contact-info d-flex align-items-center">
		  <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">Email : gestschool@gmail.com</a></i>
		  <i class="bi bi-phone d-flex align-items-center ms-4"><span>Tél : 06.44.64.90.21</span></i>
		</div>
		<div class="social-links d-none d-md-flex align-items-center">
		  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
		  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
		  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
		  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
		</div>
	  </div>
	</section>
  
	<!-- ======= Header ======= -->
	<header id="header" class="d-flex align-items-center">
	  <div class="container d-flex justify-content-between align-items-center">
  
		<div class="logo">
		  <h1><a href="index.php">GEST-SCHOOL</a></h1>
		  <!-- Uncomment below if you prefer to use an image logo -->
		  <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
		</div>';

	if (isset($_SESSION['type'])) {

		if ($_SESSION['type'] == 'admin'){echo "<a href='indexadmin.php'><i class='fas fa-tools'></i>Compte Admin</a>";}

		if ($_SESSION['type'] == 'famille'){echo "<a href='indexfamille.php'><i class='fas fa-users'></i>Compte Famille</a>";}

		if ($_SESSION['type'] == 'eleve'){echo "<a href='indexeleve.php'><i class='fas fa-user-graduate'></i>Compte Elève</a>";}

		if ($_SESSION['type'] == 'enseignant'){echo "<a href='indexenseignant.php'><i class='fas fa-chalkboard-teacher'></i>Compte Enseignant</a>";}

		if ($_SESSION['type'] == 'admin' OR $_SESSION['type'] == 'famille' OR $_SESSION['type'] == 'eleve' OR $_SESSION['type'] == 'enseignant') {
			// $id = $_SESSION['id'];
			echo " 
			<nav id='navbar' class='navbar'>		
			<a href='index.php'><i class='fas fa-home'></i>Accueil</a>
        	<i class='bi bi-list mobile-nav-toggle'></i>
			<div class='dropdown'>
		<a class='btn text-primary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'><i class='fas fa-user'></i>
			Mon Compte
		</a>
		<ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
			<li><a class='dropdown-item' href='editCompte.php?id='>Modifier mon compte</a></li>
			<li><a class='dropdown-item' href='logout.php'>Déconnexion</a></li>
			</ul>
		</div>
		</nav>
		</div>
		</header>
		";
		}
		
	} else {
		echo '
		<nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php"><i class="fas fa-home"></i>Accueil</a></li>
          <li><a href="register.php"><i class="fas fa-address-book"></i>Inscription</a></li>
          <li><a href="login.php"><i class="fas fa-user"></i>Se connecter</a></li>
          <li><a href="contact.php"><i class="fas fa-envelope"></i>Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
';
	}
}
function template_footer()
{
	echo <<<EOT
<!-- ======= Footer ======= -->
<footer id="footer">

  <div class="footer-newsletter">
	<div class="container">
	  <div class="row">
		<div class="col-lg-6">
		  <h4>Notre Newsletter</h4>
		  <p>Restez au courant de l'actualité de GEST-SCHOOL</p>
		</div>
		<div class="col-lg-6">
		  <form action="" method="post">
			<input type="email" name="email"><input type="submit" value="S'abonner">
		  </form>
		</div>
	  </div>
	</div>
  </div>

  <div class="footer-top">
	<div class="container">
	  <div class="row">

		<div class="col-lg-3 col-md-6 footer-links">
		  <h4>Liens utiles</h4>
		  <ul>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Accueil</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">A Propos</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Conditions d'utilisation</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Mentions légales</a></li>
		  </ul>
		</div>

		<div class="col-lg-3 col-md-6 footer-links">
		  <h4>Nos Services</h4>
		  <ul>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Cours élémentaire</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Enseignement secondaire</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Enseignement supérieur</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Enseignement à distance</a></li>
			<li><i class="bx bx-chevron-right"></i> <a href="#">Cours particuliers</a></li>
		  </ul>
		</div>

		<div class="col-lg-3 col-md-6 footer-contact">
		  <h4>Contactez nous</h4>
		  <p>
			La Grande Arche<br>
			92044 Paris La Défense<br>
			France <br><br>
			<strong>Phone:</strong> 06.44.64.90.21<br>
			<strong>Email:</strong> gestschool@gmail.com<br>
		  </p>

		</div>

		<div class="col-lg-3 col-md-6 footer-info">
		  <h3>A propos de GEST-School</h3>
		  <p>Site d'enseignement dédié à l'étudiant et à son parcours scolaire. Notre ambition est de placer l'humain au coeur de l'enseignement.</p>
		  <div class="social-links mt-3">
			<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
			<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
			<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
			<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
			<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
		  </div>
		</div>

	  </div>
	</div>
  </div>

  <div class="container">
	<div class="copyright">
	  &copy; Copyright <strong><span>Gest-School</span></strong>. All Rights Reserved
	</div>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
    </body>
</html>
EOT;
}

// CRUD functions

// récupere tous les users
function getAllUsers()
{
	$con = pdo_connect_mysql();
	$requete = 'SELECT * from comptes';
	$rows = $con->query($requete);
	return $rows;
}

// creer un user
function createUser($username, $email, $type, $password)
{
	try {
		$con = pdo_connect_mysql();
		//echo $con;
		$sql = "INSERT INTO comptes (username, email, type, password) 
				VALUES ('$username', '$email', '$type' ,'$password')";
		$con->exec($sql);
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
}

//recupere un user
function readUser($id)
{
	$con = pdo_connect_mysql();
	$requete = "SELECT * from comptes where id = '$id' ";
	$stmt = $con->query($requete);
	$row = $stmt->fetchAll();
	if (!empty($row)) {
		return $row[0];
	}
}

//met à jour le user
function updateUser($id, $username, $email, $type, $password)
{
	try {
		$con = pdo_connect_mysql();
		$requete = "UPDATE utilisateurs set 
					username = '$username',
					email = '$email',
					type = '$type',
					passsword = '$password' 
					where id = '$id' ";
		$stmt = $con->query($requete);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

// suprime un user
function deleteUser($id)
{
	try {
		$con = pdo_connect_mysql();
		$requete = "DELETE from comptes where id = '$id' ";
		$stmt = $con->query($requete);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}


