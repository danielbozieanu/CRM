
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Adauga un proiect nou</h3>
            </div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('projects/add'); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="nume">Project name</label>
                        <input class="form-control" name="project_name" value="<?php echo $this->input->post('project_name'); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="project_client">Client</label>
                        <select name="project_client" class="form-control">
                            <option value="0">---SELECT CLIENT---</option>
                            <?php foreach ( $clients as $client): ?>
                                <option value="<?php echo $client->id; ?>">
                                <?php echo $client->company; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <label class="col-xs-12"><h4>Select developers:</h4></label>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <?php foreach ($users as $user):?>
                                    <?php if ( $user->active == 1) :?>
                                        <?php foreach ($user->groups as $group):?>
                                            <?php if ( $group->id == 5 ){ ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="developersToProject[]" value="<?php echo $user->id; ?>">
                                                        <?php echo $user->first_name.' '.$user->last_name; ?>
                                                    </label>
                                                </div>
                                        <?php } endforeach?>
                                    <?php endif; ?>
                                <?php endforeach;?>
                            </div>
                        </div>

                    </div>

                </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
