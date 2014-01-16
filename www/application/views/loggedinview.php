<html>
<head>
    <title> FIRST LIST VIEW PAGE </title>
</head>
<body>
<?php echo anchor('home/logout', 'Logout') ?>
<?php echo form_open('listcheck/check'); ?>
<b> Welcome to the Site </b>
<p> Movie Name: <p>
<input type='text' name='moviename' id='moviename'/>
<br/>
<?php echo form_submit('submit','Submit') ?>
<?php echo form_close()?>
<?php echo validation_errors(); ?>
</body>
</html>
