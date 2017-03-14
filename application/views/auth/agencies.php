<?php if ($agencies): ?>

<p>
    <a href="<?php echo site_url('agency/add'); ?>" class="btn btn-success">Add new agency</a>
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Agencies</h3>
    </div>

    <div class="box-body no-padding table-responsive">
                <table class="table table-hover" >

                    <tr>
                        <th><?php echo anchor('agency/index/'.$offset.'/id/'.$new_order,'#') ?></th>
                        <th><?php echo anchor('agency/index/'.$offset.'/agency_name/'.$new_order,'Name') ?></th>
                        <th><?php echo anchor('agency/index/'.$offset.'/agency_type/'.$new_order,'Type') ?></th>
                        <th><?php echo anchor('agency/index/'.$offset.'/agency_start_date/'.$new_order,'Date') ?></th>
                        <th width="15%">Actions</th>

                    </tr>


                    <?php foreach($agencies as $a){ ?>
                        <tr>
                            <td><?php echo $a['id']; ?></td>
                            <td><?php echo $a['agency_name']; ?></td>
                            <td><?php echo $a['agency_type']; ?></td>
                            <td><?php echo $a['agency_start_date']; ?></td>
                            <td>
                                <a href="<?php echo site_url('agency/edit/'.$a['id']); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="" title="Delete form" class="btn btn-danger btn-xs" data-toggle="modal" onclick="confirm_modal('<?php echo site_url('agency/remove/'.$a['id']); ?>','You want to delete the form?','Yes, delete it.','modal-danger');" data-target="#myModal"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
    </div>
</div>
<?php else: ?>

    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>Alert!</h4>
        There are no agencies.
    </div>

    <div class="pull-left">
        <a href="<?php echo site_url('agency/add'); ?>" class="btn btn-success">Add new agency</a>
    </div>
<?php endif; ?>

<?php $this->load->view('templates/_parts/alert_modal'); ?>

