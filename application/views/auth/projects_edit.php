<?php echo validation_errors(); ?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h2>View/edit project</h2>
    </div>

    <div class="box-body">
        <?php echo form_open('projects/edit/'.$projects['project_id']); ?>
        <div class="form-group">
            <label for="nume">Project name:</label>
            <input name="nume" class="form-control" value="<?php echo ($this->input->post('nume') ? $this->input->post('nume') : $projects['project_name']); ?>">
        </div>

        <div class="form-group">
            <label for="nume">Client:</label>
            <select disabled name="client" class="form-control">
                <option><?php echo ($this->input->post('project_client') ? $this->input->post('project_client') : $this->ion_auth->user($projects['project_client']))->row()->first_name;  ?></option>
            </select>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" >
                    <option value="0">In work</option>
                    <option value="1">Done</option>
                </select>
            </div>

        <?php endif; ?>

        <div class="form-group">
            <label for="status">Developers team:</label>
            <ol>
                <?php foreach($developersToProject as $developer): ?>
                    <?php $userAsDeveloper = $this->ion_auth->user($developer->id_user)->row(); ?>
                    <li>
                        <?php echo $userAsDeveloper->first_name; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>
            <button class="btn btn-block btn-success" type="submit">Save</button>
        <?php endif; ?>

        <?php echo form_close(); ?>


    </div>
</div>
