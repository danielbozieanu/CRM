

<div class="box box-warning">
      <?php echo form_open(uri_string());?>

      <div class="box-header with-border">
            <h3 class="box-title">
                  Editare utilizator
            </h3>
      </div>

      <div id="infoMessage"><?php echo $message;?></div>

      <div class="box-body">
            <p>
                  <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
                  <?php echo form_input($first_name);?>
            </p>

            <p>
                  <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
                  <?php echo form_input($last_name);?>
            </p>

            <p>
                  <?php echo lang('edit_user_company_label', 'company');?> <br />
                <select name="company" id="" class="form-control">
                    <?php  foreach ($agencies as $agency): ?>
                        <?php if ($agency->id == $user->company): ?>
                            <option selected value="<?php echo $agency->id ?>"><?php echo $agency->agency_name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $agency->id ?>"><?php echo $agency->agency_name ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </p>

            <p>
                  <?php echo lang('edit_user_phone_label', 'phone');?> <br />
                  <?php echo form_input($phone);?>
            </p>

            <p>
                  <?php echo lang('edit_user_password_label', 'password');?> <br />
                  <?php echo form_input($password);?>
            </p>

            <p>
                  <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
                  <?php echo form_input($password_confirm);?>
            </p>

            <?php if ($this->ion_auth->is_admin()): ?>

                  <h3><?php echo lang('edit_user_groups_heading');?></h3>
                  <div class="form-group">
                      <select class="form-control" name="groups">
                        <?php if ($currentGroups[0]['id'] == 2): ?>
                            <option value="<?php echo $currentGroups[0]['id']; ?>"><?php echo $currentGroups[0]['description']; ?></option>
                            <option value="5">Developer</option>
                            <option value="1">Administrator</option>
                        <?php elseif ($currentGroups[0]['id'] == 5): ?>
                          <option value="<?php echo $currentGroups[0]['id']; ?>"><?php echo $currentGroups[0]['description']; ?></option>
                          <option value="2">Account</option>
                          <option value="1">Administrator</option>

                        <?php else: ?>
                        <option value="<?php echo $currentGroups[0]['id']; ?>"><?php echo $currentGroups[0]['description']; ?></option>
                        <option value="2">Account</option>
                        <option value="5">Developer</option>
                      </select>
                  </div>

                        <?php endif; ?>

            <?php endif; ?>

            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
          <br>
            <p>
                <?php echo form_submit('submit', lang('edit_user_submit_btn'), array('class'=>'btn btn-success'));?></p>

            <?php echo form_close();?>
      </div>
</div>
