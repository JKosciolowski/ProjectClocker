<?php get_header('Profil', ['profile.css']); ?>
<?php guard_route('/'); ?>
<h1>Profil uzytkownika</h1>
<div class="info" >
    
<div id="pole">

    <?php echo 'Zalogowano jako:  '.$_SESSION['login']; ?>
    <br/>
    
</div>
<div id="pole" <?php 
if (get_role($_SESSION['user_role']) == 'admin'):
    
?>
style="color: #FF8469">
<?php
else:
    ?>
    >
    <?php endif; ?>
<?php echo 'Rola uzytkownika: ' . get_role($_SESSION['user_role']); ?>
</div>
<a href="/logout" style="color: #E86548">Log out</a>
</div>

<br>
<?php get_footer(); ?>
