<?php
/*
Template Name: Subscribe
*/



acf_form_head();

get_header();
?>

<div class="page main-container">

<?php if(!$_GET['success'])
    echo do_shortcode("[noptin-form id=513]");
    else{
    ?>
        <section><p>¡GRACIAS! 

        Además, puedes asociarte a Wof! y  ayúdanos a difundir información de calidad en temas clave de nuetro tiempo, además de impulsar iniciativas de cooperación social entre diferentes ideologías.  Entérate antes de nuestras oprortunidades  y ventajas  para ti.</p>

        <a class="button" href="/colabora">COLABORA</a>
        <a class="button grey" href="/">VOLVER</a>
        </section>    

<?php } ?>




</div>

<?php wp_footer(); ?>