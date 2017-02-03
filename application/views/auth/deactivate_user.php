

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">
      <?php echo lang('deactivate_heading');?>
    </h3>
    <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>
  </div>

  <?php echo form_open("users/deactivate/".$user->id);?>
  <div class="box-body">

    <p>
      <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
      <input type="radio" name="confirm" value="yes" checked="checked" />
    </p>
    <p>
      <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
      <input type="radio" name="confirm" value="no" />
    </p>

    <?php echo form_hidden($csrf); ?>
    <?php echo form_hidden(array('id'=>$user->id)); ?>

    <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), array('class'=>'btn btn-danger'));?></p>

  </div>
  <?php echo form_close();?>
</div>