<?php

require_once 'vendor/autoload.php';

//$mycon = new \Nms\Controller\MyController();

use Nms\Controller\MyController;
$mycon = new MyController();
print $mycon->teste().'<hr>';

use Nms\Model\MyModel;
$mymod = new MyModel();
print $mymod->teste();
