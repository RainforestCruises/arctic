<?php

//Rank Math -----------
//Variable Additions

//Add this-- 2022/23
add_action('rank_math/vars/register_extra_replacements', function () {
    rank_math_register_var_replacement(
        'seo_years',
        [
            'name'        => esc_html__('SEO Years', 'rank-math'),
            'description' => esc_html__('This year / next year', 'rank-math'),
            'variable'    => 'seo_years',
            'example'     => date("Y") . "-" . date('y', strtotime('+2 year')),
        ],
        'shortcode_rankmath_years'
    );
});

function shortcode_rankmath_years()
{
    return date("Y") . "-" . date('y', strtotime('+2 year')); /* FIELD FROM OPTIONS PAGE */
}




/**
 * Filter if XML sitemap transient cache is enabled.
 *
 * @param boolean $unsigned Enable cache or not, defaults to true
 */
add_filter('rank_math/sitemap/enable_caching', '__return_false');