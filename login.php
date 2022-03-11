<?php 
    $admin = [
        'id' => 'master',
        'password' => 'motdepasse']; 
?>
<?php 
// Validation du formulaire
if (isset($_POST['id']) &&  isset($_POST['password'])) {
        if (
            $admin['id'] === $_POST['id'] &&
            $admin['password'] === $_POST['password']
        ) {
            $loggedUser = true ;
        } else {
            $errorMessage = 'ID ou mot de passe incorrect';
        }
}
?>
<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<div class="container mt-3 mb-3">
    <?php if(!isset($loggedUser)): ?>
        <form action="staff.php" class='form-control' method="post">
            <!-- si message d'erreur on l'affiche -->
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="id"  placeholder="Votre ID">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <!-- 
            Si utilisateur/trice bien connectée on affiche un message de succès
        -->
    <?php else: ?>
        <div class="alert alert-success" role="alert">
            Authentification réussie!
        </div>
        <?php $_SESSION['id'] =$_POST['id'];
            $_SESSION['password'] =$_POST['password'];
            unset($_POST);
        ?>
    <?php endif; ?>
</div>


