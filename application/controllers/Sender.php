<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sender extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('Projects_model');
    }

    function index($project_id, $form_slug, $userId)
    {

        //Current project
        $project = $this->Projects_model->get_project($project_id);

        $email_config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sparkpostmail.com',
            'smtp_port' => '587',
            'smtp_user' => 'SMTP_Injection',
            'smtp_pass' => '0fbaf437c64c77db0f09f54adc51c3615f6f3c34',
            'mailtype' => 'html',
            'starttls' => true,
            'newline' => "\r\n"
        );

        $user = $this->ion_auth->user($userId)->row();

        $this->load->library('email', $email_config);

        $this->email->initialize($email_config); // Add

        $this->email->from('no-reply@landofweb.com');
        $this->email->to($user->email);
        $this->email->subject('LOW CRM Feedback'); // replace it with relevant subject

        $data = array(
            'form_slug' => base_url() . 'feedback/index/' . $form_slug
        );

        //Load email template from HTML
        $body = $this->load->view('templates/email_template.php', $data, TRUE);

        //Send the email
        $this->email->message($body);

        if ($this->email->send()) {

            //Check if has reminder already
            if (!$project->reminder) {
                //Set reminder active to project
                $this->Projects_model->update_projects($project_id, array(
                    'reminder' => 1
                ));

                //Add new reminder in database
                $this->Projects_model->add_reminder($project_id);
            }

            $this->session->set_flashdata('mailsent', 'The form was successfuly sent!');
            redirect('/projects');
        } else {
            print_r($this->email->print_debugger());
        }

    }

    /*
     * Send reminder
     */
    function reminder()
    {
        //Current project
        $projects = $this->Projects_model->get_all_projects_done();

        foreach ($projects as $project) {


            $reminder = $this->Projects_model->get_reminder($project['project_id']);



            if ($reminder && $project['project_status'] == 1 && $project['form_template'] && !$project['form_completed'] && $reminder->count < 5) {

                $reminderCount = $reminder->count;

                $email_config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.sparkpostmail.com',
                    'smtp_port' => '587',
                    'smtp_user' => 'SMTP_Injection',
                    'smtp_pass' => '0fbaf437c64c77db0f09f54adc51c3615f6f3c34',
                    'mailtype' => 'html',
                    'starttls' => true,
                    'newline' => "\r\n"
                );


                $this->load->library('email', $email_config);

                $this->email->initialize($email_config); // Add

                $this->email->from('no-reply@landofweb.com');
                $this->email->to('daniel.bozieanu@gmail.com');
                $this->email->subject('LOW CRM Reminder'); // replace it with relevant subject


                //Load email template from HTML
                $body = 'Reminder to project ' . $project['project_name'];

                //Send the email
                $this->email->message($body);

                if ($this->email->send()) {

                    //Check if has reminder already
                    if ($reminder && $reminder->count < 5) {

                        //Update reminder status
                        $this->Projects_model->update_reminder($project['project_id'], $reminderCount + 1);
                    }

                    $this->session->set_flashdata('mailsent', 'The form was successfuly sent!');
                } else {
                    print_r($this->email->print_debugger());
                }

            }
        }

    }

    /*
     * Render page
     */

    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }
}