<?php

class Job {


    /**
     * Application factory
     * @param array $data    Job meta
     * @return object       Concrete application instantiation
     */
    public static function create( $data = [] ) {

        $class_name = ucfirst( strtolower( $data['status'] ) );
        return new $class_name( $data );

    }


    /**
     * Handle the rendering of job rows
     * @param  array  $jobs      Application objects
     * @param  string $status    Section
     */
    public static function render( $jobs = [], $status = 'applications' ) {

        $cmd = 'render_' . $status;

        if ( ! empty( $jobs ) ) {
            foreach ( $jobs as $j ) {
                $j->$cmd();
            }
        }

    }
}

?>
