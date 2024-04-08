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

        Además, cuando lo desees, también puedes asociarte a Wof!</p>

        <a class="button" href="/colabora">COLABORA</a>
        <a class="button grey" href="/">VOLVER</a>
        </section>    

<?php } ?>




</div>

<?php wp_footer(); ?>