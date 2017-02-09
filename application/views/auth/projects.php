<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
<p>
    <a href="<?php echo site_url('projects/add'); ?>" class="btn btn-success">Add new project</a>
</p>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Projects</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="data"><?php echo $table; ?></div>
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

<script>
    function confirm_modal(delete_url,title)
    {
        jQuery('.modal-danger').modal('show', {backdrop: 'static',keyboard :false});
        jQuery(".modal-danger.grt").text(title);
        document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
        document.getElementById('delete_link_m_n').focus();
    }
</script>
<?php endif; ?>