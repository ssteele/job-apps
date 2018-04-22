<?php

namespace SteveSteele\JobApp\DocumentGenerator;

interface Contract
{

    public function getPath();
    public function getFile();
    public function generate();
}
