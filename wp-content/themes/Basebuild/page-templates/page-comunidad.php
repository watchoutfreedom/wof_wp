<?php
/**
* Template Name: Comunidad
*
*/

get_header(); ?>

<h4><?php the_content(); ?></h4>


<div class="page main-container">
        <?php $users = get_users(array(array('role' => 'contributor'))) ?>
		<?php foreach ( $users as $user){ ?>
			<section>
				<div class="contributor">
					<a href="#"><img src="<?php echo get_avatar_url($user->data->ID)?>" alt=""></a>
					<a href="#"><h1><?php echo $user->data->display_name ?></h1></a>
                    <h4 class="user_skills"><?php echo get_field('skills', 'user_'.$user->data->ID) ?></h4>
					<p><?php echo get_field('description', 'user_'.$user->data->ID) ?></p>
                    <div class="tags"><?php foreach (get_field('tags', 'user_'.$user->data->ID) as $tag) echo "<span><a href='#'>".$tag['tag']."</a></span>" ?></div>
				</div>
    		</section>

		<?php } ?>
        <a class="button" href="">UNIRME</a>
</div>

<?php get_footer();
