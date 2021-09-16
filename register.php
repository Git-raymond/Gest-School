<?php
require_once 'connexion.php';
include 'functions.php';
session_start();
?>

<?= template_header('Inscription') ?>

<body>

    <?php
    if (isset($_REQUEST['valider'])) {
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $type = $_REQUEST['type'];
        $password = hash('sha256', $_REQUEST['password']);

        if (empty($username)) {
            $errorMsg = "Entrez votre nom";
        } else if (empty($password)) {
            $errorMsg = "Entrez votre mot de passe";
        } else if (empty($email)) {
            $errorMsg = "Entrez votre email";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "Entrez une adresse email valide";
        } else if (strlen($password) < 5) {
            $errorMsg = "Le mot de passe doit contenir au moins 5 caractères";
        } else {
            try {
                $select_stmt = $db->prepare("SELECT username, email FROM comptes WHERE username=:uusername OR email=:uemail");
                $select_stmt->bindParam(":uusername", $username);
                $select_stmt->bindParam(":uemail", $email);
                $select_stmt->execute();
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

                if (isset($row["username"])) {
                    if ($row["username"] == $username) {
                        $errorMsg = "Le nom existe déjà. En choisir un autre.";
                    } else if ($row["email"] == $email) {
                        $errorMsg = "L'adresse email existe déjà. En choisir une autre.";
                    }
                } else if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO comptes(username, email, password, type) VALUES(:uusername, :uemail, :upassword, :utype)");
                    $insert_stmt->bindParam(":uusername", $username);
                    $insert_stmt->bindParam(":uemail", $email);
                    $insert_stmt->bindParam(":upassword", $password);
                    $insert_stmt->bindParam(":utype", $type);

                    if ($insert_stmt->execute()) {
                        $registerMsg = "Inscription validée. Redirection vers la page Connexion.";
                        header("refresh:1; login.php");
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


    ?>
    <div class="container">
        <div class="jumbotron text-center">
            <form class="box text-primary" action="" method="post" name="login">
                <h1 class="box-logo box-title mt-5 mb-4">REJOIGNEZ NOUS</h1>
                <h1 class="box-title mb-3 text-secondary">Inscription</h1>
                <br>
                <div class="margin-input">
                    <input type="hidden" class="box-input mb-3 rounded" name="type" placeholder="Type" value="famille">
                    </select>
                </div>
                <div class="margin-input">
                    <input type="text" class="box-input mb-3 rounded" name="username" placeholder="Nom de famille">
                </div>
                <div class="margin-input">
                    <input type="text" class="box-input mb-3 rounded" name="email" placeholder="Email" required />
                </div>
                <div class="margin-input">
                    <input type="password" class="box-input mb-3 rounded" name="password" placeholder="Mot de passe">
                </div>
                <!-- <div class="margin-input">
                    <input type="submit" name="valider" value="S'inscrire" class="box-button mb-3 rounded shadow">
                </div> -->

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    S'inscrire
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="modal-title  w-100" id="staticBackdropLabel">CONTRAT DE SCOLARISATION</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                GROUPE SCOLAIRE XX
                                ETABLISSEMENT PRIVE D’ENSEIGNEMENT ASSOCIE A L’ETAT PAR CONTRAT (D'ASSOCIATION) / (SIMPLE)<br><br>
                                IL EST OBLIGATOIRE D’INDIQUER TANT LE CARACTERE PRIVE DE L’ETABLISSEMENT QUE LE TYPE DE CONTRAT QUI LE LIE A L’ETAT
                                <br><br>
                                • ARTICLE 1ER - OBJET
                                La présente convention a pour objet de définir les conditions dans lesquelles l’enfant sera scolarisé par le(s) parent(s) au sein de l’établissement, ainsi que les droits et les obligations réciproques de chacune des parties.
                                <br><br>
                                • ARTICLE 2 - OBLIGATIONS DE L'ETABLISSEMENT
                                L'établissement s’engage à scolariser l’enfant pour l’année scolaire 2021 - 2022 et pour les années suivantes selon le vœu des parents, sauf cause réelle et sérieuse justifiant la non poursuite de la scolarisation de l’enfant dans l’établissement, (cf. article 7-2 ci-dessous).
                                L’établissement a mis en place une grille de tarifs en fonction du quotient familial. Des justificatifs de ressources seront demandés pour les X premières catégories. L’établissement s’engage à respecter la confidentialité de ces informations.
                                L'établissement s’engage par ailleurs à assurer d’autres prestations selon les choix définis par les parents en annexe.
                                <br><br>
                                • ARTICLE 3 - OBLIGATIONS DES PARENTS
                                Le(s) parent(s) s’engage(nt) à inscrire l’enfant.
                                Le(s) parent(s) reconnaît(ssent) avoir pris connaissance du projet éducatif, du règlement intérieur et du règlement financier de l’établissement, y adhérer et mettre tout en œuvre afin de le respecter.
                                Le(s) parent(s) reconnaît(ssent) avoir pris connaissance du coût de la scolarisation de leur enfant au sein de l'établissement.
                                Le(s) parent(s) s’engage(nt) à en assurer la charge financière, dans les conditions du règlement financier annexé à la présente convention et mis à jour annuellement.
                                <br><br>
                                • ARTICLE 4 - COUT DE LA SCOLARISATION
                                Le coût de la scolarisation comprend plusieurs éléments :
                                - la contribution des familles
                                - les prestations parascolaires choisis pour votre enfant (cantine, garderie, étude surveillée, internat, participation à des voyages scolaires, …)
                                - les adhésions volontaires aux associations qui participent à l’animation de l’établissement scolaire de votre enfant : association de parents d’élèves : APEL, association sportive : UGSEL, dont le détail et les modalités de paiement figurent dans le règlement financier, remis en annexe.
                                <br><br>
                                • ARTICLE 5 – MODALITES DE PAIEMENT
                                Les contributions des familles et les prestations annexes choisies par les parents, sont payées par
                                - prélèvement bancaire
                                - par chèque
                                - en espèce
                                Plusieurs rythmes de paiement sont proposés aux familles :
                                - mensuellement, en 10 fois ?
                                - trimestriellement, en 3 fois ?
                                Les frais bancaires seront refacturés aux parents si le prélèvement automatique ou le chèque a été rejeté.
                                Lors de l’inscription ou de la réinscription de l’enfant, un acompte est versé par les parents ; cet acompte viendra en déduction du 1er trimestre scolaire. En cas de désistement, cet acompte sera conservé par l’établissement.
                                Lors de la 1ère inscription de l’enfant, des frais de dossier s’ajoutent à l’acompte.
                                <br><br>
                                • ARTICLE 6 - ASSURANCES
                                Le(s) parent(s) s’engage(nt) à assurer l’enfant pour ces activités scolaires, et à produire une attestation d’assurance.
                                <br><br>
                                • ARTICLE 7 - DEGRADATION VOLONTAIRE DU MATERIEL
                                La remise en état ou le remplacement du matériel dégradé par un élève fera l'objet d'une facturation au(x) parent(s) sur la base du coût réel incluant les frais de main-d'œuvre.
                                <br><br>
                                • ARTICLE 8 - DUREE ET RESILIATION DU CONTRAT
                                La présente convention est d’une durée équivalente au cycle scolaire.
                                8-1 RESILIATION EN COURS D’ANNEE SCOLAIRE :
                                Sauf sanction disciplinaire ou motif grave, la présente convention ne peut être résiliée par l’établissement en cours d’année scolaire.
                                En cas d’abandon de la scolarité en cours d’année scolaire sans cause réelle et sérieuse reconnue par l’établissement, le(s) parent(s) reste(nt) redevable(s) envers l'établissement d’une indemnité de résiliation.
                                Le coût de la scolarisation au prorata temporis pour la période écoulée, restent dus dans tous les cas.
                                Les causes réelles et sérieuses de départ de l’élève en cours d’année sont :
                                ➞ Le déménagement,
                                ➞ Le changement d’orientation vers une section non assurée par l’établissement,
                                ➞ Le désaccord sur le projet éducatif de l’établissement, perte de confiance entre la famille et l’établissement…
                                ➞ Tout autre motif légitime accepté expressément par l’établissement.
                                8-2 RESILIATION AU TERME D’UNE ANNEE SCOLAIRE :
                                Les parents informent l’établissement de la non-réinscription de leur enfant durant le second trimestre scolaire, à l’occasion de la demande qui est faite à tous les parents d’élèves, et au plus tard le 1er juin.
                                L’établissement s’engage à respecter ce même délai (le 1er juin) pour informer les parents, de la non-réinscription de leur enfant, pour une cause réelle et sérieuse (impayés, désaccord sur le projet éducatif de l’établissement, perte de confiance entre la famille et l’établissement…)
                                <br><br>
                                • ARTICLE 9 - DROIT D'ACCES AUX INFORMATIONS RECUEILLIES
                                Les informations recueillies dans le cadre de cette convention et de ces annexes sont obligatoires pour l’inscription dans l’établissement. Elles font l’objet de traitements informatiques. Seules les données répondant à des obligations légales de conservation ou d’archivage sont conservées, au départ de l’élève, dans les dossiers de l’établissement.
                                Sauf opposition écrite, les parents autorisent également gracieusement l’établissement à diffuser ou reproduire pour sa communication interne ou externe pour tous usages les photos et/ou vidéos représentant leur enfant. Cette autorisation est donnée pour tout type de support écrit ou électronique et pour une durée indéterminée.
                                Conformément à la loi "informatique et libertés" et à l’ensemble de la règlementation sur la protection des données personnelles -RGPD- les parents bénéficient d’un droit d’accès et de rectification aux informations concernant leur enfant. Pour exercer ce droit et obtenir communication des informations vous concernant, les parents pourront s’adresser au chef d'établissement. Une note d’information, annexée à la présente convention, précise quelles sont les données à caractère personnel qui sont traités au sein de l’établissement scolaire, et des droits d’accès, de rectification, d’opposition et d’effacement dont vous disposez.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Je refuse</button>
                                <button type="submit" name="valider" class="btn btn-success">J'accepte</button>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="box-register p-3 rounded mx-auto">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
                <?php if (!empty($errorMsg)) { ?>
                    <p class="text-danger"><?php echo $errorMsg; ?></p>
                <?php } ?>
                <?php if (!empty($registerMsg)) { ?>
                    <p class="text-success"><?php echo $registerMsg; ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
    <br>
</body>

</html>

<?= template_footer() ?>