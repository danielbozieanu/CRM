<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php if ($this->session->flashdata('mailsent') !=NULL): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>Alert!</h4>
        <?php echo $this->session->flashdata('mailsent');?>
    </div>
<?php endif; ?>

<?php if ($noProjects) : ?>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>Alert!</h4>
        <?php echo $noProjects; ?>
    </div>
        <p>
            <a href="<?php echo site_url('projects/add'); ?>" class="btn btn-success">Add new project</a>
        </p>
<?php else: ?>

    <?php if ($this->ion_auth->is_admin()): ?>
        <p>
            <a href="<?php echo site_url('projects/add'); ?>" class="btn btn-success">Add new project</a>
        </p>
    <?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Projects</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $table; ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-left">
                    <?php echo $pagination; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/_parts/danger_modal'); ?>
<?php $this->load->view('templates/_parts/alert_modal'); ?>

<?php endif; ?>