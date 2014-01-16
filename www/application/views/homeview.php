<div>
    <h1>Login</h1>
    <p>Please login with your email/username and password below.</p>

    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("auth/login");?>

    <p><?php echo form_submit('submit', 'Create User');?></p>

    <?php echo form_close();?>
</div>