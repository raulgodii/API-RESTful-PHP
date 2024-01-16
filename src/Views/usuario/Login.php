
<h1>Log In</h1>

<?php if(isset($errorLogin)) : ?>
        <p class="errorMessage">Login unsuccessful. Please verify your username and password.</p>
<?php endif; ?>

<?php if(!isset($_SESSION['login'])): ?>

<form action="<?=BASE_URL?>/login/" method="POST">
    <label for="email">Email</label>
    <input type="email" name="data[email]" id="email" placeholder="Introduce your email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required/>


    <label for="password">Password</label>
    <input type="password" name="data[password]" id="password" placeholder="Introduce your password" required/>
    
    <input type="submit" value="Log in"/>
</form>

<?php elseif(isset($_SESSION['login'])): ?>
        <p class="successMessage"> Welcome <?= $_SESSION['login']->name?>! You have logged in successfully.</p>
<?php endif; ?>