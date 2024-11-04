<?php 
// SHORTCODE
// Register the custom specialist review shortcode
function specialist_review_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(
        array(
            'name' => 'Name',
            'title' => 'Polar Specialist',
            'avatar' => '', // URL to avatar image
            'quote' => 'This is a review quote.',
        ),
        $atts,
        'specialist_quote'
    );


    // HTML output for the review section
    $output = 
    '<div class="custom-review">
        <div class="custom-review__person">
            <img src="' . esc_url($atts['avatar']) . '" alt="' . esc_attr($atts['name']) . '" class="custom-review__person__avatar">
            <div class="custom-review__person__name">' . esc_html($atts['name']) . '</div>
            <div class="custom-review__person__title">' . esc_html($atts['title']) . '</div>
        </div>
        <div class="custom-review__quote">
            <div class="custom-review__quote__start-quote">
                <svg>
                    <use xlink:href="' . get_template_directory_uri() .'/css/img/sprite.svg#icon-quote"></use>
                </svg>
            </div>       
        ' . esc_html($atts['quote']) . '
        <div class="custom-review__quote__end-quote">
                <svg>
                    <use xlink:href="' .  get_template_directory_uri() .'/css/img/sprite.svg#icon-quote"></use>
                </svg>
            </div> 
        </div>
    </div>';

    return $output;
}
add_shortcode('specialist_quote', 'specialist_review_shortcode');