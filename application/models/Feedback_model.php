<?php

class Feedback_model extends CI_Model {

    public function update_answers($answer_id)
    {
        $this->db->set('ans_selected', 1);
        $this->db->where('ans_id', $answer_id);
        $this->db->update('answers');
    }

    public function update_form_status($form_id){
        $this->db->set('form_status', 1);
        $this->db->set('form_sent_date', date('Y-m-d'));
        $this->db->where('form_id', $form_id);
        $this->db->update('forms');
    }

}