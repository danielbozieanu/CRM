<?php if($message) : ?>
      <div class="callout callout-danger">
            <h4>Please pay attention!</h4>

            <div id="infoMessage"><?php echo $message;?></div>
      </div>
<?php endif; ?>

<div class="box box-info">
      <div class="box-header with-border">
            <h3 class="box-title">Add new user</h3>
      </div>

      <?php echo form_open("users/create_user");?>

      <div class="box-body">
            <div class="form-group">
                  <label for="first_name">
                        <?php echo lang('create_user_fname_label', 'first_name'); ?>
                  </label>
                  <?php echo form_input($first_name);?>
            </div>

            <div class="form-group">
                  <label for="last_name">
                        <?php echo lang('create_user_lname_label', 'last_name');?>
                  </label>
                  <?php echo form_input($last_name);?>
            </div>

            <?php
            if($identity_column!=='email') {
                  echo '<label for="email">';
                  echo lang('create_user_identity_label', 'identity');
                  echo '</label>';
                  echo '<div class="form-group">';
                  echo form_error('identity');
                  echo form_input($identity);
                  echo '</div>';
            }
            ?>


            <div class="form-group">
                  <label for="company">
                        <?php echo lang('create_user_company_label', 'company');?>
                  </label>
                  <?php echo form_input($company);?>
            </div>


            <div class="form-group">
                  <label for="email">
                        <?php echo lang('create_user_email_label', 'email');?>
                  </label>
                  <?php echo form_input($email);?>
            </div>

            <div class="form-group">
                  <label for="phone">
                        <?php echo lang('create_user_phone_label', 'phone');?>
                  </label>
                  <?php echo form_input($phone);?>
            </div>

          <div class="form-group">
              <label for="group">
                  <?php echo lang('create_user_role_label', 'role');?>
              </label>
              <?php echo form_dropdown($role);?>
          </div>

            <div class="form-group">
                  <label for="password">
                        <?php echo lang('create_user_password_label', 'password');?>
                  </label>
                  <?php echo form_input($password);?>
            </div>

            <div class="form-group">
                  <label for="password_confirm">
                        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                  </label>
                  <?php echo form_input($password_confirm);?>
            </div>


            <?php echo form_submit('submit', 'Create user', 'class="btn btn-info pull-left"');?></p>
      </div>

      <?php echo form_close();?>

</div>