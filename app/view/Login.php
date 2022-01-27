<?php
get_header('Logowanie', ['login.css']);
?>
<div class="container">
    <h1>Zaloguj się</h1>
    <form class="formu" action="/login" method="post">
        <label for="login">Login</label>
        <input type="text" placeholder="Wprowadź login" name="login" required>
        <label for="password">Hasło</label>
        <input type="password" placeholder="Wprowadź hasło" name="password" required>
        <button type="submit">Zaloguj się</button>
        <?php if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
        } ?>
    </form>
    <div class="ree">
        <p>Nie masz jeszcze konta? <a href="/register">Zarejestruj się.</a>
    </div>
</div>
<?php get_footer(); ?>