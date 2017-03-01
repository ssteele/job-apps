<?php

namespace SteveSteele\JobApp;

class Job
{

    /**
     * Application factory
     * @param array $data    Job meta
     * @return object       Concrete application instantiation
     */
    public static function create($data = [])
    {
        $className = '\\SteveSteele\\JobApp\\' . ucfirst(strtolower($data['status']));
        return new $className($data);
    }


    /**
     * Handle the rendering of job rows
     * @param  array  $jobs      Application objects
     * @param  string $status    Section
     */
    public static function render($jobs = [], $status = 'applications')
    {
        $cmd = 'render' . ucfirst(strtolower($status));

        if (! empty($jobs)) {
            foreach ($jobs as $j) {
                $j->$cmd();
            }
        }
    }
}
