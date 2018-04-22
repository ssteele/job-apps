<?php

namespace SteveSteele\JobApp;

class Job
{

    /**
     * Application factory
     * @param array $data    Job meta
     * @return object        Concrete application instantiation
     */
    public static function create($data = [])
    {
        $className = '\\SteveSteele\\JobApp\\Application\\' . ucfirst(strtolower($data['status']));
        return new $className($data);
    }


    /**
     * Handle the rendering of job rows
     * @param  string $status    Section
     * @param  array  $jobs      Application objects
     */
    public static function render($status = 'applications', $jobs = [])
    {
        $cmd = 'render' . ucfirst(strtolower($status));

        if (! empty($jobs)) {
            foreach ($jobs as $j) {
                $j->$cmd();
            }
        }
    }
}
