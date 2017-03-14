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
    }


    function get_data($form)
    {
        header('Content-Type: application/json');
        print_r($this->Reports_model->get_data($form));
    }

    function get_agency_data($form)
    {
        header('Content-Type: application/json');
        print_r($this->Reports_model->get_agency_data($form));

    }

    function get_client_data($client)
    {
        header('Content-Type: application/json');
        print_r($this->Reports_model->get_client_data($client));

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

    function client()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->render('auth/reports_client');
        }
    }

    /*
     * Render page function
     */
    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }

}