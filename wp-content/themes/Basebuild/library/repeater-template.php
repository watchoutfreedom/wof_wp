<?php if($args['type'] == null || $args['type'] == get_field('type',get_the_ID())){ ?>
<section>
    <a href="<?php echo get_permalink() ?>"><?php echo the_post_thumbnail(); ?></a>
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
    <hr>
</section>
<?php } ?>