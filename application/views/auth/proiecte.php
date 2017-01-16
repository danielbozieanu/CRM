<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Proiecte</h3>
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



