<ul class="nav nav-tabs">
    <li><?php echo anchor("reports/agency", 'By Agency'); ?></li>
    <li><?php echo anchor("reports/client", 'By Client'); ?></li>
    <li><?php echo anchor("reports/developer", 'By Developer'); ?></li>
    <li><?php echo anchor("reports/daterange", 'By Date Range'); ?></li>
    <li class="active"><?php echo anchor("reports/financial", 'Financial by Date Range'); ?></li>
</ul>
<br>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div id="reportrange" class="pull-right"
                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                <span></span> <b class="caret"></b>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2">
            <form id="financialForm" action="" method="POST">
                <input type="hidden" id="from" name="financialFrom">
                <input type="hidden" id="to" name="financialTo">
                <button type="submit" id="filterButton" class="btn">Filter</button>
            </form>
        </div>
    </div>
</div>

<?php if ($projects): ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Feedbacks</h3>
        </div>

        <div class="box-body no-padding-table-responsive">
            <table class="table table-hover" id="financialTable">
                <thead>
                <tr>
                    <th>Project name</th>
                    <th>Account</th>
                    <th>Agency</th>
                    <th>Developer</th>
                    <th>Date</th>
                    <th>Project value</th>
                    <th>Project costs</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th colspan="6" style="text-align:right">Total:</th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody>

                <?php if ($this->ion_auth->is_admin()): ?>
                    <?php foreach ($projects as $project): ?>
                        <?php $developerToProject = $this->Projects_model->get_developers($project->project_id)->row(); ?>

                        <tr>
                            <td><?php echo $project->project_name; ?></td>
                            <td><?php echo $this->ion_auth->user($project->project_client)->row()->first_name . ' ' . $this->ion_auth->user($project->project_client)->row()->last_name; ?></td>
                            <td><?php echo $this->Agency_model->get_agency($project->project_agency)['agency_name']; ?></td>
                            <td><?php echo $this->ion_auth->user($developerToProject->id_user)->row()->first_name . ' ' . $this->ion_auth->user($developerToProject->id_user)->row()->last_name; ?></td>
                            <td><?php echo $project->project_finished; ?></td>
                            <td><?php echo $project->project_value ?></td>
                            <td><?php echo $project->project_costs ?></td>
                        </tr>

                    <?php endforeach; ?>
                <?php elseif ($this->ion_auth->get_users_groups()->row()->name == 'developers'): ?>

                    <?php foreach ($projects as $project): ?>
                        <?php $developerToProject = $this->Projects_model->get_developers($project->project_id)->result_array(); ?>

                        <?php if ($developerToProject[0]['id_user'] == $this->ion_auth->user()->row()->id): ?>
                            <tr>
                                <td><?php echo $project->project_name; ?></td>
                                <td><?php echo $this->ion_auth->user($project->project_client)->row()->first_name . ' ' . $this->ion_auth->user($project->project_client)->row()->last_name; ?></td>
                                <td><?php echo $this->Agency_model->get_agency($project->project_agency)['agency_name']; ?></td>
                                <td><?php echo $this->ion_auth->user($developerToProject[0]['id_user'])->row()->first_name . ' ' . $this->ion_auth->user($developerToProject[0]['id_user'])->row()->last_name; ?></td>
                                <td><?php echo $project->project_finished; ?></td>
                                <td><?php echo $project->project_value ?></td>
                                <td><?php echo $project->project_costs ?></td>
                            </tr>
                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php elseif ($this->ion_auth->get_users_groups()->row()->name == 'account') : ?>
                    <?php foreach ($projects as $project): ?>
                        <?php $developerToProject = $this->Projects_model->get_developers($project->project_id)->result_array(); ?>
                        <?php if ($project->project_client == $this->ion_auth->user()->row()->id): ?>
                            <tr>
                                <td><?php echo $project->project_name; ?></td>
                                <td><?php echo $this->ion_auth->user($project->project_client)->row()->first_name . ' ' . $this->ion_auth->user($project->project_client)->row()->last_name; ?></td>
                                <td><?php echo $this->Agency_model->get_agency($project->project_agency)['agency_name']; ?></td>
                                <td><?php echo $this->ion_auth->user($developerToProject[0]['id_user'])->row()->first_name . ' ' . $this->ion_auth->user($developerToProject[0]['id_user'])->row()->last_name; ?></td>
                                <td><?php echo $project->project_finished; ?></td>
                                <td><?php echo $project->project_value ?></td>
                                <td><?php echo $project->project_costs ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php elseif ($this->ion_auth->get_users_groups()->row()->name == 'agency-director'): ?>
                    <?php foreach ($projects as $project): ?>
                        <?php $developerToProject = $this->Projects_model->get_developers($project->project_id)->result_array(); ?>
                        <?php if ($project->project_agency == $this->ion_auth->user()->row()->company): ?>
                            <tr>
                                <td><?php echo $project->project_name; ?></td>
                                <td><?php echo $this->ion_auth->user($project->project_client)->row()->first_name . ' ' . $this->ion_auth->user($project->project_client)->row()->last_name; ?></td>
                                <td><?php echo $this->Agency_model->get_agency($project->project_agency)['agency_name']; ?></td>
                                <td><?php echo $this->ion_auth->user($developerToProject[0]['id_user'])->row()->first_name . ' ' . $this->ion_auth->user($developerToProject[0]['id_user'])->row()->last_name; ?></td>
                                <td><?php echo $project->project_finished; ?></td>
                                <td><?php echo $project->project_value ?></td>
                                <td><?php echo $project->project_costs ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>
<?php else: ?>
    <section class="content">
        <div id="reports-wrapper" class="row">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                Please check filter.
            </div>
        </div>
    </section>
<?php endif; ?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>

<script>
    //Range picker
    $(function () {

        var start = moment().subtract(0, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));

            var to = $('#from').val(start.format('YYYY-MM-D'));
            var from = $('#to').val(end.format('YYYY-MM-D'));

        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    });

</script>