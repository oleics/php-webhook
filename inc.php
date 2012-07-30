<?php

#error_reporting(0);

function _exec($cmd)
{
    $out = "$ " . $cmd . "\n";
    $out .= shell_exec($cmd . ' 2>&1');
    _log($out);
}

function _log($str)
{
    $out = "\n" . date('r') . " " . $str;
    echo $out;
    error_log($out, 3, '.webhook.log');
}
