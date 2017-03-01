<?php

namespace SteveSteele\Aide;

class Question
{

    // Declare properties
    public $question;
    public $answers;


    /**
     * Constructor
     * @param array $data    Job meta
     */
    public function __construct($data = [])
    {
        foreach ($this as $field => $value) {
            if (isset($data[$field])) {
                $this->$field = $data[$field];
            } else {
                $this->field = '';
            }
        }
    }


    /**
     * Render question answers
     */
    public function renderAnswers()
    {
        foreach ($this->answers as $answer) {
            echo '<li class="' . $answer . '"></li>';
        }
    }


    /**
     * Render aide question
     */
    public function render($partial_path)
    {
        include $partial_path . 'question.php';
    }
}
