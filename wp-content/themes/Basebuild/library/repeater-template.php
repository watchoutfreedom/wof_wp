<?php if($args['type'] == null || $args['type'] == get_field('type',get_the_ID())){ ?>
<section>
    <a href="<?php echo get_permalink() ?>"><?php echo the_post_thumbnail(); ?></a>
    <div class="post_type"><label for=""><?php echo get_post_type() ?></label></div>
    <div class="subtitle">
        <label for="">
            <?php 
            if($post_type == 'activity'){
                if(get_field('location',get_the_ID())) echo get_field('location',get_the_ID()); 
                if(get_field('initial_date',get_the_ID())) echo " | ".get_field('initial_date',get_the_ID());
                if(get_field('end_date',get_the_ID())) echo " - ".get_field('end_date',get_the_ID());

            }
            if($post_type == 'service' || $post_type = 'product')
                if(get_field('type',get_the_ID())) echo get_field('type',get_the_ID()); 		
            ?>
		</label>
    </div>
    <h2><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a> <?php if($price = get_field('price',get_the_ID())) echo " | <span class='price'>".$price." €</span>" ?></h2>
    <p><?php echo get_field('excerpt') ?></p>
    <div class="author">
        <span><?php the_author_meta( 'user_nicename' , the_author() ); ?></span>
    </div>
    <hr>
</section>
<?php } ?>