<?php if($forms): ?>

    <p>
        <a href="<?php echo site_url('form/add'); ?>" class="btn btn-success">Add new form</a>
    </p>


<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">View all forms</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>Form Name</th>
                <th>Form Created</th>
                <th>Actions</th>
            </tr>
            <?php foreach($forms as $key => $f){ ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $f['form_name']; ?></td>
                    <td><?php echo $f['form_created']; ?></td>
                    <td>
                        <a href="<?php echo site_url('form/edit/'.$f['form_id']); ?>" title="Edit form" class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="" title="Delete form" class="btn btn-danger btn-xs" data-toggle="modal" onclick="confirm_modal('<?php echo site_url('form/remove/'.$f['form_id']);?>','You want to delete the form?','Yes, delete it.','modal-danger');" data-target="#myModal">
                            <i class="fa fa-trash-o"></i>
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php $this->load->view('templates/_parts/alert_modal'); ?>

<?php else: ?>

    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>Alert!</h4>
        There are no forms.
    </div>

    <div class="pull-left">
        <a href="<?php echo site_url('form/add'); ?>" class="btn btn-success">Add new form</a>
    </div>
<?php endif; ?>