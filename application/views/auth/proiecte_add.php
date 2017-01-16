

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Adauga un proiect nou</h3>
            </div>

            <?php echo form_open('proiecte/add'); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="nume">Nume proiect</label>
                        <input class="form-control" name="nume" value="<?php echo $this->input->post('nume'); ?> "/>
                    </div>
                    <div class="form-group">
                        <label for="client">Client</label>
                        <input class="form-control" type="text" name="client" value="<?php echo $this->input->post('client'); ?>" />
                    </div>
                    <div class="row">
                        <label class="col-xs-12"><h4>Echipa:</h4></label>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Frontend</label>
                                <?php foreach ($users as $user):?>
                                    <?php if ( $user->active == 1) :?>
                                        <?php foreach ($user->groups as $group):?>
                                            <?php if ( $group->id == 5 ){ ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="usersProiect[]" value="<?php echo $user->id; ?>">
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
            <button type="submit">Save</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
