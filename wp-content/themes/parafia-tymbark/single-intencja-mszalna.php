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
    $intencjeTymbark = get_field('intencje_tymbark');

    $dniTygodnia = [
        'Niedziela',
        'Poniedziałek',
        'Wtorek',
        'Środa',
        'Czwartek',
        'Piątek',
        'Sobota',
    ];

    echo '<h4>Intencje Tymbark</h4>';

    foreach ($intencjeTymbark as $intencja) {
        echo '<ul>';
        foreach ($intencja as $wpis) {
            echo '<li>' . $wpis['data'] . ' | ' . $dniTygodnia[date('w', strtotime($wpis['data']))];
            echo '<ul>';
            foreach ($wpis['godzina'] as $godzina) {
                echo '<li>' . $godzina['godzina_mszy'];
                echo '<ul>';
                foreach ($godzina['nazwa'] as $nazwa) {
                    echo '<li>' . $nazwa['nazwa_intencji'] . '</li>';
                }
                echo '</ul>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</li>';
        }
        echo '</ul>';
    }

    echo '<h4>Intencje Piekiełko</h4>';

    $intencjePiekielko = get_field('intencje_piekielko');

    foreach ($intencjePiekielko as $intencja) {
        echo '<ul>';
        foreach ($intencja as $wpis) {
            echo '<li>' . $wpis['data'] . ' | ' . $dniTygodnia[date('w', strtotime($wpis['data']))];
            echo '<ul>';
            foreach ($wpis['godzina'] as $godzina) {
                echo '<li>' . $godzina['godzina_mszy'];
                echo '<ul>';
                foreach ($godzina['nazwa'] as $nazwa) {
                    echo '<li>' . $nazwa['nazwa_intencji'] . '</li>';
                }
                echo '</ul>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</li>';
        }
        echo '</ul>';
    }

    echo '<h4>Uwagi</h4>';

    $intencjaUwagi = get_field('intencja_uwagi');

    echo '<ul>';
    foreach ($intencjaUwagi as $uwaga) {
        echo '<li>' . $uwaga['uwagi'] . '</li>';
    }
    echo '</ul>';
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
