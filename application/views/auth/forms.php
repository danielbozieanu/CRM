<div class="pull-right">
    <a href="<?php echo site_url('form/add'); ?>" class="btn btn-success">Add</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
        <th>Form Id</th>
        <th>Form Name</th>
        <th>Form Project</th>
        <th>Form Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach($forms as $f){ ?>
        <tr>
            <td><?php echo $f['form_id']; ?></td>
            <td><?php echo $f['form_name']; ?></td>
            <td><?php echo $f['form_project']; ?></td>
            <td><?php echo $f['form_created']; ?></td>
            <td>
                <a href="<?php echo site_url('form/edit/'.$f['form_id']); ?>" class="btn btn-info">Edit</a>
                <a href="<?php echo site_url('form/remove/'.$f['form_id']); ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>