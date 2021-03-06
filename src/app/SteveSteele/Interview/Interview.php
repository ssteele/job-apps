<?php

namespace SteveSteele\Interview;

class Interview
{

    // Declare properties
    public $status = true;
    public $class = '';
    public $title = '';
    public $list = '';
    public $items = [];
    public $text = false;


    /**
     * Constructor
     * @param array $data    Job meta
     */
    public function __construct($data = [])
    {
        // $this->path = 'html/';

        foreach ($this as $field => $value) {
            if (isset($data[$field])) {
                $this->$field = $data[$field];
            } else {
                $this->field = '';
            }

        }
    }


    /**
     * Turn the Q/A title into a class for logging during interview aide
     * @return string    Logging class
     */
    private function classFromTitle()
    {
        $disallowedRegex = '/\?/';

        $class = $this->title;

        $class = preg_replace($disallowedRegex, '', $class);
        $class = preg_replace('/\s/', '-', $class);
        $class = strtolower($class);

        return $class;
    }


    /**
     * Render interview QA section
     * @return string    Interview questions and answers
     */
    private function renderQa()
    {
        $count = 1;
        $output = '';

        $class = $this->classFromTitle();
        foreach ($this->items as $q => $a) {
            if (! empty($a)) {
                $output .= '<li class="' . $class . '-' . $count . ' asked">' . $q . '</li>';
                $output .= '<li class="answer">' . $a . '</li>';
            } else {
                $output .= '<li class="' . $class . '-' . $count . ' not-asked">' . $q . '</li>';
            }

            $count++;
        }

        return $output;
    }


    /**
     * Render interview list
     * @return string    Interview meta listed
     */
    private function renderList()
    {
        $count = 1;
        $output = '';

        $class = $this->classFromTitle();
        foreach ($this->items as $i) {
            $output .= '<li class="' . $class . '-' . $count . '">' . $i . '</li>';
            $count++;
        }

        return $output;
    }


    /**
     * Render simple interview text
     * @return string    Interview meta
     */
    private function renderText()
    {
        return $this->text;
    }


    /**
     * Driver to render interview meta
     * @return string    Interview meta
     */
    public function renderMeta()
    {
        if ($this->status) {
            $output = '';
            $output .= '<div class="block ' . $this->class . '">';
            $output .= '    <h3>' . $this->title . '</h3>';

            if (! empty($this->list)) {
                $output .= '    <' . $this->list . '>';
            }

            if ('qa' == $this->class) {
                $output .= $this->renderQa();
            } else if (! empty($this->list)) {
                $output .= $this->renderList();
            } else {
                $output .= $this->renderText();
            }

            if (! empty($this->list)) {
                $output .= '    </' . $this->list . '>';
            }

            $output .= '</div>';

            echo $output;
        }
    }
}
