<?php


require_once 'config.php';
require_once 'application-config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Cache-Control: no-cache, max-age=0, must-revalidate, no-store');


// Debug settings
if ('development' === ENVIRONMENT) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
}


/**
 * Run whatever necessary before the application loads
 * @param  string  $request    'valid' or null
 */
function init($request)
{
    $request = whitelistRequests($request);
    verifyValidRequest($request);
}


/**
 * Define which scripts may be requested directly
 * @param  string $request    'valid' or null
 * @return string             Updated request
 */
function whitelistRequests($request)
{
    $whitelisted = [
        '/app/interview/index.php',
        '/app/interview-aide/index.php',
    ];

    if (in_array(sanitizeInput($_SERVER['SCRIPT_NAME'], 's'), $whitelisted, true)) {
        $request = 'valid';
    }

    return $request;
}


/**
 * Allow the request through, or redirect to app root
 * @param  string $request    'valid' or null
 */
function verifyValidRequest($request)
{
    if (! (isset($request) && 'valid' === $request)) {
        header('Location: ' . APP_URL);
        die();
    }
}


/**
 * Get webroot
 * @return string    Webroot path
 */
function getWebroot()
{
    return $_SERVER['DOCUMENT_ROOT'] . '/';
}


/**
 * Simple router
 * @param  array  $paths    Path segments
 * @return string           Path to required file
 */
function route($paths = [], $frontEndAsset = false)
{
    $route = '';

    if (! $frontEndAsset) {
        // requiring a back-end script, so need absolute file system path
        $route .= getWebroot();
    }

    foreach ($paths as $path) {
        $route .= $path;
    }

    if ($frontEndAsset) {
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
function sanitizeByType($input, $type)
{
    switch ($type) {
        case 's':
            $input = filter_var($input, FILTER_SANITIZE_STRING);
            break;

        case 'i':
            $input = intval($input);
            $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            break;

        case 'f':
            $input = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
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
 * @return mixed                 Sanitized output
 */
function sanitizeInput($input, $type = null)
{
    if (! is_null($type) && empty($allow)) {
        if (is_array($input) && is_array($type) && count($input) == count($type)) {
            // Sanitize array elements explicitly specifying a type for each
            $output = array();
            $i = 0;

            foreach ($input as $key => $val) {
                $output[$key] = sanitizeByType($val, $type[$i]);
                $i++;
            }
        } else if (is_array($input) && count($type) == 1) {
            // Sanitize homogeneous (w/ respect to type) array
            foreach ($input as $key => $val) {
                $output[$key] = sanitizeByType($val, $type);
            }
        } else {
            // Sanitize variables
            $output = sanitizeByType($input, $type);
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
function renderLinks($title, $arr = [], $wrapper = '')
{
    // Bail if section is empty
    if (count($arr) <= 0) {
        return false;
    }

    $output = '';

    $output .= '<div class="section">';

    $output .= '<h2>' . $title . '</h2>';

    if (! empty($wrapper)) {
        $output .= '<' . $wrapper . '>';
    }

    foreach ($arr as $name => $url) {
        $output .= '<a href="' . $url . '">' . $name . '</a><br />';
    }

    if (! empty($wrapper)) {
        $output .= '</' . $wrapper . '>';
    }

    $output .= '</div>';

    echo $output;
}


// Party starts now
if ($request = (isset($request)) ? $request : null) {
    init($request);
}
