<?php

namespace SteveSteele\JobApp;

interface Document
{

    public function getPath();
    public function getFile();
    public function generate();
}
