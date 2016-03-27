<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{pageTitle}</title>

        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
</head>
<body>
    {content}
    <script type="text/javascript" src="<?php echo base_url("assets/js/search.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-2.2.2.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>