<?php

abstract class Application {


    // Application properties
    public $status;
    public $search_date;
    public $app_date;
    public $title;
    public $company;
    public $local_posting = true;
    public $public_posting;
    public $resume = true;
    public $letter = true;
    public $network = false;
    public $headhunter = false;
    public $interviews;


    // Internal properties
    protected $_official_date;
    protected $_search_date_dashed;
    protected $_local_filename;
    protected $_local_filepath;
    protected $_terminal_friendly_filepath;


    /**
     * Constructor
     * @param array $data    Job meta
     */
    function __construct( $data ) {

        $this->path = 'html/';

        foreach ( $this as $field => $value ) {

            if ( isset( $data[$field] ) ) {
                $this->$field = $data[$field];
            } else {
                $this->field = '';
            }

        }

        $this->_define_internal_vars();

        return $this;

    }


    /**
     * Filename format: 'job_title_company'
     */
    protected function _get_local_filename() {

        $fields = [
            'title',
            'company',
        ];

        foreach ( $fields as $f ) {

            $f = strtolower( $this->$f );
            $f = preg_replace( '/[ -.]/', '_', $f );

            $this->_local_filename .= $f . '_';

        }

        $this->_local_filename = trim( $this->_local_filename, '_' );
        $this->_local_filepath = $this->_terminal_friendly_filepath = $this->_search_date_dashed . '_' . $this->_local_filename;

        $this->_terminal_friendly_filepath = preg_replace( '/\[/', '\[', $this->_terminal_friendly_filepath );
        $this->_terminal_friendly_filepath = preg_replace( '/\]/', '\]', $this->_terminal_friendly_filepath );

    }


    /**
     * Initialize protected internal attributes
     */
    protected function _define_internal_vars() {

        $this->_official_date = ( $this->app_date ) ? $this->app_date : $this->search_date;
        $this->_search_date_dashed = preg_replace( '/\./', '-', $this->search_date );
        $this->_get_local_filename();

    }


    /**
     * Application date markup
     * ...overridden by potential class to add copy to clipboard functionality
     * @return string    Application date
     */
    protected function _official_date_markup() {

        return $this->_official_date;

    }


    /**
     * Render job application date
     * @return string    HTML markup
     */
    protected function _job_application_date() {

        $output  = '';
        $output .= '<span class="postings">[';

        $path = JOBS_PATH . 'postings/' . $this->_local_filepath;

        if ( $this->local_posting && file_exists( $path . '.php' ) ) {

            $output .= '<a href="' . JOBS_URL . 'postings/' . $this->_local_filepath . '.php">';
            $output .=     $this->_official_date;
            $output .= '</a>';

        } else {
            $output .= $this->_official_date_markup();
        }

        $output .= ']</span>';

        return $output;

    }


    /**
     * Render job: Title - Company
     * @return string    HTML markup
     */
    protected function _job_title() {

        if ( $this->headhunter ) {
            $this->company = '[' . $this->company . ']';
        }

        $title = ( ! empty( $this->title ) ) ? ' &#8226; ' . $this->title : '';

        if ( $this->public_posting ) {
            return '<span class="online"><a class="' . $this->status . '" href="' . $this->public_posting . '">' . $this->company . $title . '</a></span>';
        } else {
            return '<span class="online"><span class="' . $this->status . '">' . $this->company . $title . '</span></span>';
        }

    }


    /**
     * Map interview types with font-awesome icons
     * @param  string $type    Interview type
     * @return string          Font-Awesome icon name
     */
    protected function _fa_type( $type = '' ) {

        $map_awesome = [
            ''          => 'refresh fa-spin',
            'recruiter' => 'comment',
            'code'      => 'desktop',
            'phone'     => 'phone-square',
            'face'      => 'user',
            'contract'  => 'star',
        ];

        return $map_awesome[$type];

    }


    /**
     * Render job interview icon links
     * @return string    HTML markup
     */
    protected function _job_interviews() {

        $output = '<span class="interview">&nbsp;';

        if ( $this->interviews ) {
            foreach ( $this->interviews as $date => $type ) {

                $file = JOBS_PATH . 'interviews/' . $date . '_' . $this->_local_filename . '.php';
                $path = APP_PATH . 'interviews/?i=' . urlencode( $date . '_' . $this->_local_filename );

                if ( file_exists( $file ) ) {

                    $output .= '<a href="' . $path . '" class="icon ' . $type . '">';
                    $output .= '    <i class="fa fa-fw fa-' . $this->_fa_type( $type ) . '"></i>';
                    $output .= '</a>';

                } else {

                    $output .= '<span class="icon copy-to-clipboard" id="' . $date . '_' . $this->_local_filename . '.php">';
                    $output .=     '<i class="fa fa-fw fa-' . $this->_fa_type() . '"></i>';
                    $output .= '</span>';

                }

            }
        }

        $output .= '</span>';
        return $output;

    }


    /**
     * Render cover letter link created for this job
     * @return string    HTML markup
     */
    protected function _job_letter() {

        if ( $this->letter ) {

            $path = JOBS_PATH . 'cover-letters/' . $this->_local_filepath;

            if ( file_exists( $path . '.pdf' ) ) {
                return '<a href="' . $path . '.pdf" class="icon submitted" title="Cover Letter"><i class="fa fa-envelope"></i></a>';
            } elseif ( file_exists( $path . '.txt' ) ) {
                return '<a href="' . $path . '.txt" class="icon submitted" title="Cover Letter"><i class="fa fa-envelope"></i></a>';
            }

        }

        return false;

    }


    /**
     * Render resume link created for this job
     * @return string    HTML markup
     */
    protected function _job_resume() {

        if ( $this->resume ) {

            $path = JOBS_PATH . 'resumes/' . $this->_local_filepath;

            if ( file_exists( $path . '.pdf' ) ) {
                return '<a href="' . $path . '.pdf" class="icon submitted" title="Resume"><i class="fa fa-file"></i></a>';
            }

        }

        return false;

    }


    /**
     * Render networking connection for this job
     * @return string    HTML markup
     */
    protected function _job_network() {

        if ( $this->network ) {
            return '<span class="icon submitted" title="' . $this->network . '"><i class="fa fa-linkedin-square"></i></span>';
        }

        return false;

    }


    /**
     * Render assets for this job
     * @return string    HTML markup
     */
    protected function _job_assets() {

        $output = '';

        $output .= $this->_job_resume();
        $output .= $this->_job_letter();
        $output .= $this->_job_network();

        return $output;

    }


    /**
     * Driver to render job application row
     */
    protected function _render_row() {

        $output = '';

        $output .=  '<div class="row">';

        $output .=      '<div class="small-6 medium-2 large-2 columns">';
        $output .=          $this->_job_application_date();
        $output .=      '</div>';

        $output .=      '<div class="show-for-medium-up medium-6 large-5 columns">';
        $output .=          $this->_job_title();
        $output .=      '</div>';

        $output .=      '<div class="small-3 medium-2 large-3 columns">';
        $output .=          $this->_job_interviews();
        $output .=      '</div>';

        $output .=      '<div class="small-3 medium-2 large-2 columns">';
        $output .=          $this->_job_assets();
        $output .=      '</div>';

        $output .=  '</div>';

        $output .=  '<div class="row hide-for-medium-up">';
        $output .=      '<div class="small-12 columns mobile-pad">';
        $output .=          $this->_job_title();
        $output .=      '</div>';
        $output .=  '</div>';

        echo $output;

    }


    /**
     * Drivers to render a job application row
     */
    abstract public function render_applications();
    abstract public function render_potentials();


}

?>
