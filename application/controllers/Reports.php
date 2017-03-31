<?php

class Reports extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CRM LOW - Reports';
        $this->data['page_description'] = 'Reports';

        $this->load->model('Reports_model');
        $this->load->model('Form_model');
        $this->load->model('Agency_model');
        $this->load->model('Projects_model');
        $this->load->model('Question_model');
    }


    function get_data($form)
    {
        header('Content-Type: application/json');
        print_r($this->Reports_model->get_data($form));
    }

    function get_agency_data($agencyId, $from, $to)
    {

        $answers = [];
        $data = [];

        $projects = $this->Projects_model->get_all_projects_done();

        foreach ($projects as $key => $project) {
            if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && $agencyId == $project['project_agency'] && $project['form_template'] == 44 && $project['form_completed'] == 1) {
                $questions = $this->Question_model->get_project_questions($project['project_id']);

                foreach ($questions as $key2 => $question) {
                    $answers[$key] = $this->Question_model->get_project_question_answers($question['id']);
                    foreach ($answers[$key] as $key3 => $answer) {

                        if ($question['question_type'] != 'textarea' && $answer['answer_question'] == $question['id']) {

                            $data[$key2]['question_label'] = $questions[$key2]['question_label'];
                            $data[$key2]['answers'][$key3] = $answer['answer_value'];

                            $data[$key2]['scores'][$key][$key3] = $answer['answer_selected'];
                        }
                    }
                }

            }
        }

        header('Content-Type: application/json');

        foreach ($data as $key => $questionItem) {
            for ($i = 0; $i < count($questionItem['answers']); $i++) {
                $data[$key]['total'][$i] = array_sum(array_column($data[$key]['scores'], $i));
            }
        }


        if ($data) {
            print_r(json_encode($data));
        }


    }

    function get_client_data($client = null, $from, $to)
    {
        $viewProjects = [];

        $answers = [];
        $data = [];

        $projects = $this->Projects_model->get_all_projects_done();

        if ($client) {
            foreach ($projects as $key => $project) {

                if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && strtolower($client) == strtolower($project['project_final_client']) && $project['form_template'] == 44 && $project['form_completed'] == 1) {

                    $questions = $this->Question_model->get_project_questions($project['project_id']);

                    foreach ($questions as $key2 => $question) {
                        $answers[$key] = $this->Question_model->get_project_question_answers($question['id']);
                        foreach ($answers[$key] as $key3 => $answer) {

                            if ($question['question_type'] != 'textarea' && $answer['answer_question'] == $question['id']) {

                                $data[$key2]['question_label'] = $questions[$key2]['question_label'];
                                $data[$key2]['answers'][$key3] = $answer['answer_value'];

                                $data[$key2]['scores'][$key][$key3] = $answer['answer_selected'];
                            }
                        }
                    }

                }
            }
        } else {
            foreach ($projects as $key => $project) {
                array_push($viewProjects, $project['project_final_client']);
            }
        }

        header('Content-Type: application/json');

        foreach ($data as $key => $questionItem) {
            for ($i = 0; $i < count($questionItem['answers']); $i++) {
                $data[$key]['total'][$i] = array_sum(array_column($data[$key]['scores'], $i));
            }
        }

        if ($data) {
            print_r(json_encode($data));
        }

    }

    function get_daterange_data($from, $to)
    {
        $viewProjects = [];

        $answers = [];
        $data = [];

        $projects = $this->Projects_model->get_all_projects_done();

        if ($from && $to) {

            foreach ($projects as $key => $project) {

                if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && $project['form_template'] == 44 && $project['form_completed'] == 1) {

                    $questions = $this->Question_model->get_project_questions($project['project_id']);

                    foreach ($questions as $key2 => $question) {
                        $answers[$key] = $this->Question_model->get_project_question_answers($question['id']);
                        foreach ($answers[$key] as $key3 => $answer) {

                            if ($question['question_type'] != 'textarea' && $answer['answer_question'] == $question['id']) {

                                $data[$key2]['question_label'] = $questions[$key2]['question_label'];
                                $data[$key2]['answers'][$key3] = $answer['answer_value'];

                                $data[$key2]['scores'][$key][$key3] = $answer['answer_selected'];
                            }
                        }
                    }

                }
            }
        } else {
            foreach ($projects as $key => $project) {
                array_push($viewProjects, $project['project_final_client']);
            }
        }

        header('Content-Type: application/json');

        foreach ($data as $key => $questionItem) {
            for ($i = 0; $i < count($questionItem['answers']); $i++) {
                $data[$key]['total'][$i] = array_sum(array_column($data[$key]['scores'], $i));
            }
        }

        if ($data) {
            print_r(json_encode($data));
        }

    }

    function get_developer_data($developerId, $from, $to)
    {

        $answers = [];
        $data = [];

        $projectsOfDev = $this->Projects_model->get_developer_projects($developerId);

        foreach ($projectsOfDev as $key => $project) {
            if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && $project['form_template'] == 44 && $project['form_completed'] == 1 && $project['project_status'] == 1) {
                $questions = $this->Question_model->get_project_questions($project['project_id']);

                foreach ($questions as $key2 => $question) {
                    $answers[$key] = $this->Question_model->get_project_question_answers($question['id']);
                    foreach ($answers[$key] as $key3 => $answer) {

                        if ($question['question_type'] != 'textarea' && $answer['answer_question'] == $question['id']) {

                            $data[$key2]['question_label'] = $questions[$key2]['question_label'];
                            $data[$key2]['answers'][$key3] = $answer['answer_value'];

                            $data[$key2]['scores'][$key][$key3] = $answer['answer_selected'];
                        }
                    }
                }

            }
        }

        header('Content-Type: application/json');

        foreach ($data as $key => $questionItem) {
            for ($i = 0; $i < count($questionItem['answers']); $i++) {
                $data[$key]['total'][$i] = array_sum(array_column($data[$key]['scores'], $i));
            }
        }


        if ($data) {
            print_r(json_encode($data));
        }


    }

    function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->data['forms'] = $this->Form_model->get_all_forms();
            $this->render('auth/reports');
        }
    }

    function agency()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->data['agencies'] = $this->Agency_model->get_all_agencies_np();
            $this->render('auth/reports_agency');
        }
    }

    function daterange()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->data['agencies'] = $this->Agency_model->get_all_agencies_np();
            $this->render('auth/reports_date_range');
        }
    }

    function client()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {

            $projects = $this->Projects_model->get_all_projects_done();

            $viewProjects = [];
            foreach ($projects as $key => $project) {
                array_push($viewProjects, $project['project_final_client']);
            }

            $this->data['viewProjects'] = array_unique($viewProjects);

            $this->render('auth/reports_client');
        }
    }

    function developer()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->data['developers'] = $this->Projects_model->getDevelopers();

            $this->render('auth/reports_developer');
        }
    }

    /*
     * Render page function
     */
    protected
    function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }

}