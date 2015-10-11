<?php

class Potential extends Application {


    /**
     * Application date markup
     * ...overridden here to add copy to clipboard functionality
     * @return string    Application date
     */
    protected function _official_date_markup() {

        $output = '';

        $output .= '<span class="copy-to-clipboard" id="' . $this->_terminal_friendly_filepath . '.php">';
        $output .=     $this->search_date;
        $output .= '</span>';

        return $output;

    }


    /**
     * Render cover letter link created for this job
     * @return string    HTML markup
     */
    protected function _job_letter() {

        $return = parent::_job_letter();

        if ( $this->letter && false === $return ) {

            $output = '';

            $output .= '<span class="icon submitted copy-to-clipboard" id="' . $this->_terminal_friendly_filepath . '.pdf">';
            $output .= '    <i class="fa fa-envelope-o"></i>';
            $output .= '</span>';

            return $output;

        }

        return $return;

    }


    /**
     * Render resume link created for this job
     * @return string    HTML markup
     */
    protected function _job_resume() {

        $return = parent::_job_resume();

        if ( $this->resume && false === $return ) {

            $output = '';

            $output .= '<span class="icon submitted copy-to-clipboard" id="' . $this->_terminal_friendly_filepath . '.pdf">';
            $output .= '    <i class="fa fa-file-o"></i>';
            $output .= '</span>';

            return $output;

        }

        return $return;

    }


    /**
     * Driver to render job application row
     */
    public function render_applications() {

        return false;

    }


    /**
     * Driver to render potential job row
     */
    public function render_potentials() {

        $this->_render_row();

    }

}

?>
