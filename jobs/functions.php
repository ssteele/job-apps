<?php

ini_set( 'display_errors', '1' );
error_reporting( E_ALL );


/**
 * Render useful job meta
 * @param  array  $arr        Job meta
 * @param  string $wrapper    HTML container tag
 */
function render_links( $title, $arr = [], $wrapper = '' ) {

    // Bail if section is empty
    if ( count( $arr ) <= 0 ) {
        return false;
    }

    $output = '';

    $output .= '<div class="section">';

        $output .= '<h2>' . $title . '</h2>';

        if ( ! empty( $wrapper ) ) {
            $output .= '<' . $wrapper . '>';
        }

        foreach ( $arr as $name => $url ) {
            $output .= '<a href="' . $url . '">' . $name . '</a><br />';
        }

        if ( ! empty( $wrapper ) ) {
            $output .= '</' . $wrapper . '>';
        }

    $output .= '</div>';

    echo $output;

}


/**
 * Include all classes
 */
function include_classes() {

    // Include classes
    $classes = [
        'jobs',
        'applications',
        'dream',
        'potential',
        'processed',
        'applied',
        'rejected',
    ];

    foreach ( $classes as $class ) {

        require_once 'includes/class.' . $class . '.inc';

    }

}
include_classes();

?>
