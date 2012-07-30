<?php

require_once('inc.php');
header('Content-Type: text/plain');
if (file_exists('key.php'))
{
    $key = require('key.php');
    if ($key['current'] === $_SERVER['QUERY_STRING'])
    {
        $submodule = getcwd();
        $project = $submodule.'/../../';
        chdir(dirname($project));
        _exec('pwd');
        _exec('git pull');
        _exec('git submodule update');
    }
}

_log(var_export($_POST, true));