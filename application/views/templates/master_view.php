<?php
$this->load->view('templates/_parts/master_header');
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $page_description; ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Your Page Content Here -->
            <?php echo $the_view_content;?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



<?php
$this->load->view('templates/_parts/master_sidebar');
$this->load->view('templates/_parts/master_footer');
?>