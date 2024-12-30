<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('astra_entry_content_after', 'custom_astra_content_loop');

function custom_astra_content_loop()
{
    $rows = get_field('ogloszenie');

    $i = 1;
    foreach ($rows as $row) {
        echo '<p>' . $i . '. ' . $row['tresc_ogloszenia'] . '</p>';
        if ($row['tak']) {
            echo '<ul>';
            foreach ($row['podpunkt'] as $podpunkt) {
                echo '<li>' . $podpunkt['punktor'] . '</li>';
            }
            echo '</ul>';
        }
        $i++;
    }
}

get_header();?>

<?php if (astra_page_layout() == 'left-sidebar'): ?>

	<?php get_sidebar();?>

<?php endif?>

	<div id="primary" <?php astra_primary_class();?>>

		<?php astra_primary_content_top();?>

		<?php astra_content_loop();?>

		<?php astra_primary_content_bottom();?>

	</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar'): ?>

	<?php get_sidebar();?>

<?php endif?>

<?php get_footer();?>
