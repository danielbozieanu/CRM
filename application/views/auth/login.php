<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="login-box">
  <div class="login-box-body">
    <p class="login-box-msg">Te rugam sa te autentifici</p>
    <?php
    echo form_open();
    echo form_error('username');
    ?>
    <div class="form-group has-feedback">
      <?php
      echo form_input('username','','class="form-control" placeholder="Username"');
      ?>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
    <?php
    echo form_error('password');
    echo form_password('password','','class="form-control" placeholder="Password"');
    ?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck" style="padding-left:20px;">
                <?php
                echo form_checkbox('remember','1',FALSE);

                echo form_label('Remember me');
                ?>
        </div>
      </div>
      <div class="col-xs-4">
    <?php
    echo form_submit('submit','Log In','class="btn btn-primary btn-block btn-flat"');
    ?>
      </div>
    <?php
    echo form_close();
    ?>
    </div>
  </div>
</div>