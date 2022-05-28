
<div class="mt-3 container p-5 w-50 animate__animated animate__backInDown">
    <div class="card shadow p-2" id="form-register-user">
        <div class="card-body">
            <div class="card-title">
                <h1 class="text-info">Inscription</h1>
            </div>
            <div class="card-text">
                <form method="post">

                    <div class="mb-3">
                        <label for="email_utilisateur">Votre email</label>
                        <input type="email" name="email_utilisateur" placeholder="Votre email" id="email_utilisateur" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_utilisateur">Votre mot de passe</label>
                        <input type="password" name="password_utilisateur" placeholder="Votre mot de passe" id="password_utilisateur" class="form-control" required>
                        <em class="text-secondary" style="font-size: 12px">Le mot de passe doit contenir 8 caractères, une majuscule, un symbole et des minisucules.</em>
                    </div>

                    <div class="mb-3">
                        <label for="repeat_password">Confirmer le mot de passe</label>
                        <input name="password_repeter" type="password" placeholder="Confirmer mot de passe" id="repeat_password" class="form-control" required>
                    </div>

                    <div class="my-3">
                        <em class="mt-3 text-info fw-lighter">
                            * À défaut, en application de l’article L 132-2 du Code de la consommation qui sanctionne les pratiques commerciales trompeuses, vous encourez une peine d’emprisonnement de 2 ans et une amende de 300 000 euros.
                        </em>
                    </div>

                    <div class="form-group">
                        <button name="btn-valide-inscription" type="submit" class="btn btn-outline-success">S'incrire</button>
                        <a href="accueil" class="btn btn-danger">Annuler</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




