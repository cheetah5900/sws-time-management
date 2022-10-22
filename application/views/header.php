<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('Asia/Bangkok', 'UTC');
date_default_timezone_set("Asia/Bangkok");
?>

<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="<?php echo base_url();?>assets/dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>ระบบจัดการเวลา SWS</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/app.css" />
        <!-- END: CSS Assets-->

    <!-- บังคำ Username เป็น ตัวอักษรเล็ก -->
    <script>
        function forceLower(strInput) 
        {strInput.value=strInput.value.toLowerCase();}        
        function forceUpper(strInput) 
        {strInput.value=strInput.value.toUpperCase();}
    </script>
    </head>