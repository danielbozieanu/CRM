<div class="box">
    <div class="box-header">
        <h3 class="box-title">Feedbacks</h3>
    </div>

    <div class="box-body no-padding-table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Project name</th>
                <th>Account</th>

                <th>Developer</th>

                <th>Content</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($feedbacksProjects as $feedback): ?>
                <tr>
                    <td width="11%"><?= $feedback->project_name ?></td>
                    <td><?= $feedback->accountFirstName . ' ' . $feedback->accountLastName ?></td>
                    <td><?= $feedback->developer ?></td>
                    <td width="70%"><?= $feedback->answer_value ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>