<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller'] = array(
    'class'    => 'Webhook',
    'function' => 'post_controller',
    'filename' => 'Webhook.php',
    'filepath' => 'hooks',
    'params'   => ''
);

?>