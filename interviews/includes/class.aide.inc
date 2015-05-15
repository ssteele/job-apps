<?php

class Aide {


    // Declare properties
    public $title;
    public $items;


    /**
     * Constructor
     * @param array $data    Job meta
     */
    function __construct( $data = [] ) {

        // $this->path = 'html/';

        foreach ( $this as $field => $value ) {

            if ( isset( $data[$field] ) ) {
                $this->$field = $data[$field];
            } else {
                $this->field = '';
            }

        }

    }


    /**
     * Render aide topic (section)
     */
    public function render_section( $topic ) {

        $output = '';

        $output .= '<div class="' . $topic . ' question">';
        $output .=     '<div class="title">' . $this->title . '</div>';
        $output .=     '<div class="answer hidden">';
        $output .=         '<ul>';

        foreach ( $this->items as $i ) {
            $output .=         '<li class="' . $i . '"></li>';
        }

        $output .=         '</ul>';
        $output .=     '</div>';
        $output .= '</div>';

        echo $output;

    }

}


/**
 * Render the interview aide topic
 * @param  string $title    Topic name
 * @param  string $class    Topic class
 */
function render_topic( $title, $class ) {

    $output = '';

    $output .= '<div class="topic ' . $class . '">';
    $output .= '    <div class="title">' . strtoupper( $title ) . '</div>';
    $output .= '</div>';

    echo $output;

}


?>
