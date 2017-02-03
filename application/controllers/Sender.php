<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sender extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index($form_slug){
        $email_config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.sparkpostmail.com',
            'smtp_port' => '587',
            'smtp_user' => 'SMTP_Injection',
            'smtp_pass' => '0fbaf437c64c77db0f09f54adc51c3615f6f3c34',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );

        $this->load->library('email', $email_config);

        $this->email->initialize($email_config); // Add

        $this->email->from('no-reply@landofweb.com');
        $this->email->to('daniel.bozieanu@gmail.com');
        $this->email->subject('testing');

        $message = base_url().'feedback/index/'.$form_slug;
        $this->email->message($message);

        if($this->email->send()) {
            $this->session->set_flashdata('mailsent', 'The form was successfuly sent!' );
            redirect('/form');
        } else {
            print_r($this->email->print_debugger());
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