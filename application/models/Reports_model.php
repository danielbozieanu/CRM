<?php

class Reports_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    function get_data($form)
    {
        $this->db->select('questions.*, GROUP_CONCAT(answers.ans_value) as answers_val, GROUP_CONCAT(answers.ans_selected) as answers_selected');
        $this->db->where('questions.question_type != "textarea"');
        $this->db->where('questions.question_form', $form);
        $this->db->from('questions');
        $this->db->join('answers', 'answers.ans_question = questions.question_id ', 'inner');

        $this->db->group_by('questions.question_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $key => $row) {
                $data[$key] = new stdClass();

                $data[$key]->question = $row->question_label;
                $data[$key]->choices = explode(',', $row->answers_val);
                $data[$key]->scores = explode(',', $row->answers_selected);
            }
        }

        return json_encode($data);
    }

    function get_agency_data($agency)
    {
        $this->db->select('agencies.agency_name, questions_project.question_label as question_label, GROUP_CONCAT(DISTINCT(answers_project.answer_value)) as answer_value, GROUP_CONCAT(answers_project.answer_selected) as score, projects.project_name as project_name, SUM(answers_project.answer_selected) as score2');
        $this->db->from('agencies');
        $this->db->where('agencies.id', $agency);
        $this->db->join('projects', 'projects.project_client = ' . $agency, 'inner');
        $this->db->join('questions_project', 'questions_project.question_project = projects.project_id');
        $this->db->join('answers_project', 'answers_project.answer_question = questions_project.id');
        $this->db->join('answers', 'answers.ans_id = answers_project.answer_answer');
        $this->db->where('questions_project.question_type != "textarea"');
        $this->db->where('answers_project.feedback_text', NULL);
        $this->db->group_by('questions_project.question_label');

        $query = $this->db->get();

        $data = '';

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $key => $row) {
                $data[$key] = new stdClass();
                $data[$key]->agency_name = $row->agency_name;
                $data[$key]->project_name = $row->project_name;
                $data[$key]->question_label = $row->question_label;
                $data[$key]->answer_value = explode(',', $row->answer_value);
                $data[$key]->score = explode(',', $row->score);
                $data[$key]->score2 = $row->score2;
            }
        }

        if ($data) {
            return json_encode($data);
        }

    }


    function get_client_data($client)
    {
        $this->db->select('projects.* ,questions_project.question_label as question_label, GROUP_CONCAT(DISTINCT(answers_project.answer_value)) as answer_value, GROUP_CONCAT(answers_project.answer_selected) as score, projects.project_name as project_name');
        $this->db->from('projects');
        $this->db->where('projects.project_final_client', $client);
        $this->db->join('questions_project', 'questions_project.question_project = projects.project_id');
        $this->db->join('answers_project', 'answers_project.answer_question = questions_project.id');
        $this->db->where('questions_project.question_type != "textarea"');
        $this->db->where('answers_project.feedback_text', NULL);
        $this->db->group_by(array('questions_project.question_label'));

        $query = $this->db->get();

        $data = '';

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $key => $row) {
                $data[$key] = new stdClass();
                $data[$key]->project_name = $row->project_name;
                $data[$key]->question_label = $row->question_label;
                $data[$key]->answer_value = explode(',', $row->answer_value);
                $data[$key]->score = explode(',', $row->score);
            }
        }

        if ($data) {
            return json_encode($data);
        }

    }

    function get_financial_data($from, $to){
        $this->db->select('projects.*');
        $this->db->from('projects');
        $this->db->where('projects.project_finished >=', $from);
        $this->db->where('projects.project_finished <=', $to);

        $query = $this->db->get();

        return $query->result();
    }
}