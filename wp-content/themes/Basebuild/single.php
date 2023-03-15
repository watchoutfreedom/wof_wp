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
                    <h2><?php echo get_field('excerpt') ?></h2>
                <?php }
                      else{?>
                        <h1><?php the_title(); ?></h1>
                    <?php }
                
                $images = get_field('images');
                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                if( $images ): ?>

                    <div class="gallery">
                        <ul>
                            <?php 
                            if(has_post_thumbnail())
                            echo "<li>".the_post_thumbnail()."</li>"
                             ?>
                            <?php foreach( $images as $image_id ): ?>
                                <li>
                                    <?php echo wp_get_attachment_image( $image_id, $size ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php 
                elseif(has_post_thumbnail()): echo the_post_thumbnail();
                endif; ?>
            <?php if(get_post_type() != "product"){ ?>
                <h1><?php the_title(); ?></h1>
            <?php } ?>
            <h5>

                <?php if(get_post_type() == "activity"){ ?>

                    <span class="activity_type"><?php echo get_field('type') ?></span>
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
                    <?php if($answer_to = get_field('answer_to')) echo " | <a href=".get_permalink($answer_to).">".get_the_title($answer_to)."</a>";?>

                <?php } ?>

                <?php if(get_post_type() == 'service'){ ?>

                    <?php if(get_field('type')){ ?>
                    <span class="type"><?php echo get_field('type')?></span>
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


                <?php if(get_post_type() == 'product'){ ?>

                    <?php if(get_field('price')){ ?>
                        <span class="price"><?php echo get_field('price')." €" ?></span>
                        <?php } ?>

                <?php } ?>
            </h5>
            <div class="content">
                <?php 
                    echo get_field('description');
                ?>
            </div>
            <?php if(get_post_type() == "post"){ ?>
            <div class="bibliography">
                <ul>
                <?php foreach(get_field('bibliography') as $book) echo "<li>".$book['book']."</li>"; ?>
                </ul>
            </div>
            <?php } ?>

    </section>
    <?php if(in_array(get_post_type(),array("activity","product","post"))): ?>
        <?php 
            $linked_posts = get_field('linked_services');
            foreach (get_field('linked_products') as $linked_product)
                $linked_posts[] = $linked_product;
            $linked_posts[] = get_field('linked_posts');

            if($linked_posts):?>

            <div class="linked-posts">
                <hr>
                <h2>Relacionados</h2>

            <?php 
                foreach($linked_posts as $linked_post):?>
                <?php if($linked_post): ?>
                <section>
                    <div class="linked">
                        <a href="<?php echo get_permalink($linked_post->ID) ?>"><?php echo get_the_post_thumbnail($linked_post->ID); ?></a>
                        <div class="post_type"><label for=""><?php echo $linked_post->post_type ?></label></div>
                        <h3><a href="<?php echo get_permalink($linked_post->ID) ?>"><?php echo $linked_post->post_title; ?></a></h3>
                        <div class="excerpt"><?php echo get_field('excerpt',$linked_post->ID) ?></div>
                    </div>
                </section>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php endwhile; ?>
    <?php if(get_post_type() == "activity"){ ?>
        <a class="button" href="">UNIRME</a>
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
        <a class="button" href="">COMPRAR</a>
    <?php } ?>
    <?php if(get_post_type() == "service"){ ?>
        <a class="button" href="">SOLICITAR</a>
    <?php } ?>

    <section>

    <h2>Respuestas</h2>


    <?php 
    
    $tasks = get_posts(array(
        'post_type' => 'post',
        'meta_query' => array(
            array(
                'key' => 'answer_to', // name of custom field
                'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                'compare' => 'LIKE'
            )
        )
    ));    
    
    print_r($tasks);

    ?>

        
    </section>

</div>

<?php wp_footer(); ?>