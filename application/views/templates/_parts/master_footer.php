<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
<!-- JqueryValidation -->
<script src="<?php echo base_url(); ?>assets/js/jqueryvalidation/jquery.validate.js"></script>
<!-- Copy to clipboard Plugin -->
<script src="<?php echo base_url(); ?>/assets/js/jquery.copy-to-clipboard.js"></script>
<!-- Date picker -->
<script src="<?php echo base_url(); ?>/assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>/assets/daterangepicker/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/daterangepicker/daterangepicker.js"></script>
<!-- Data tables -->
<script src="<?php echo base_url(); ?>/assets/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/datatables/dataTables.bootstrap.min.js"></script>

<!-- SELECT2 -->
<script src="<?php echo base_url(); ?>/assets/select2/select2.js"></script>
<!-- Custom scripts -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

<script src="//cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js"></script>

<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/main.js"></script>-->


<?php if ($this->uri->segment(1) == 'projects' && ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit') || $this->uri->segment(1) == 'agency'): ?>
    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    </script>
<?php endif; ?>

<script>
    //Date picker
    $('#daterangeSelect').daterangepicker({
        autoclose: true,
        locale: {
            format: "YYYY-MM-DD"
        }
    });
</script>
</body>
</html>