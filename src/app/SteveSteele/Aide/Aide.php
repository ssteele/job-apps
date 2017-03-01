<?php

namespace SteveSteele\Aide;

class Aide
{

    // Declare properties
    public $partialPath;
    private $index = 0;
    public $topics;
    private $topic;
    private $name;
    private $title;


    /**
     * Constructor
     * @param array $topics    Set interview aide topic sections
     */
    public function __construct($topics = [])
    {
        foreach ($topics as $title => $topic) {
            $this->topics[$title] = $topic;
        }
    }


    /**
     * Provide a way for the internal system to find partials folder
     */
    public function setPartialPath($path)
    {
        $this->partialPath = $path;
    }


    private function nextIndex()
    {
        $this->index++;
    }


    /**
     * Name setter
     * @param [type] $name [description]
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Topic setter
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }


    /**
     * Pull topic title out of the topic section array
     */
    private function pullTitle()
    {
        $this->title = strtoupper(array_shift($this->topic));
    }


    /**
     * Render aide topic section questions
     */
    public function renderQuestions()
    {
        foreach ($this->topic as $question) {
            $question->render($this->partialPath);
        }
    }


    /**
     * Render aide topic section
     */
    private function renderTopic()
    {
        include $this->partialPath . 'topic.php';
    }


    /**
     * Render interview aide Q and A
     */
    public function render()
    {
        foreach ($this->topics as $name => $topic) {
            $this->nextIndex();
            $this->setName($name);
            $this->setTopic($topic);
            $this->pullTitle();

            $this->renderTopic();
        }
    }
}
