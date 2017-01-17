<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Adauga un proiect nou</h3>
            </div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('clienti/add'); ?>
            <div class="box-body">

                <div class="form-group">
                    <label for="nume">Nume client</label>
                    <input class="form-control" name="nume" value="<?php echo $this->input->post('nume'); ?>"/>
                </div>

                <div class="form-group">
                    <label for="client">Email</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $this->input->post('email'); ?>" />
                </div>

                <div class="form-group">
                    <label for="client">Telefon</label>
                    <input class="form-control" type="text" name="tel" value="<?php echo $this->input->post('tel'); ?>" />
                </div>

            </div>
            <button type="submit">Save</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

