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
        // check if the form exists before trying to edit it
        $form = $this->Form_model->get_form_slug($form_slug);

        if ($form && $form['form_status']!=1){
            $this->data['form'] = $this->Form_model->get_form_slug($form_slug);

            $form_id = $this->data['form']['form_id'];

            //Get all projects for select option
            $this->load->model('Projects_model');
            $this->data['all_projects'] = $this->Projects_model->get_all_projects_nd();

            //Get all form questions
            $this->load->model('Question_model');
            $this->data['all_questions'] = $this->Question_model->get_all_questions($form_id);

            $this->data['all_answers'] = $this->Question_model->get_answers();

            $this->render('feedback');
        } else{
            //redirect to login page
            header( "refresh:5;url=../../");

            $no_form_error = '<b>The form does not exists or it was already completed!</b>';
            show_error($no_form_error);
        }

    }

    public function send(){

        $radiosCount = $this->input->post('radiosCount');

        $radioAnswers = array();

        for( $i=1; $i<=$radiosCount; $i++){
            $number = 'radios'.$i;
            if ($this->input->post($number)!= NULL) {
            $radioAnswers = array_merge($radioAnswers, $this->input->post($number));
            }
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('checked[]', 'answer', 'required');

        $form_slug = $this->input->post('form_slug');

        //Count answers to make sure that each question have an answer
        $answersCount = count($this->input->post('checked'));
        $minAnswers = $this->input->post('minAnswers');

        if (isset($_POST) && count($_POST) >0 && ($answersCount >= $minAnswers) && ( count($radioAnswers) == $radiosCount ) && $this->form_validation->run()){
        //Form Id for updating status
        $form_id = $this->input->post('form_id');

        //Checked answers
        $checked = array_merge($this->input->post('checked'),$radioAnswers);

        $this->load->model('Feedback_model');

        //Update form status
        $this->Feedback_model->update_form_status($form_id);

        //Update the answers status
        foreach ( $checked as $answer){
            $this->Feedback_model->update_answers($answer);
        }

        redirect('feedback/succes');
        } else{
            //redirect to login page
            header( "refresh:3;url=../index/".$form_slug);

            $no_form_error = '<b>Please provide answers to (all) questions!</b> Redirect back in 3 seconds.';
            show_error($no_form_error);
        }
    }

    public function succes(){
        //redirect to login page
        header( "refresh:5;url=../");
        $this->render('feedback_sent');
    }


//    /*
//     * Render page
//     */
//    protected function render($the_view = NULL, $template = '')
//    {
//        parent::render($the_view, $template);
//    }
}