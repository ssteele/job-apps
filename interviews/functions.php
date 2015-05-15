<?php

ini_set( 'display_errors', '1' );
error_reporting( E_ALL );


/**
 * Include all classes
 */
function include_classes() {

    // Include classes
    $classes = [
        'interviews',
        'aide',
    ];

    foreach ( $classes as $class ) {

        require_once 'includes/class.' . $class . '.inc';

    }

}
include_classes();

?>
