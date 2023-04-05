<?php
/*
Template Name: Subscribe
*/



acf_form_head();

get_header();?>

<div class="page main-container">

<?php if(!$_POST['email']){ ?>
<section>
    <p>Escribe tu email y recibirás las últimas noticias sobre nuestra actividad y proyectos.</p>

    <form method="post">
        <input type="email" name="email" placeholder="email">
        <input type="email" name="email2" placeholder="repetir email">
        <input type="submit" value="submit" class="button">
    </form>
</section>
<?php } 
else{?>

<section><p>¡GRACIAS! 

Además, puedes asociarte a Wof! y  ayúdanos a difundir información de calidad en temas clave de nuetro tiempo, además de impulsar iniciativas de cooperación social entre diferentes ideologías.  Entérate antes de nuestras oprortunidades  y ventajas  para ti.</p>

<a class="button" href="/colabora">COLABORA</a>

<a class="button grey" href="/">VOLVER</a>



</section>    

<?php }


?>
</div>

<?php wp_footer(); ?>