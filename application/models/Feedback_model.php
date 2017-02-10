<?php

class Feedback_model extends CI_Model {

    public function update_answers($answer_id)
    {
        $this->db->set('ans_selected', 1);
        $this->db->where('ans_id', $answer_id);
        $this->db->update('answers');
    }

    public function insert_textarea_answers($answer_val, $question_id){

        foreach ($answer_val as $key=>$answer){
            $data = array(
                'ans_question' => $question_id[$key],
                'ans_value'     => $answer,
                'ans_selected' => 1,
            );

            $this->db->insert('answers', $data);
        }

    }

    public function update_form_status($form_id){
        $this->db->set('form_status', 1);
        $this->db->set('form_sent_date', date('Y-m-d'));
        $this->db->where('form_id', $form_id);
        $this->db->update('forms');
    }

}