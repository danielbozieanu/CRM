<?php echo validation_errors(); ?>

<?php echo form_open('proiecte/add'); ?>

    <div>Nume : <textarea name="nume"><?php echo $this->input->post('nume'); ?></textarea></div>
    <div>Client : <input type="text" name="client" value="<?php echo $this->input->post('client'); ?>" /></div>
    <div>Client Email : <input type="text" name="client_email" value="<?php echo $this->input->post('client_email'); ?>" /></div>
    <div>Echipa : <textarea name="echipa"><?php echo $this->input->post('echipa'); ?></textarea></div>
    <div>Status : <input type="text" name="status" value="<?php echo $this->input->post('status'); ?>" /></div>

    <button type="submit">Save</button>

<?php echo form_close(); ?>