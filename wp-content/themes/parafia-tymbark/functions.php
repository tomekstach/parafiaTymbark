<?php
/**
 * Parafia Tymbark Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Parafia Tymbark
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_PARAFIA_TYMBARK_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

    wp_enqueue_style('parafia-tymbark-theme-css', get_stylesheet_directory_uri() . '/style.css?v=20250313003', ['astra-theme-css'], CHILD_THEME_PARAFIA_TYMBARK_VERSION, 'all');

}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

add_action('acf/init', 'set_acf_settings');
function set_acf_settings()
{
    acf_update_setting('enable_shortcode', true);
}

function display_pogrzeb_posts()
{
    $args = [
        'post_type'      => 'pogrzeb',
        'posts_per_page' => -1,
    ];

    $pogrzeb_query = new WP_Query($args);

    $output = '';

    if ($pogrzeb_query->have_posts()) {
        $counter = $pogrzeb_query->post_count;
        $i       = 1;
        $output  = '
    <div class="wp-block-uagb-container uagb-block-a31af704" id="died-info-box-79996f03">
        <div class="wp-block-uagb-info-box uagb-block-79996f03 uagb-infobox__content-wrap  uagb-infobox-icon-above-title uagb-infobox-image-valign-middle wp-block-uagb-info-box--has-margin">
            <div class="uagb-infobox-margin-wrapper zm-info">
                <div class="uagb-ifb-content">
                    <div class="uagb-ifb-image-content"><img decoding="async" data-src="https://parafia.astosoft.pl/wp-content/uploads/2024/12/christian-cross.svg" alt="" width="40" height="40" loading="lazy" src="https://parafia.astosoft.pl/wp-content/uploads/2024/12/christian-cross.svg" class=" lazyloaded" style="--smush-placeholder-width: 40px; --smush-placeholder-aspect-ratio: 40/40;"><noscript><img decoding="async" src="https://parafia.astosoft.pl/wp-content/uploads/2024/12/christian-cross.svg" alt="" width="40" height="40" loading="lazy"/></noscript></div>
                    <div class="uagb-ifb-title-wrap">
                        <h2 class="uagb-ifb-title">Informacja o zmarłych</h2>
                    ';
        while ($pogrzeb_query->have_posts()) {
            $pogrzeb_query->the_post();
            $content = get_the_content();
            $content = apply_filters('the_content', $content);
            $output .= '<div>' . $content . '</div>';

            if ($i < $counter) {
                $output .= '<div class="wp-block-uagb-separator uagb-block-5ce44d1c"><div class="wp-block-uagb-separator__inner" style="--my-background-image:"></div></div>';
            }

            $i++;
        }
        $output .= '
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

    wp_reset_postdata();

    return $output;
}

add_shortcode('pogrzeb_posts', 'display_pogrzeb_posts');

function default_strings_callback($strings)
{
    $strings['string-next-text']     = __('Dalej', 'astra');
    $strings['string-previous-text'] = __('Wstecz', 'astra');
    return $strings;
}
add_filter('astra_default_strings', 'default_strings_callback', 10);
