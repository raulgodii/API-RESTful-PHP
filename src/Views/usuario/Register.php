<?php
use Utils\Utils; 
?>

<h1>Sing Up</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] === 'failed'): ?>
    <p class="errorMessage">Registration unsuccessful. Something went wrong. Please try again.</p>
    <?php Utils::deleteSession('register');?>
<?php endif; ?>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] === 'complete'): ?>
    <p class="successMessage">Success! Your registration is complete.</p>
    <form action="<?=BASE_URL?>/login/" method="POST">
        <p>
            <input type="submit" value="Log In">
        </p>
    </form>
    <?php Utils::deleteSession('register');?>


<?php else: ?>

    <form action="<?=BASE_URL?>/registro/" method="POST">
        <p>
            <label>Name</label>
            <input type="text" name="data[name]" placeholder="Introduce your name" value="<?= isset($usuario) ? $usuario['name'] : '' ?>" required>
        </p>
        <p>
            <label>Last Name</label>
            <input type="text" name="data[last_name]" placeholder="Introduce your last name" value="<?= isset($usuario) ? $usuario['last_name'] : '' ?>" required>
        </p>
        <p>
            <label>Email</label>
            <input type="email" name="data[email]" placeholder="Introduce your email" value="<?= isset($usuario) ? $usuario['email'] : '' ?>" required>
        </p>
        <p>
            <label>Date of Birth</label>
            <input type="date" name="data[date]" placeholder="Introduce your birth (dd/mm/yyyy)" value="<?= isset($usuario) ? $usuario['date'] : '' ?>" required>
        </p>
        <p>
            <label>Password</label>
            <input type="password" name="data[password]" placeholder="Introduce your password" required>
        </p>
        <p>
            <input type="submit" value="Register">
        </p>
    </form>

<?php endif; ?>