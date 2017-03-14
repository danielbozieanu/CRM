<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Form_model');

    }

    public function index($form_slug)
    {
        $this->data['radioAns'] = 0;
        $this->data['textareas'] = 0;
        // check if the form exists before trying to edit it
        $project = $this->Form_model->get_form_slug($form_slug);


        if ($project && !$project['form_completed']) {
            $this->data['form'] = $this->Form_model->get_form($project['form_template']);
            $this->data['project'] = $this->Form_model->get_form_slug($form_slug);

            $form_id = $this->data['form']['form_id'];

            //Get all projects
            $this->load->model('Projects_model');
            $this->data['all_projects'] = $this->Projects_model->get_all_projects_nd();

            //Get developers
            $this->data['developer'] = $this->Projects_model->get_developers($project['project_id'])->row();

            //Get all form questions
            $this->load->model('Question_model');

            $this->data['all_project_questions'] = $this->Question_model->get_project_questions($project['project_id']);

            $this->data['all_answers'] = $this->Question_model->get_project_answers($project['project_id']);

            $this->render('feedback_view', 'feedback_master');
        } else {
            //redirect to login page
            header("refresh:5;url=../../");

            $no_form_error = '<b>The form does not exists or it was already completed!</b>';
            show_error($no_form_error);
        }

    }

    public function send()
    {

        $radiosCount = $this->input->post('radiosCount');

        $radioAnswers = array();

        for ($i = 1; $i <= $radiosCount; $i++) {
            $number = 'radios' . $i;
            if ($this->input->post($number) != NULL) {
                $radioAnswers = array_merge($radioAnswers, $this->input->post($number));
            }
        }

        $this->load->library('form_validation');


        $form_slug = $this->input->post('form_slug');

        //Count answers to make sure that each question have an answer
        $answersCount = count($this->input->post('checked'));
        $minAnswers = intval($this->input->post('minAnswers'));

//        var_dump($this->form_validation->run());
//        die();

//    OLD IF    if (isset($_POST) && count($_POST) >0 && ($answersCount >= $minAnswers) && ( count($radioAnswers) == $radiosCount ) && $this->form_validation->run())

        if (isset($_POST) && count($_POST) > 0 && (count($radioAnswers) == $radiosCount)) {
            //Form Id for updating status
            $projectId = $this->input->post('project_id');

            //Checked answers
            $checked = array_merge($this->input->post('checked'), $radioAnswers);

            //Textareas answers
            $textAnswers = $this->input->post('textAreas');

//        //Base answer id
//        $answerId = $this->input->post('ansId');
//

            //Question id for textareas
            $textAreasQuestionId = $this->input->post('textareasQid');

            $this->load->model('Feedback_model');

            //Update form status
            $this->Feedback_model->update_form_status($projectId);


            //Update the answers status
            foreach ($checked as $key => $answer) {
                $this->Feedback_model->update_answers($answer);
                $answer = $this->Form_model->get_answer($answer)[0]->answer_answer;
                $this->Feedback_model->update_answers_counter($answer);
            }

            //Insert textareas answers
            $this->Feedback_model->insert_textarea_answers($textAnswers, $textAreasQuestionId, $projectId);

            redirect('feedback/succes');
        } else {
            //redirect to login page
            header("refresh:3;url=../index/" . $form_slug);

            $no_form_error = '<b>Please provide answers to (all) questions!</b> Redirect back in 3 seconds.';
            show_error($no_form_error);
        }
    }

    public function succes()
    {
        //redirect to login page
        header("refresh:5;url=../");
        $this->render('feedback_sent', 'feedback_master');
    }

    public function list_feedbacks()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        } else {

            $this->data['page_title'] = 'CRM LOW - Feedbacks';
            $this->data['page_description'] = 'Feedbacks';

            $this->load->model('Feedback_model');
            $this->load->model('Projects_model');

            $this->data['feedbacksProjects'] = $this->Feedback_model->get_feedback_text();

            $this->render('auth/feedback-list', 'master');
        }
    }


    /*
     * Render page
     */
    protected function render($the_view = NULL, $template = '')
    {
        parent::render($the_view, $template);
    }
}