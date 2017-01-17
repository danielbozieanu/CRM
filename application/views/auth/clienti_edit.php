<?php echo validation_errors(); ?>

<?php echo form_open('clienti/edit/'.$clienti['id_client']); ?>

    <div>Nume : <input type="text" name="nume" value="<?php echo ($this->input->post('nume') ? $this->input->post('nume') : $clienti['nume_client']); ?>" /></div>
    <div>Email : <input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $clienti['email_client']); ?>" /></div>
    <div>Tel : <textarea name="tel"><?php echo ($this->input->post('tel') ? $this->input->post('tel') : $clienti['tel']); ?></textarea></div>

    <button type="submit">Save</button>

<?php echo form_close(); ?>