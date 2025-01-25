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
    global $wp;
    $print = $_REQUEST['print'] ?? false;
    $print = $print !== false ? true : false;

    echo '<p>Następujące osoby mają zamiar w najbliższym czasie zawrzeć sakramentalne małżeństwo:</p>';
    $nrZapowiedzi = get_field('nr');
    $narzeczony = '<strong>' . explode('z parafii', get_field('narzeczony'))[0] . '</strong> z parafii ' . explode('z parafii', get_field('narzeczony'))[1];
    $narzeczona = '<strong>' . explode('z parafii', get_field('narzeczona'))[0] . '</strong> z parafii ' . explode('z parafii', get_field('narzeczona'))[1];

    if (strlen(trim($nrZapowiedzi)) > 0) {
        echo '<p>' . $nrZapowiedzi . '</p>';
    }

    echo '<p>' . $narzeczony . '</p>';
    echo '<p>i</p>';
    echo '<p>' . $narzeczona . '</p>';
    echo '<p>Na podstawie §1066 i §1069 Kodeksu Prawa Kanonicznego: ktokolwiek wiedziałby o przeszkodzie utrudniającej lub uniemożliwiającej zawarcie małżeństwa powinien wyjawić ją w kancelarii parafialnej.</p>';
    echo '<p><strong><em>Tymbark ' . get_field('data') . '</em></strong></p>';
    echo '<p>„Administrator danych osobowych informuje, że dane osobowe dotyczące zapowiedzi przedślubnych zawarte na stronie parafii Narodzenia Najświętszej Maryi Panny w Tymbarku umieszczone zostały za zgodą osób, których dane dotyczą”</p>';

    if ((current_user_can('administrator') or current_user_can('author') or current_user_can('editor') or current_user_can('contributor')) and $print === false) {
        $current_url = home_url(add_query_arg([], $wp->request));
        echo '<p><a href="' . $current_url . '/?print=print"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 512 512" role="graphics-symbol" aria-hidden="false" aria-label="" style="max-width: 40px;"><path d="M448 192H64C28.65 192 0 220.7 0 256v96c0 17.67 14.33 32 32 32h32v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h32c17.67 0 32-14.33 32-32V256C512 220.7 483.3 192 448 192zM384 448H128v-96h256V448zM432 296c-13.25 0-24-10.75-24-24c0-13.27 10.75-24 24-24s24 10.73 24 24C456 285.3 445.3 296 432 296zM128 64h229.5L384 90.51V160h64V77.25c0-8.484-3.375-16.62-9.375-22.62l-45.25-45.25C387.4 3.375 379.2 0 370.8 0H96C78.34 0 64 14.33 64 32v128h64V64z"></path></svg></a></p>';
    }
}

$print = $_REQUEST['print'] ?? false;
$print = $print !== false ? true : false;

if ($print === false) {
    get_header();
} else {
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<title>Parafia Tymbark</title>';
    echo '<link rel="stylesheet" href="/wp-content/themes/parafia-tymbark/style.css">';
    echo '</head>';
    echo '<body class="print-print">';
}
?>

<?php if (astra_page_layout() == 'left-sidebar' and $print === false): ?>

	<?php get_sidebar(); ?>

<?php endif?>

	<div id="primary"	                  <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar' and $print === false): ?>

	<?php get_sidebar(); ?>

<?php endif?>

<?php if ($print === false) {
    get_footer();
} else {
    echo '<script>window.print();</script>';
    echo '</body></html>';
}
?>
