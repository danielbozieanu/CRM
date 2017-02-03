<?php if ($this->session->flashdata('mailsent') !=NULL): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>Alert!</h4>
        <?php echo $this->session->flashdata('mailsent');?>
    </div>
<?php endif; ?>

<?php if($forms): ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">View all forms</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Form Name</th>
                <th>Project</th>
                <th>Form Created</th>
                <th>Form Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach($forms as $key => $f){ ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $f['form_name']; ?></td>
                    <td><?php echo $this->Projects_model->get_project($f['form_project'])['project_name']; ?></td>
                    <td><?php echo $f['form_created']; ?></td>
                    <td>
                        <?php if (!$f['form_status']): ?>
                            <span class="label label-warning">Pending</span>
                        <?php else: ?>
                            <span class="label label-success">Sent</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo site_url('form/edit/'.$f['form_id']); ?>" title="Edit form" class="btn btn-primary btn-xs">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="" title="Delete form" class="btn btn-danger btn-xs" data-toggle="modal" onclick="confirm_modal('<?php echo site_url('form/remove/'.$f['form_id']);?>','Title');" data-target="#myModal">
                            <i class="fa fa-trash-o"></i>
                        </a>
                        <a href="" title="Copy form link!"  class="btn btn-info btn-xs" data-clipboard-text="<?php echo base_url().'feedback/index/'.$f['form_slug'] ?>" onclick="event.preventDefault()">
                            <i class="fa fa-link" aria-hidden="true"></i>
                        </a>
                        <a href="" title="Send form" class="btn btn-warning btn-xs" data-toggle="modal" onclick="confirm_send_modal('<?php echo site_url('sender/index/'.$f['form_slug']);?>','Title');" data-target="#myModal">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php $this->load->view('templates/_parts/danger_modal'); ?>
<?php $this->load->view('templates/_parts/alert_modal'); ?>

<script>
    function confirm_modal(delete_url,title)
    {
        jQuery('.modal-danger').modal('show', {backdrop: 'static',keyboard :false});
        jQuery(".modal-danger.grt").text(title);
        document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
        document.getElementById('delete_link_m_n').focus();
    }

    function confirm_send_modal(send_url,title)
    {
        jQuery('.modal-warning').modal('show', {backdrop: 'static',keyboard :false});
        jQuery(".modal-warning.grt").text(title);
        document.getElementById('send_link_m_n').setAttribute("href" , send_url );
        document.getElementById('send_link_m_n').focus();
    }
</script>
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
