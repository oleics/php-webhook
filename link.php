<?php

require_once('inc.php');
$config = require('config.php');

if(file_exists('key.php')) {
  $key = require('key.php');
  if($key['current'] !== $_SERVER['QUERY_STRING']) {
    if($key['previous'] === $_SERVER['QUERY_STRING']) {
      header('Location: ?'.$key['current']);
    } else if(!isset($_POST['passwd'])) {
      echo '<form method="post"><input type="password" name="passwd" /></form>';
    } else if($_POST['passwd'] !== $config['passwd']) {
      echo 'Wrong';
    } else {
      header('Location: ?'.$key['current']);
    }
    exit;
  }
} else {
}

mt_srand(microtime(true)*1000);
$new = sha1(crypt(microtime(true).mt_rand().time().mt_rand()));
file_put_contents('key.php', '<?php return '.var_export(array(
  'current' => $new,
  'previous' => isset($key) ? $key['current'] : '',
), true).';');

echo '<label for="webhook">Webhook:</label> <input id="webhook" size="80" type="text" value="'.dirname($_SERVER['SCRIPT_URI']).'/hook.php?'.$new.'" />';
//print_r($_SERVER);
