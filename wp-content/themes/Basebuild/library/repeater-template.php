<a href="<?php echo get_permalink() ?>"><?php echo get_the_post_thumbnail(); ?></a>
<div class="post_type"><label for=""><?php echo get_post_type() ?></label></div>
<h2><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a></h2>
<p><?php echo get_field('excerpt') ?></p>
<div class="author"><span><?php the_author(); ?></span></div>
<hr>