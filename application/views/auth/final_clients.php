<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Project</th>
                            <th>Agency</th>
                            <th>Account</th>
                            <th>Final client</th>
                            <th>Developer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($clients as $client): ?>
                            <tr>
                                <td><?= $client['project_name']; ?></td>
                                <td><?= $this->Agency_model->get_agency($client['project_agency'])['agency_name']; ?></td>
                                <td>
                                    <?= $userAsDeveloper = $this->ion_auth->user($client['project_client'])->row()->first_name; ?>
                                </td>
                                <td><?= $client['project_final_client']; ?></td>
                                <td>
                                    <?php $developersToProject = $this->Projects_model->get_developers($client['project_id'])->result_array(); ?>
                                    <?= $userAsDeveloper = $this->ion_auth->user($developersToProject[0]['id_user'])->row()->first_name; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>