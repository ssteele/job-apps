<?php


// Load config
require_once 'config.php';


// Debug settings
if ( 'local' === ENVIRONMENT ) {
    ini_set( 'display_errors', '1' );
    error_reporting( E_ALL );
}


/**
 * Run whatever necessary before the application loads
 * @param  string  $request    'valid' or null
 */
function init( $request ) {

    $request = whitelist_requests( $request );
    verify_valid_request( $request );

}


/**
 * Define which scripts may be requested directly
 * @param  string $request    'valid' or null
 * @return string             Updated request
 */
function whitelist_requests( $request ) {

    $whitelisted = [
        '/app/interviews/index.php',
        '/app/interview-aide/index.php',
    ];

    if ( in_array( sanitize_input( $_SERVER['SCRIPT_NAME'], 's' ), $whitelisted, true ) ) {
        $request = 'valid';
    }

    return $request;

}


/**
 * Allow the request through, or redirect to app root
 * @param  string $request    'valid' or null
 */
function verify_valid_request( $request ) {

    if ( ! ( isset( $request ) && 'valid' === $request ) ) {
        header( 'Location: ' . APP_URL );
        die();
    }

}


/**
 * Get webroot
 * @return string    Webroot path
 */
function get_webroot() {

    return $_SERVER['DOCUMENT_ROOT'] . '/';

}


/**
 * Simple router
 * @param  array  $paths    Path segments
 * @return string           Path to required file
 */
function route( $paths = [], $front_end_asset = false ) {

    $route = '';

    if ( ! $front_end_asset ) {

        // requiring a back-end script, so need absolute file system path
        $route .= get_webroot();

    }

    foreach ( $paths as $path ) {
        $route .= $path;
    }

    if ( $front_end_asset ) {

        // requesting a front-end asset, so echo the relative path
        echo $route;

    }

    return $route;

}


/**
 * More robust (type specified) user input sanitation
 * @param  mixed $input          Untrusted user input
 * @param  string|array $type    Type specification
 * @return mixed                 Sanitized output
 */
function sanitize_by_type( $input, $type ) {

    switch ( $type ) {
    case 's':

        $input = filter_var( $input, FILTER_SANITIZE_STRING );
        break;

    case 'i':

        $input = intval( $input );
        $input = filter_var( $input, FILTER_SANITIZE_NUMBER_INT );
        break;

    case 'f':

        $input = filter_var( $input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        break;

    default:
        // pass

    }

    return $input;

}


/**
 * Sanitize user input: run through wp_kses at a minimum
 * @param  mixed $input          Untrusted user input
 * @param  string|array $type    Type specification
 * @param  array        $allow   Allowed protocols: passed to wp_kses
 * @return mixed                 Sanitized output
 */
function sanitize_input( $input, $type = null, $allow = array() ) {

    if ( ! is_null( $type ) && empty( $allow ) ) {

        if ( is_array( $input ) && is_array( $type ) && count( $input ) == count( $type ) ) {

            // Sanitize array elements explicitly specifying a type for each
            $output = array();
            $i = 0;

            foreach ( $input as $key => $val ) {

                $output[$key] = sanitize_by_type( $val, $type[$i] );
                $i++;

            }

        } else if ( is_array( $input ) && count( $type ) == 1 ) {

            // Sanitize homogeneous (w/ respect to type) array
            foreach ( $input as $key => $val ) {

                $output[$key] = sanitize_by_type( $val, $type );

            }

        } else {

            // Sanitize variables
            $output = sanitize_by_type( $input, $type );

        }

    } else {

        $output = $input;

    }

    return $output;

}

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
 * Explicitly require app classes
 */
function require_app_classes() {

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
        require_once route( [APP_PATH, 'includes/class.' . $class . '.inc'] );
    }

}


/**
 * Explicitly require interviews classes
 */
function require_interview_classes() {

    $classes = [
        'interviews',
    ];

    foreach ( $classes as $class ) {
        require_once route( [INTERVIEW_PATH, 'includes/class.' . $class . '.inc'] );
    }

}


/**
 * Explicitly require interview-aide classes
 */
function require_aide_classes() {

    $classes = [
        'question',
        'aide',
    ];

    foreach ( $classes as $class ) {
        require_once route( [AIDE_PATH, 'includes/class.' . $class . '.inc'] );
    }

}


// Party starts now
$request = ( isset( $request ) ) ? $request : null;
init( $request );