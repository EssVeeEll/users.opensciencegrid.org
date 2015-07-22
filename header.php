<?php require_once ('header/head.php'); ?>

<div id="sb-site">
<div class="boxed">

<?php
    if (of_get_option('header_style', '') != '')
    {
        require_once ('header/header.php');
    }
?>
<?php require_once ('header/navbar.php'); ?>