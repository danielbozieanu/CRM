<?php echo validation_errors(); ?>

<?php echo form_open('proiecte/edit/'.$proiecte['id']); ?>

    <div>Nume : <textarea name="nume"><?php echo ($this->input->post('nume') ? $this->input->post('nume') : $proiecte['nume']); ?></textarea></div>
    <div>Client : <input type="text" name="client" value="<?php echo ($this->input->post('client') ? $this->input->post('client') : $proiecte['client']); ?>" /></div>
    <div>Client Email : <input type="text" name="client_email" value="<?php echo ($this->input->post('client_email') ? $this->input->post('client_email') : $proiecte['client_email']); ?>" /></div>
    <div>Echipa : <textarea name="echipa"><?php echo ($this->input->post('echipa') ? $this->input->post('echipa') : $proiecte['echipa']); ?></textarea></div>
    <div>Status : <input type="text" name="status" value="<?php echo ($this->input->post('status') ? $this->input->post('status') : $proiecte['status']); ?>" /></div>

    <button type="submit">Save</button>

<?php echo form_close(); ?>