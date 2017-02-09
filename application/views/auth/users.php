<?php if($message != NULL) {?>
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i>Alert!</h4>
	<?php echo $message;?>
</div>
<?php } ?>

    <p><?php echo anchor('users/create_user', lang('index_create_user_link'), array('class'=>'btn btn-success'))?></p>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">All users</h3>

<!--				<div class="box-tools">-->
<!--					<div class="input-group input-group-sm" style="width: 150px;">-->
<!--						<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">-->
<!---->
<!--						<div class="input-group-btn">-->
<!--							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tbody>
					<tr>
						<th><?php echo lang('index_fname_th');?></th>
						<th><?php echo lang('index_lname_th');?></th>
						<th><?php echo lang('index_email_th');?></th>
						<th><?php echo lang('index_groups_th');?></th>
						<th><?php echo lang('index_status_th');?></th>
						<th><?php echo lang('index_action_th');?></th>
					</tr>
					<?php foreach ($users as $user):?>
						<tr>
							<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
							<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
							<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
							<td>
								<?php foreach ($user->groups as $group):?>
									<?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?><br />
								<?php endforeach?>
							</td>
							<td><?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="label label-success">'.lang('index_active_link').'</span>') : anchor("users/activate/". $user->id, '<span class="label label-danger">'.lang('index_inactive_link').'</span>');?></td>
							<td><?php echo anchor("users/edit_user/".$user->id, '<i class="fa fa-pencil" aria-hidden="true"></i>', array('class'=>'btn btn-xs btn-primary')) ;?>
                                <?php echo anchor("users/delete_user/".$user->id, '<i class="fa fa-trash-o" aria-hidden="true"></i>', array('class'=>'btn btn-xs btn-danger', 'onclick'=>'confirm(\'Delete?\')')) ;?></td>
						</tr>
					<?php endforeach;?>
					</tbody></table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

<?php //echo anchor('users/create_group', lang('index_create_group_link'), array('class'=>'btn btn-primary'))?>