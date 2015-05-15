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

        $this->define_internal_vars();

        return $this;

    }


    /**
     * Filename format: 'job_title_company'
     */
    protected function get__local_filename() {

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
    protected function define_internal_vars() {

        $this->_official_date = ( $this->app_date ) ? $this->app_date : $this->search_date;
        $this->_search_date_dashed = preg_replace( '/\./', '-', $this->search_date );
        $this->get__local_filename();

    }


    /**
     * Application date markup
     * ...overridden by potential class to add copy to clipboard functionality
     * @return string    Application date
     */
    protected function official_date_markup() {

        return $this->_official_date;

    }


    /**
     * Render job application date
     * @return string    HTML markup
     */
    protected function job_application_date() {

        $output  = '';
        $output .= '<span class="postings">[';

        $path = './postings/' . $this->_local_filepath;

        if ( $this->local_posting && file_exists( $path . '.php' ) ) {

            $output .= '<a href="../postings/' . $this->_local_filepath . '.php">';
            $output .=     $this->_official_date;
            $output .= '</a>';

        } else {
            $output .= $this->official_date_markup();
        }

        $output .= ']</span>';

        return $output;

    }


    /**
     * Render job: Title - Company
     * @return string    HTML markup
     */
    protected function job_title() {

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
    protected function fa_type( $type = '' ) {

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
    protected function job_interviews() {

        $output = '<span class="interview">&nbsp;';

        if ( $this->interviews ) {
            foreach ( $this->interviews as $date => $type ) {

                $file = 'interviews/archives/' . $date . '_' . $this->_local_filename . '.php';

                if ( file_exists( $file ) ) {

                    $output .= '<a href="' . $file . '" class="icon ' . $type . '">';
                    $output .= '    <i class="fa fa-fw fa-' . $this->fa_type( $type ) . '"></i>';
                    $output .= '</a>';

                } else {

                    $output .= '<span class="icon copy-to-clipboard" id="' . $date . '_' . $this->_local_filename . '.php">';
                    $output .=     '<i class="fa fa-fw fa-' . $this->fa_type() . '"></i>';
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
    protected function job_letter() {

        if ( $this->letter ) {

            $path = './cover_letters/archives/' . $this->_local_filepath;

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
    protected function job_resume() {

        if ( $this->resume ) {

            $path = './resumes/archives/' . $this->_local_filepath;

            if ( file_exists( $path . '.pdf' ) ) {
                return '<a href="../resumes/archives/' . $this->_local_filepath . '.pdf" class="icon submitted" title="Resume"><i class="fa fa-file"></i></a>';
            }

        }

        return false;

    }


    /**
     * Render networking connection for this job
     * @return string    HTML markup
     */
    protected function job_network() {

        if ( $this->network ) {
            return '<span class="icon submitted" title="' . $this->network . '"><i class="fa fa-linkedin-square"></i></span>';
        }

        return false;

    }


    /**
     * Driver to render job application row
     */
    protected function render_row() {

        $output = '';

        $output .= $this->job_application_date();
        $output .= $this->job_title();
        $output .= $this->job_interviews();
        $output .= $this->job_resume();
        $output .= $this->job_letter();
        $output .= $this->job_network();

        $output .= '<div class="clearfix"></div>';

        echo $output;

    }


    /**
     * Drivers to render a job application row
     */
    abstract public function render_applications();
    abstract public function render_potentials();


}

?>
