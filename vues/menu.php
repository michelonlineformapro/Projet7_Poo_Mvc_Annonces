<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="mic-location">
            <img class="logo-mic-annonces" src="assets/img/logo-mini.png" alt="Mic annonces" title="mic-annonces.com"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php
                    if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true ){
                        ?>
                        <li class="nav-item">
                            <p class="nav-link"><?= $_SESSION['email_admin'] ?></p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="espace_administration">ADMINISTRATION</a>
                        </li>
                        <?php
                    }elseif(isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-warning" href="gestion_annonces">TABLEAU DE BORD</a>
                        </li>
                        <li class="nav-item">
                            <p class="nav-link">Bienvenue : <b class="text-danger"><?= $_SESSION['email_utilisateur'] ?></b></p>
                        </li>
                        <?php
                    }else{
                        ?>
                        <!--Des liens a ajouter-->

                <?php
                    }
                ?>
            </ul>
            <form class="d-flex">
                <a href="inscription-utilisateur" class="mx-2 btn btn-outline-success">INSCRIPTION</a>
                <?php
                    if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true || isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){
                        ?>
                        <a href="deconnexion" class="mx-2 btn btn-outline-danger">DECONNEXION</a>
                        <?php
                    }else{
                        ?>
                        <a href="connexion-utilisateur" class="mx-2 btn btn-outline-warning">CONNEXION</a>
                        <?php
                    }
                ?>

            </form>
        </div>
    </div>
</nav>
