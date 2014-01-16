<div>
    <h1>Login</h1>
    <p>Please login with your email/username and password below.</p>

    <?php echo form_open("home/login");?>

      <p>
        <label for="identity">Email:</label>
        <?php echo form_input('identity');?>
      </p>

      <p>
        <label for="password">Password:</label>
        <?php echo form_input('password');?>
      </p>

      <p>
        <label for="remember">Remember Me:</label>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      </p>


      <p><?php echo form_submit('submit', 'Login');?></p>

    <?php echo form_close();?>

    <p><a href="forgot_password">Forgot your password?</a></p><h1>Create User</h1>
    <p>Please enter the users information below.</p>
</div>
<div>
    <?php echo form_open("home/register");?>

          <p>
                Email: <br />
                <?php echo form_input('email');?>
          </p>

          <p>
                Password: <br />
                <?php echo form_input('password');?>
          </p>

          <p>
                Confirm Password: <br />
                <?php echo form_input('password_confirm');?>
          </p>


          <p><?php echo form_submit('submit', 'Create User');?></p>
    <?php echo form_close();?>
</div>
</div>