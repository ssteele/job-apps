<?php

class Aide {


    // Declare properties
    public $partial_path;
    private $_index = 0;
    public $topics;
    private $_topic;
    private $_name;
    private $_title;


    /**
     * Constructor
     * @param array $topics    Set interview aide topic sections
     */
    function __construct( $topics = [] ) {

        foreach ( $topics as $title => $topic ) {
            $this->topics[$title] = $topic;
        }

    }


    /**
     * Provide a way for the internal system to find partials folder
     */
    public function set_partial_path( $path ) {

        $this->partial_path = $path;

    }


    private function _next_index() {

        $this->_index++;

    }


    /**
     * Name setter
     * @param [type] $name [description]
     */
    public function set_name( $name ) {

        $this->_name = $name;

    }


    /**
     * Topic setter
     */
    public function set_topic( $topic ) {

        $this->_topic = $topic;

    }


    /**
     * Pull topic title out of the topic section array
     */
    private function _pull_title() {

        $this->_title = strtoupper( array_shift( $this->_topic ) );

    }


    /**
     * Render aide topic section questions
     */
    public function render_questions() {

        foreach ( $this->_topic as $question ) {
            $question->render( $this->partial_path );
        }

    }


    /**
     * Render aide topic section
     */
    private function _render_topic() {

        include $this->partial_path . 'topic.php';

    }


    /**
     * Render interview aide Q and A
     */
    public function render() {

        foreach ( $this->topics as $name => $topic ) {

            $this->_next_index();
            $this->set_name( $name );
            $this->set_topic( $topic );
            $this->_pull_title();

            $this->_render_topic();

        }

    }

}
