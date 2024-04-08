<?php
/**
* Template Name: Colabora
*
*/

get_header(); ?>

<div class="page main-container">
    <section>
        <div class="excerp">¡Gracias por interesarte en colaborar! </div>
        <p>
            <strong>Wof! </strong> es una asociación sin animo de lucro dedicada a fomentar la cooperación social, el debate y la formación en materias afectadas por la desinformación o el desinterés del statu quo.          
            Si te interesa nuestra labor puedes seguirnos en <strong><a class="link" href="https://twitter.com/watchout_f">Twitter</a>, <a class="link" href="https://github.com/watchoutfreedom">Github</a>, <a class="link" href="https://www.youtube.com/channel/UC-LIrt0uGQR7dyn-wVb72fQ">Youtube</a> e <a class="link" href="https://www.instagram.com/watchoutfreedom/?hl=es  ">Instagram</a> </strong>. O si prefieres ser parte o ayudar en algún proyecto puedes hacerlo de las siguientes maneras:
        </p>

    </section>
    <section>
        <h2>1. Puedes asociarte con una cuota o donación.</h2>
        <p>
            Puedes asociarte con una cuota o donación. Tendrás acceso a la información sobre las iniciativas, además de otras ventajas.
        </p>
        <script async src="https://js.stripe.com/v3/pricing-table.js"></script>
        <stripe-pricing-table pricing-table-id="prctbl_1O3HmgGsxSUQmlTTVSuEq2Rw"
        publishable-key="pk_live_51Kz4S0GsxSUQmlTTi5auNcSejQ4sdpPC14eSiC9JuFJgyDHTlC2zjYPzBcq6G87JL7ykySo0imi3WeYI6AbaC42i00JcRtgfvK">
        </stripe-pricing-table>

        <p>
            O puedes donar libremente en FIAT o BTC:
        </p>
        <a class="button" href="/donate">DONAR</a>
    </section>
    <section>
        <h2>2. Como interlocutor o suscriptor.</h2>
         <p>
        Nuestro blog te permite responder a un artículo con tu propio artículo, en lugar de escribir comentarios. El objetivo es mejorar la calidad del debate. Cualquier lector puede proponer una respuesta (moderada por los colaboradores) y será publicada en el blog.
        Como suscriptor recibirás las noticias y podrás enterarte antes de los artículos e iniciativas.
        </p>
        <a href="/subscribe" class="button">SUSCRIBIRME</a>
    </section>
    <section>
        <h2>3. Puedes comprar algún artículo en nuestra tienda.</h2>
        <a href="/product" class="button">VER TIENDA</a>
    </section>
    <section>
        <h2>4. Puedes adherirte como colaborador y te ayudaremos a aportar tu conocimiento y/o talento.</h2>
        <p>
        Queremos unir a personas dedicadas a diferentes disciplinas para que debatan y colaboren. Además de ayudar a otros en brainstorms en los que puedes formar parte.
        Si tienes un tema que te interese y crees que puedes aportar conocimiento a los demás, únete como colaborador. Te daremos plataforma y apoyo para que transmitas lo que sabes. Tendrás acceso a la participación directa en los proyectos, publicación en el blog y, por supuesto, acceso preferente a las actividades.   
        </p>
        <a class="button" href="/signup">UNIRME</a>
    </section>
    <section>
        <a href="/comunidad" class="button grey">CONSULTAR LISTA DE COLABORADORES</a>
    </section>
</div>

<?php wp_footer(); ?>

