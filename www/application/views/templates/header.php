<!DOCTYPE html>
<html>
<head>
    <title>Facebook Sweetness</title>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
    <script src="/assets/js/global.js" type="text/javascript"></script>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/assets/css/site-specific.css" rel="stylesheet" media="screen">
    <script src="/assets/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
            <h1 class="text-center">first blush</h1>
            <?php if (@$user_profile):  ?>
                <a href="<?php echo $logout_url?>">Logout of this thing</a>
                <br/>
            <?php endif; ?>