<?php
/**
* Template Name: Comunidad
*
*/

get_header(); ?>



<div class="page main-container">

		<div class="excerp"><?php the_content(); ?></div>
		<div class="contrib__list">

			<?php $users = get_users(array(array('role' => 'contributor'))) ?>
			<?php foreach ( $users as $user){ 
				if(get_field('hide_from_comunity_page','user_'.$user->data->ID)) continue; // if is hidden from comunity page
			?>
					<div class="contributor">
						<a href="#" class="avatar"><img src="<?php echo get_avatar_url($user->data->ID)?>" alt=""></a>
						<a href="#"><h2><?php echo $user->data->display_name ?></h2></a>
						<h4 class="user_skills"><?php echo get_field('skills', 'user_'.$user->data->ID) ?></h4>
						<p><?php echo get_field('description', 'user_'.$user->data->ID) ?></p>
						<div class="tags"><?php foreach (get_field('tags', 'user_'.$user->data->ID) as $tag) echo "<span><a href='#'>".$tag['tag']."</a></span>" ?></div>
					</div>

			<?php } ?>

		</div>
        <a class="button bottom-action" href="/signup">UNIRME</a>
</div>

<?php get_footer();
