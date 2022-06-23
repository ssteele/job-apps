<?php

namespace SteveSteele\JobApp\Application;

abstract class Base
{
    // Application properties
    public $status;
    public $searchDate;
    public $appDate;
    public $searchLink;
    public $recruiter;
    public $company;
    public $title;
    public $role;
    public $location;
    public $localPosting = true;
    public $publicPosting;
    public $tags = [];
    public $resume = true;
    public $letter = true;
    public $headhunter = false;
    public $network = false;
    public $salary;
    public $interviews = [];

    // Internal properties
    protected $officialDate;
    protected $searchDateDashed;
    protected $localFilename;
    protected $localFilePath;
    protected $terminalFriendlyFilepath;

    const VALID_LOCATIONS = [
        'remote',
        'hybrid',
        'office',
    ];

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

        $this->deriveInternalVariables();

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
        if ($this->recruiter) {
            $fields = [
                'title',
                'recruiter',
            ];
        }

        foreach ($fields as $f) {
            $f = strtolower($this->$f);
            $f = preg_replace('/[ -.\/]/', '_', $f);

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
    protected function deriveInternalVariables()
    {
        $this->officialDate = $this->searchDate;
        if ('potential' !== $this->status && 'dream' !== $this->status) {
            $this->officialDate = ($this->appDate) ? $this->appDate : 'n/a';
        }
        $this->searchDateDashed = preg_replace('/\./', '-', $this->searchDate);
        $this->getLocalFilename();
    }

    /**
     * Map interview types with font awesome icons
     * @param  string $type    Icon type
     * @return string          Font Awesome icon name
     */
    protected function faType($type = '')
    {
        $mapAwesome = [
            ''                 => 'refresh fa-spin',
            'generate'         => 'refresh',
            'remote'           => 'wifi',
            'hybrid'           => 'paperclip',
            'office'           => 'building-o',
            'network'          => 'linkedin-square',
            'headhunter'       => 'registered',
            'lead'             => 'shield',
            'recruiter'        => 'comment',
            'code'             => 'desktop',
            'phone'            => 'phone-square',
            'person'           => 'user',
            'committee'        => 'users',
            'contract'         => 'star',
            'letter'           => 'envelope',
            'resume'           => 'file',
            'posting'          => 'bookmark',
            'generate-letter'  => 'envelope-o',
            'generate-resume'  => 'file-o',
            'generate-posting' => 'bookmark-o',
        ];

        return $mapAwesome[$type];
    }

    /**
     * Render font awesome icons helper method
     * @param  string $type    Icon type
     * @return string          Markup for rendering Font Awesome icon
     */
    protected function faIcon($type = '')
    {
        return '<i class="fa fa-fw fa-' . $this->faType($type) . '" aria-hidden="true"></i>';
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

        $output .= $this->addLocationIcon();

        $output .= '</span>';

        return $output;
    }

    /**
     * Render job: Title - Company
     * @return string    HTML markup
     */
    protected function jobTitle()
    {
        $name = $this->company;
        if (! $name) {
            $name = '[' . $this->recruiter . ']';
        }

        $title = (! empty($this->title)) ? ' &#8226; ' . $this->title : '';

        $cssClass = $this->status;
        $cssClass .= (! empty($this->interviews)) ? ' interviewing' : '' ;

        $output = '';

        if ($this->publicPosting) {
            $output .= '<span class="online"><a class="' . $cssClass . '" href="' . $this->publicPosting . '">' . $name . $title . '</a></span>';
        } else {
            $output .= '<span class="online"><span class="' . $cssClass . '">' . $name . $title . '</span></span>';
        }

        $output .= $this->addIconIfHeadHunter();
        $output .= $this->addIconIfNetwork();
        $output .= $this->addIconIfLeadRole();

        return $output;
    }

    /**
     * Render job interview icon links
     * @return string    HTML markup
     */
    protected function jobInterviews()
    {
        $output = '<span class="interview">&nbsp;';
        if (! empty($this->interviews)) {
            foreach ($this->interviews as $date => $typeStatus) {
                $type = (is_array($typeStatus)) ? key($typeStatus) : $typeStatus;
                $status = (is_array($typeStatus)) ? $typeStatus[$type] : '';

                $file = JOBS_PATH . '/interviews/' . $date . '_' . $this->localFilename . '.php';
                $path = APP_PATH . '/interview/?i=' . urlencode($date . '_' . $this->localFilename);

                if (file_exists($file)) {
                    $output .= '<a href="' . $path . '" class="icon ' . $type . ' ' . $status . '">';
                    $output .=     $this->faIcon($type);
                    $output .= '</a>';
                } elseif (AUTO_GENERATE_PHP_INTERVIEWS) {
                    // generator markup
                    $output .= '<span class="icon auto-generate-php ' . $status . '" id="' . $date . '_' . $this->localFilename . '"';
                    $output .= '    data-type="php" data-path="' . JOBS_INTERVIEWS_PATH . '" data-icon="' . $this->faType($type) . '">';
                    $output .=     $this->faIcon('generate');
                    $output .= '</span>';

                    // markup to replace generator element after document created
                    $output .= '<a style="display:none" href="' . $path . '" class="icon ' . $type . ' '. $status . '" data-ref="' . $date . '_' . $this->localFilename . '">';
                    $output .=     $this->faIcon($type);
                    $output .= '</a>';
                } else {
                    $output .= '<span class="icon copy-to-clipboard" id="' . $date . '_' . $this->localFilename . '" data-type="php">';
                    $output .=     $this->faIcon();
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
                return '<a href="' . $path . '.pdf" class="icon asset" title="Cover Letter">' . $this->faIcon('letter') . '</a>';
            } elseif (file_exists($path . '.html')) {
                return '<a href="' . $path . '.html" class="icon asset" title="Cover Letter">' . $this->faIcon('letter') . '</a>';
            } elseif (file_exists($path . '.txt')) {
                return '<a href="' . $path . '.txt" class="icon asset" title="Cover Letter">' . $this->faIcon('letter') . '</a>';
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
                return '<a href="' . $path . '.pdf" class="icon asset" title="Resume">' . $this->faIcon('resume') . '</a>';
            }
        }

        return false;
    }

    /**
     * Add location icon: remote, office, hybrid
     * @return string    HTML markup
     */
    protected function addLocationIcon()
    {
        $location = strtolower($this->location);
        if ($location && in_array($location, self::VALID_LOCATIONS)) {
            return '<span class="icon location" title="' . $location . '">' . $this->faIcon($location) . '</span>';
        }

        return false;
    }

    /**
     * Render headhunter connection for this job
     * @return string    HTML markup
     */
    protected function addIconIfHeadHunter()
    {
        if ($this->headhunter) {
            $output  = '<span class="icon contact">';
            $output .=     $this->faIcon('headhunter');
            $output .=     '<span class="info hidden">';
            $output .=         $this->headhunter;
            $output .=     '</span>';
            $output .= '</span>';

            return $output;
        }

        return false;
    }

    /**
     * Render networking connection for this job
     * @return string    HTML markup
     */
    protected function addIconIfNetwork()
    {
        if ($network) {
            $output  = '<span class="icon contact">';
            $output .=     $this->faIcon('network');
            $output .=     '<span class="info hidden">';
            $output .=         $this->network;
            $output .=     '</span>';
            $output .= '</span>';

            return $output;
        }

        return false;
    }

    /**
     * Render lead icon where appropriate
     * @return string    HTML markup
     */
    protected function addIconIfLeadRole()
    {
        $role = strtolower($this->role);
        if ('lead' == $role) {
            return '<span class="icon role" title="' . $role . '">' . $this->faIcon($role) . '</span>';
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

        return $output;
    }

    /**
     * Driver to render job application row
     */
    protected function renderRow()
    {
        $output = '';

        $output .=  '<div class="row hide-for-large-up collapse abridged-view">';
        $output .=      '<div class="small-12 columns mobile-row">';
        $output .=          $this->jobTitle();
        $output .=      '</div>';
        $output .=  '</div>';

        $output .=  '<div class="row unabridged-view">';
        $output .=      '<div class="small-6 medium-3 large-2 columns">';
        $output .=          $this->jobApplicationDate();
        $output .=      '</div>';

        $output .=      '<div class="show-for-large-up large-6 columns">';
        $output .=          $this->jobTitle();
        $output .=      '</div>';

        $output .=      '<div class="show-for-medium-up medium-7 large-3 columns">';
        $output .=          $this->jobInterviews();
        $output .=      '</div>';

        $output .=      '<div class="small-6 medium-2 large-1 columns">';
        $output .=          $this->jobAssets();
        $output .=      '</div>';
        $output .=  '</div>';

        if (! empty($this->interviews)) {
            $output .=  '<div class="row hide-for-medium-up abridged-view">';
            $output .=      '<div class="small-12 columns">';
            $output .=          $this->jobInterviews();
            $output .=      '</div>';
            $output .=  '</div>';
        }

        return $output;
    }

    /**
     * Drivers to render a job application row
     */
    abstract public function renderApplications($print = true);
    abstract public function renderPotentials($print = true);
}
