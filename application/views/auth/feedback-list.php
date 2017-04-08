<div class="box">
    <div class="box-header">
        <h3 class="box-title">Feedbacks</h3>
    </div>

    <div class="box-body no-padding-table-responsive">
        <table class="table table-hover" id="example1">
            <thead>
            <tr>
                <th>Project name</th>
                <th>Account</th>

                <th>Agency</th>
                <th>Developer</th>

                <th>Content</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($feedbacksProjects as $feedback): ?>
                <?php if ($this->ion_auth->is_admin()): ?>
                    <tr>
                        <td width="11%"><?= $feedback->project_name ?></td>
                        <td><?= $feedback->accountFirstName . ' ' . $feedback->accountLastName ?></td>
                        <td><?= $feedback->agency ?></td>
                        <td><?php echo $this->ion_auth->user($feedback->developer)->row()->first_name.' '.$this->ion_auth->user($feedback->developer)->row()->last_name;  ?></td>
                        <td width="70%"><?= $feedback->answer_value ?></td>
                    </tr>
                <?php elseif ($this->ion_auth->get_users_groups()->row()->name == 'developers') : ?>

                    <?php if ($this->ion_auth->user()->row()->id == $feedback->developer ): ?>
                    <tr>
                        <td width="11%"><?= $feedback->project_name ?></td>
                        <td><?= $feedback->accountFirstName . ' ' . $feedback->accountLastName ?></td>
                        <td><?= $feedback->agency ?></td>
                        <td><?php echo $this->ion_auth->user($feedback->developer)->row()->first_name.' '.$this->ion_auth->user($feedback->developer)->row()->last_name;  ?></td>
                        <td width="70%"><?= $feedback->answer_value ?></td>
                    </tr>
                    <?php endif; ?>

                <?php elseif ($this->ion_auth->get_users_groups()->row()->name == 'account') : ?>

                    <?php if ($this->ion_auth->user()->row()->id == $feedback->accountId ): ?>
                        <tr>
                            <td width="11%"><?= $feedback->project_name ?></td>
                            <td><?= $feedback->accountFirstName . ' ' . $feedback->accountLastName ?></td>
                            <td><?= $feedback->agency ?></td>
                            <td><?php echo $this->ion_auth->user($feedback->developer)->row()->first_name.' '.$this->ion_auth->user($feedback->developer)->row()->last_name;  ?></td>
                            <td width="70%"><?= $feedback->answer_value ?></td>
                        </tr>
                    <?php endif; ?>

                <?php elseif ($this->ion_auth->get_users_groups()->row()->name == 'agency-director') : ?>

                    <?php if ($this->ion_auth->user()->row()->company == $feedback->agency_id ): ?>
                        <tr>
                            <td width="11%"><?= $feedback->project_name ?></td>
                            <td><?= $feedback->accountFirstName . ' ' . $feedback->accountLastName ?></td>
                            <td><?= $feedback->agency ?></td>
                            <td><?php echo $this->ion_auth->user($feedback->developer)->row()->first_name.' '.$this->ion_auth->user($feedback->developer)->row()->last_name;  ?></td>
                            <td width="70%"><?= $feedback->answer_value ?></td>
                        </tr>
                    <?php endif; ?>

                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>