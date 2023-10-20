<?php if($args['type'] == null || $args['type'] == get_field('type',get_the_ID())){ ?>
<section>
    <div class="img__wrap"><a href="<?php echo get_permalink() ?>"><?php echo the_post_thumbnail(); ?></a></div>
    <div class="post_type">
        <label class="post_type__label" for="">
        <?php 
        if ($postType = get_post_type_object(get_post_type())) {
            if(get_post_type() == 'post'){
                echo esc_html($postType->labels->singular_name);
                
            }
        }
        ?>
        </label>
    </div>
    <div class="subtitle">
        <label for="">
            <?php 
            if(get_post_type()  == 'activity'){
                $field_object = get_field_object('type',get_the_ID());
                $value = $field_object['value'];
                if($field_object) echo "<a href='/".get_post_type()."?type=".$value."'>".$field_object['choices'][$value]."</a> | "; 

                if(get_field('location',get_the_ID())) echo get_field('location',get_the_ID()); 
                if(get_field('initial_date',get_the_ID())) echo " | ".get_field('initial_date',get_the_ID());
                if(get_field('end_date',get_the_ID())) echo " - ".get_field('end_date',get_the_ID());

            }
            if(get_post_type()  == 'service' || get_post_type()  == 'product'){
                $field_object = get_field_object('type',get_the_ID());
                $value = $field_object['value'];
                if($field_object) echo "<a href='/".get_post_type()."?type=".$value."'>".$field_object['choices'][$value]."</a>"; 
            }		
            ?>
		</label>
    </div>
    <a href="<?php echo get_permalink() ?>"><h2><?php echo the_title() ?><?php if($price = get_field('price',get_the_ID())) echo " | <span class='price'>".$price." €</span>" ?></h2></a>
    <p><?php echo get_field('excerpt') ?></p>
    <?php if(get_post_type() != 'product'){ ?>
    <div class="author">
        <span><?php the_author_meta( 'user_nicename' , the_author() ); ?></span>
    </div>
    <?php } ?>
        
    <?php
   $posts = get_posts(array(
    'numberposts'   => -1,
    'post_type'     => 'post',
    'meta_key'      => 'answer_to',
    'meta_value'    => get_the_ID()
    ));


    if(!empty($posts)):?>

    <div class="answers">
        <h2>Respuestas</h2>

        <ul>
        <?php
            foreach($posts as $post){
                echo "<li><span><a href='".get_permalink($post->ID)."'>".$post->post_title."</a> por ".get_the_author_meta('display_name', $post->post_author )."</span></li>";
                
            }?>
        </ul>
    </div>
    <?php endif ?>

    <hr>
</section>


<?php } ?>