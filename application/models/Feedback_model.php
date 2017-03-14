<?php

class Feedback_model extends CI_Model
{

    public function update_answers($answer_id)
    {
        $this->db->set('answer_selected', 1);
        $this->db->where('id', $answer_id);
        $this->db->update('answers_project');

    }

    public function update_answers_counter($answer_id)
    {
        $this->db->where('ans_id', $answer_id);
        $this->db->set('ans_selected', 'ans_selected+1', FALSE);
        $this->db->update('answers');

    }

    public function insert_textarea_answers($answer_val, $question_id, $projectId)
    {

        foreach ($answer_val as $key => $answer) {
            $data = array(
                'answer_question' => $question_id[$key],
                'answer_value' => $answer,
                'answer_selected' => 1,
                'answer_project' => $projectId,
                'feedback_text' => 1
            );

            $this->db->insert('answers_project', $data);
        }

    }

    public function update_form_status($projectId)
    {
        $this->db->set('form_completed', 1);
        $this->db->set('form_sent_date', date('Y-m-d'));
        $this->db->where('project_id', $projectId);
        $this->db->update('projects');
    }

    public function get_feedback_text()
    {
        $this->db->from('answers_project');
        $this->db->select('answers_project.*, projects.*, users.first_name as accountFirstName, users.last_name as accountLastName, agencies.agency_name as agency, users_proiecte.id_user as developer');
        $this->db->where('answers_project.feedback_text', 1);
        $this->db->join('projects', 'projects.project_id = answers_project.answer_project');
        $this->db->join('users', 'users.id = projects.project_client');
        $this->db->join('users_proiecte', 'users_proiecte.id_proiect = projects.project_id');
        $this->db->join('agencies', 'agencies.id = users.company');
//        $this->db->join('agencies', 'agencies.id = projects');
        return $this->db->get()->result();
    }

}