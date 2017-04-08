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

            $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

            if ($this->ion_auth->is_admin()) {
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
            } else {
                if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && $agencyId == $project['project_agency'] && $project['form_template'] == 44 && $project['form_completed'] == 1 && ($this->ion_auth->user()->row()->id == $developerToProject[0]['id_user'] || $this->ion_auth->user()->row()->company == $project['project_agency'])) {
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

                $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

                if ($this->ion_auth->is_admin()) {
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
                } else {
                    if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && strtolower($client) == strtolower($project['project_final_client']) && $project['form_template'] == 44 && $project['form_completed'] == 1 && ($this->ion_auth->user()->row()->id == $developerToProject[0]['id_user'] || $this->ion_auth->user()->row()->id == $project['project_client'] || $this->ion_auth->user()->row()->company == $project['project_agency'])) {

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

                $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

                if ($this->ion_auth->is_admin()) {
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
                } else {
                    if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && $project['form_template'] == 44 && $project['form_completed'] == 1 &&
                        ($this->ion_auth->user()->row()->id == $developerToProject[0]['id_user'] ||
                            $this->ion_auth->user()->row()->id == $project['project_client'] ||
                            $this->ion_auth->user()->row()->company == $project['project_agency'])
                    ) {

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

            $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

            if ($this->ion_auth->is_admin()) {
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
            } else {
                if (strtotime($from) <= strtotime($project['project_finished']) && strtotime($to) >= strtotime($project['project_finished']) && $project['form_template'] == 44 && $project['form_completed'] == 1 && $project['project_status'] == 1 &&
                    ($this->ion_auth->user()->row()->id == $developerToProject[0]['id_user'] ||
                        $this->ion_auth->user()->row()->id == $project['project_client'] ||
                        $this->ion_auth->user()->row()->company == $project['project_agency']
                    )
                ) {

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

            $viewClients = [];
            foreach ($projects as $key => $project) {
                if ($this->ion_auth->is_admin()) {
                    array_push($viewClients, $project['project_final_client']);
                } else {
                    $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();
                    if ($this->ion_auth->user()->row()->id == $developerToProject[0]['id_user'] || $this->ion_auth->user()->row()->id == $project['project_client'] || $this->ion_auth->user()->row()->company == $project['project_agency']) {
                        array_push($viewClients, $project['project_final_client']);
                    }
                }
            }

            $this->data['viewClients'] = array_unique($viewClients);

            $this->render('auth/reports_client');
        }
    }

    function developer()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $viewDevelopers = [];
            $developersId = [];

            $developers = $this->Projects_model->getDevelopers();

            if ($this->ion_auth->is_admin()) {
                $this->data['developers'] = $developers;

            } elseif ($this->ion_auth->get_users_groups()->row()->name == 'developers') {

                $projects = $this->Projects_model->get_all_projects_done();

                foreach ($projects as $key => $project) {

                    $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

                    if ($this->ion_auth->user()->row()->id == $developerToProject[0]['id_user']) {

//                        array_push($viewDevelopers, $developerToProject[0]['id_user']);
                        $idUser = $developerToProject[0]['id_user'];
                        array_push($developersId, $idUser);
                    }
                }

                $this->data['developers'] = array_unique($developersId);

            } elseif ($this->ion_auth->get_users_groups()->row()->name == 'account') {

                $projects = $this->Projects_model->get_all_projects_done();

                foreach ($projects as $key => $project) {

                    $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

                    if ($this->ion_auth->user()->row()->id == $project['project_client']) {

//                        array_push($viewDevelopers, $developerToProject[0]['id_user']);
                        $idUser = $developerToProject[0]['id_user'];
                        array_push($developersId, $idUser);
                    }
                }

                $this->data['developers'] = array_unique($developersId);

            } elseif ($this->ion_auth->get_users_groups()->row()->name == 'agency-director') {

                $projects = $this->Projects_model->get_all_projects_done();

                foreach ($projects as $key => $project) {

                    $developerToProject = $this->Projects_model->get_developers($project['project_id'])->result_array();

                    if ($this->ion_auth->user()->row()->company == $project['project_agency']) {

//                        array_push($viewDevelopers, $developerToProject[0]['id_user']);
                        $idUser = $developerToProject[0]['id_user'];
                        array_push($developersId, $idUser);
                    }
                }

                $this->data['developers'] = array_unique($developersId);
            }

            $this->render('auth/reports_developer');
        }
    }

    function financial()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->data['projects'] = null;
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $from = $this->input->post('financialFrom');
                $to = $this->input->post('financialTo');

                $this->data['projects'] = $this->Reports_model->get_financial_data($from, $to);

            }

            $this->render('auth/reports_financial');
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