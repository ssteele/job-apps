<?php

abstract class Processed extends Application {


    /**
     * Render job application date
     * @return string    HTML markup
     */
    protected function _job_application_date() {

        $output = '';
        $output .= '<span class="applied-for"></span>';

        $output .= parent::_job_application_date();

        return $output;

    }


    /**
     * Driver to render job application row
     */
    public function render_applications() {

        $this->_render_row();

    }


    /**
     * Driver to render potential job row
     */
    public function render_potentials() {

        return false;

    }

}

?>
