<?php

namespace SteveSteele\JobApp;

abstract class Application
{

    // Application properties
    public $status;
    public $searchDate;
    public $appDate;
    public $title;
    public $company;
    public $localPosting = true;
    public $publicPosting;
    public $resume = true;
    public $letter = true;
    public $network = false;
    public $headhunter = false;
    public $interviews;


    // Internal properties
    protected $officialDate;
    protected $searchDateDashed;
    protected $localFilename;
    protected $localFilePath;
    protected $terminalFriendlyFilepath;


    /**
     * Constructor
     * @param array $data    Job meta
     */
    public function __construct($data)
    {
        $this->path = 'html/';

        foreach ($this as $field => $value) {
            if (isset($data[$field])) {
                $this->$field = $data[$field];
            } else {
                $this->field = '';
            }
        }

        $this->defineInternalVars();

        return $this;
    }


    /**
     * Filename format: 'job_title_company'
     */
    protected function getLocalFilename()
    {

        $fields = [
            'title',
            'company',
        ];

        foreach ($fields as $f) {
            $f = strtolower($this->$f);
            $f = preg_replace('/[ -.]/', '_', $f);

            $this->localFilename .= $f . '_';

        }

        $this->localFilename = trim($this->localFilename, '_');
        $this->localFilePath = $this->terminalFriendlyFilepath = $this->searchDateDashed . '_' . $this->localFilename;

        $this->terminalFriendlyFilepath = preg_replace('/\[/', '\[', $this->terminalFriendlyFilepath);
        $this->terminalFriendlyFilepath = preg_replace('/\]/', '\]', $this->terminalFriendlyFilepath);

    }


    /**
     * Initialize protected internal attributes
     */
    protected function defineInternalVars()
    {
        $this->officialDate = ($this->appDate) ? $this->appDate : $this->searchDate;
        $this->searchDateDashed = preg_replace('/\./', '-', $this->searchDate);
        $this->getLocalFilename();
    }


    /**
     * Application date markup
     * ...overridden by potential class to add copy to clipboard functionality
     * @return string    Application date
     */
    protected function officialDateMarkup()
    {
        return '(' . $this->officialDate . ')';
    }


    /**
     * Render job application date
     * @return string    HTML markup
     */
    protected function jobApplicationDate()
    {
        $output  = '';
        $output .= '<span class="postings">';

        $path = JOBS_PATH . '/postings/' . $this->localFilePath;

        if ($this->localPosting && file_exists($path . '.php')) {
            $output .= '[<a href="' . JOBS_URL . '/postings/' . $this->localFilePath . '.php">';
            $output .=     $this->officialDate;
            $output .= '</a>]';
        } else {
            $output .= $this->officialDateMarkup();
        }

        $output .= '</span>';

        return $output;
    }


    /**
     * Render job: Title - Company
     * @return string    HTML markup
     */
    protected function jobTitle()
    {
        if ($this->headhunter) {
            $this->company = '[' . $this->company . ']';
        }

        $title = (! empty($this->title)) ? ' &#8226; ' . $this->title : '';

        $output = '';
        if ($this->publicPosting) {
            $output = '<span class="online"><a class="' . $this->status . '" href="' . $this->publicPosting . '">' . $this->company . $title . '</a></span>';
        } else {
            $output = '<span class="online"><span class="' . $this->status . '">' . $this->company . $title . '</span></span>';
        }

        return $output;
    }


    /**
     * Map interview types with font-awesome icons
     * @param  string $type    Interview type
     * @return string          Font-Awesome icon name
     */
    protected function faType($type = '')
    {
        $mapAwesome = [
            ''          => 'refresh fa-spin',
            'generate'  => 'refresh',
            'recruiter' => 'comment',
            'code'      => 'desktop',
            'phone'     => 'phone-square',
            'face'      => 'user',
            'contract'  => 'star',
        ];

        return $mapAwesome[$type];
    }


    /**
     * Render job interview icon links
     * @return string    HTML markup
     */
    protected function jobInterviews()
    {
        $output = '<span class="interview">&nbsp;';
        if ($this->interviews) {
            foreach ($this->interviews as $date => $type) {
                $file = JOBS_PATH . '/interviews/' . $date . '_' . $this->localFilename . '.php';
                $path = APP_PATH . '/interview/?i=' . urlencode($date . '_' . $this->localFilename);

                if (file_exists($file)) {
                    $output .= '<a href="' . $path . '" class="icon ' . $type . '">';
                    $output .= '    <i class="fa fa-fw fa-' . $this->faType($type) . '"></i>';
                    $output .= '</a>';
                } elseif (AUTO_GENERATE_PHP_INTERVIEWS) {
                    // generator markup
                    $output .= '<span class="icon auto-generate-php" id="' . $date . '_' . $this->localFilename . '"';
                    $output .= '    data-type="php" data-path="' . JOBS_INTERVIEWS_PATH . '" data-icon="' . $this->faType($type) . '">';
                    $output .=     '<i class="fa fa-fw fa-' . $this->faType('generate') . '"></i>';
                    $output .= '</span>';

                    // markup to replace generator element after document created
                    $output .= '<a style="display:none" href="' . $path . '" class="icon ' . $type . '" data-ref="' . $date . '_' . $this->localFilename . '">';
                    $output .= '    <i class="fa fa-fw fa-' . $this->faType($type) . '"></i>';
                    $output .= '</a>';
                } else {
                    $output .= '<span class="icon copy-to-clipboard" id="' . $date . '_' . $this->localFilename . '" data-type="php">';
                    $output .=     '<i class="fa fa-fw fa-' . $this->faType() . '"></i>';
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
    protected function jobLetter()
    {
        if ($this->letter) {
            $path = JOBS_PATH . '/cover-letters/' . $this->localFilePath;

            if (file_exists($path . '.pdf')) {
                return '<a href="' . $path . '.pdf" class="icon submitted" title="Cover Letter"><i class="fa fa-envelope"></i></a>';
            } elseif (file_exists($path . '.txt')) {
                return '<a href="' . $path . '.txt" class="icon submitted" title="Cover Letter"><i class="fa fa-envelope"></i></a>';
            }
        }

        return false;
    }


    /**
     * Render resume link created for this job
     * @return string    HTML markup
     */
    protected function jobResume()
    {
        if ($this->resume) {
            $path = JOBS_PATH . '/resumes/' . $this->localFilePath;

            if (file_exists($path . '.pdf')) {
                return '<a href="' . $path . '.pdf" class="icon submitted" title="Resume"><i class="fa fa-file"></i></a>';
            }
        }

        return false;
    }


    /**
     * Render networking connection for this job
     * @return string    HTML markup
     */
    protected function jobNetwork()
    {
        if ($this->network) {
            return '<span class="icon submitted" title="' . $this->network . '"><i class="fa fa-linkedin-square"></i></span>';
        }

        return false;
    }


    /**
     * Render assets for this job
     * @return string    HTML markup
     */
    protected function jobAssets()
    {
        $output = '';

        $output .= $this->jobResume();
        $output .= $this->jobLetter();
        $output .= $this->jobNetwork();

        return $output;
    }


    /**
     * Driver to render job application row
     */
    protected function renderRow()
    {
        $output = '';

        $output .=  '<div class="row hide-for-medium-up">';
        $output .=      '<div class="small-12 columns mobile-pad">';
        $output .=          $this->jobTitle();
        $output .=      '</div>';
        $output .=  '</div>';

        $output .=  '<div class="row">';

        $output .=      '<div class="small-3 medium-2 large-2 columns">';
        $output .=          $this->jobApplicationDate();
        $output .=      '</div>';

        $output .=      '<div class="show-for-medium-up medium-5 large-5 columns">';
        $output .=          $this->jobTitle();
        $output .=      '</div>';

        $output .=      '<div class="small-6 medium-3 large-4 columns">';
        $output .=          $this->jobInterviews();
        $output .=      '</div>';

        $output .=      '<div class="small-3 medium-2 large-1 columns">';
        $output .=          $this->jobAssets();
        $output .=      '</div>';

        $output .=  '</div>';

        echo $output;
    }


    /**
     * Drivers to render a job application row
     */
    abstract public function renderApplications();
    abstract public function renderPotentials();
}
