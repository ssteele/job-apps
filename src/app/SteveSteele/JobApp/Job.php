<?php

namespace SteveSteele\JobApp;

class Job
{
    const VALID_APPLICATION_STATUSES = [
        'dream',
        'potential',
        'applied',
        'interviewing',
        'declined',
        'abandoned',
        'rejected',
    ];

    const VALID_APPLICATION_SECTIONS = [
        'applications',
        'potentials',
    ];

    /**
     * Application factory
     * @param array $data    Job meta
     * @return object        Concrete application instantiation
     */
    public static function create($data = [])
    {
        $status = strtolower($data['status']);
        if (! in_array($status, self::VALID_APPLICATION_STATUSES)) {
            $status = 'potential';
        }

        $className = '\\SteveSteele\\JobApp\\Application\\' . ucfirst($status);
        return new $className($data);
    }

    /**
     * Handle the rendering of job rows
     * @param  string $section   Section (eg: applications, potentials)
     * @param  array  $jobs      Application objects
     */
    public static function render($section = 'applications', $jobs = [])
    {
        $section = strtolower($section);
        if (! in_array($section, self::VALID_APPLICATION_SECTIONS)) {
            $section = 'potentials';
        }

        $cmd = 'render' . ucfirst($section);
        if (! empty($jobs)) {
            foreach ($jobs as $j) {
                $j->$cmd();
            }
        }
    }
}
