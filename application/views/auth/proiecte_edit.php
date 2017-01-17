<?php echo validation_errors(); ?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h2>Vizualizare/editare proiect</h2>
    </div>

    <div class="box-body">
        <?php echo form_open('proiecte/edit/'.$proiecte['id_proiect']); ?>
        <div class="form-group">
            <label for="nume">Nume poiect:</label>
            <input name="nume" class="form-control" value="<?php echo ($this->input->post('nume') ? $this->input->post('nume') : $proiecte['nume_proiect']); ?>">
        </div>

        <div class="form-group">
            <label for="nume">Client:</label>
            <select disabled name="client" class="form-control">
                <option><?php echo ($this->input->post('client') ? $this->input->post('client') : $project_client) ?></option>
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
            <label for="status">Echipa:</label>
            <ol>
                <?php foreach ($queryUsersProiecte as $userWorking): ?>
                    <?php foreach ($users as $user):?>
                        <?php if ( ($userWorking->id_proiect == $proiecte['id_proiect']) && ($userWorking->id_user == $user->id) ): ?>
                            <li><?php echo $user->first_name; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ol>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>
            <button class="btn btn-block btn-success" type="submit">Save</button>
        <?php endif; ?>

        <?php echo form_close(); ?>


    </div>
</div>
