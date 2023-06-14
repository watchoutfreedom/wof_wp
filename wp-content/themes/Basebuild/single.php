<?php
/**
 * The single template file
 * *
 * @package biip Basebuild
 * @since wpbb 1.0.0
 */

get_header(); ?>

<div class="page main-container">
    <section>
        <div class="single-<?php echo get_post_type() ?>">
            <?php while ( have_posts() ) : the_post();?>
                <?php if(get_post_type() != "product"){ ?>
                    <div class="excerp"><?php echo get_field('excerpt') ?></div>
                <?php }
                      else{?>
                        <h1><?php the_title(); ?></h1>
                        <h5>
                            <?php if(get_field('type')){ ?>
                            <span class="type"><a href="<?php echo "/".get_post_type()."?type=".get_field_object('type')['value'] ?>"><?php echo get_field_object('type')['choices'][get_field_object('type')['value']]?></a></span> | 
                            <?php } ?>

                            <?php if(get_field('price')){ ?>
                                <span class="price"><?php echo get_field('price')." €" ?></span>
                            <?php } ?>
                        </h5>
                    <?php }
                
                $images = get_field('images');
                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                if( $images ): ?>

                        <div class="slick-gallery">
                            <?php foreach($images as $image_id): ?>
                                <div class="img__wrap">
                                    <?php echo wp_get_attachment_image($image_id, $size); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>                    
                <?php 
                elseif(has_post_thumbnail()):  ?> 
                    <div class="img__wrap">
                        <?php echo the_post_thumbnail(); ?>
                    </div>                
                <?php endif; ?>
            <?php if(get_post_type() != "product"){ ?>
                <h1><?php the_title(); ?></h1>
            <?php } ?>
            <h5>

                <?php if(get_post_type() == "activity"){ ?>
                    <?php if(get_field('type')){ ?>

                    <span class="type"><a href="<?php echo "/".get_post_type()."?type=".get_field_object('type')['value'] ?>"><?php echo get_field_object('type')['choices'][get_field_object('type')['value']]?></a></span>
                    <?php }?>
                    <?php if(get_field('users')){ 
                            echo " | ";
                    ?>
                    <span class="users"><?php foreach(get_field('users') as $user) echo $user['display_name']?></span>
                    <?php } ?>
                    <?php if(get_field('initial_date')){ 
                            echo " | ";    
                    ?>
                    <span class="date"><?php echo get_field('initial_date')?> - <?php echo get_field('end_date') ?></span>
                    <?php } ?>
                    <?php if(get_field('location')){
                            echo " | ";    
                    ?>
                    <span class="location"><?php echo get_field('location') ?></span>
                    <?php } ?>

                <?php } ?>

                <?php if(get_post_type() == "post"){ ?>

                    <span class="author"><?php the_author() ?></span> | 
                    <span class="date"><?php the_date() ?></span>
                    <?php if($answer_to = get_field('answer_to')) echo " | Artículo respuesta a <a class='answer__to' href=".get_permalink($answer_to).">".get_the_title($answer_to)."</a>";?>

                <?php } ?>

                <?php if(get_post_type() == 'service'){ ?>

                    <?php if(get_field('type')){ ?>
                    <span class="type"><a href="<?php echo "/".get_post_type()."?type=".get_field_object('type')['value'] ?>"><?php echo get_field_object('type')['choices'][get_field_object('type')['value']]?></a></span>
                    <?php } ?>
                    <?php if(get_field('price')){ 
                            echo " | ";
                    ?>
                    <span class="price"><?php echo get_field('price')." €" ?></span>
                    <?php } ?>
                    <?php if(get_field('duration')){ 
                            echo " | ";
                    ?>
                    <span class="duration"><?php echo get_field('duration') ?></span>
                    <?php } ?>
                    <?php if(get_field('users')){ 
                            echo " | ";
                    ?>
                    <span class="users"><?php foreach(get_field('users') as $user) echo $user['display_name']?></span>
                    <?php } ?>
                    <?php if(get_field('location')){ 
                            echo " | ";
                    ?>
                    <span class="location"><?php echo get_field('location') ?></span>
                    <?php } ?>
                    <?php if(get_field('start_date')){ 
                            echo " | ";
                    ?>
                    <span class="date"><?php echo get_field('start_date')." - ".get_field('end_date')  ?></span>
                    <?php } ?>

                <?php } ?>

            </h5>
            <div class="content">
                <?php 
                    echo get_field('description');
                ?>
            </div>
            <?php 
                if(get_post_type() == "post") {
                    $bibliography = get_field('bibliography');
                    // Remove empty books from bibliography
                    $filteredBibliography = array_filter($bibliography, function($book) {
                        return !empty($book['book']);
                    });

                    if(!empty($filteredBibliography)){ ?>
                        <h2 class="bibliography__heading">Bibliografía</h2>
                        <div class="bibliography">
                            <ul>
                            <?php foreach($filteredBibliography as $book) {
                                echo "<li>".$book['book']."</li>"; 
                            } ?>
                            </ul>
                        </div>
                    <?php }
             } ?>

            <div>
            <?php if(get_post_type() == "activity"){ ?>
                <a class="button" href="">APOYAR PROYECTO</a>
            <?php } ?>
            <?php if(get_post_type() == "post"){
                    if(wp_get_current_user()->ID == $post->post_author 
                    //|| current_user_can( 'edit_others_posts', $post->ID)
                    ){
                        echo "<a class='button' href='/create-post?action=edit&id=".$post->ID."'>EDITAR</a>";
                    }
                    else{
                        echo "<a class='button' href='/create-post?action=create&id=".$post->ID."'>RESPONDER</a>";
                    }
            ?>
            <?php } ?>
            <?php if(get_post_type() == "product"){ ?>
                <a class="button" href="<?php echo get_field("link")?>">COMPRAR</a>
            <?php } ?>
            <?php if(get_post_type() == "service"){ ?>
                <a class="button" href="mailto:test@example.com?subject=<?php the_title(); ?>">SOLICITAR</a>
            <?php } ?>
            </div>


    </section>
    
    <?php endwhile; ?>

    <section class="social">
    <?php echo do_shortcode('[Sassy_Social_Share]') ?>

    </section>

    <?php if(in_array(get_post_type(),array("activity","product","post"))): ?>
        <?php 

            if($linked_posts):?>
            <section>
                <div class="linked-posts">
                    <hr>
                    <h2>Relacionados</h2>

                <?php

                    
                    foreach($linked_posts as $linked_post):?>
                    <?php if($linked_post): ?>
                        <div class="linked">
                            <a href="<?php echo get_permalink($linked_post->ID) ?>"><?php echo get_the_post_thumbnail($linked_post->ID); ?></a>
                            <div class="post_type"><label for=""><?php echo $linked_post->post_type ?></label></div>
                            <h3><a href="<?php echo get_permalink($linked_post->ID) ?>"><?php echo $linked_post->post_title; ?></a></h3>
                            <div class="excerpt"><?php echo get_field('excerpt',$linked_post->ID) ?></div>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </section>

        <?php endif; ?>
    <?php endif; ?>




    <?php 
    
    $posts = get_posts(array(
        'numberposts'   => -1,
        'post_type'     => 'post',
        'meta_key'      => 'answer_to',
        'meta_value'    => get_the_ID()
    ));
    
    if(!empty($posts)):?>

    <section class="answers">
        <h2>Respuestas</h2>

        <ul>
        <?php
            foreach($posts as $post)
                echo "<li><a href='".get_permalink($post->ID)."'>".$post->post_title."</a> por ".$post->the_author_meta( 'user_nicename' , the_author() );"</li>";?>
        </ul>
    </section>

    <?php endif; ?>

</div>

<?php wp_footer(); ?>