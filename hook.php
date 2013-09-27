<?php

require_once('inc.php');
$config = require('config.php');

header('Content-Type: text/plain');
if (file_exists('key.php'))
{
    $key = require('key.php');
    if ($key['current'] === $_SERVER['QUERY_STRING'])
    {
        $submodule = getcwd();
        $project = $submodule.'/../../../';
        chdir(dirname($project));
        _exec('pwd');
        _exec('git pull');
        _exec('git submodule update');
		
        if (isset($config['yiicPath']) && file_exists($config['yiicPath'] . './yiic')) 
        {
            _exec($config['yiicPath'] . './yiic migrate --interactive=0');
        }
        
        if (isset($config['assetsFolderPath']) && file_exists($config['assetsFolderPath']) && realpath($config['assetsFolderPath']) == realpath(dirname($config['assetsFolderPath']) . '/assets'))
        {
            _exec('rm -R ' . realpath($config['assetsFolderPath']) . '/!(.gitignore)');
        }
    }
}

_log(var_export($_POST, true));