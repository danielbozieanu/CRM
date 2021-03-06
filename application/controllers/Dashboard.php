<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CRM LOW - Dashboard';
        $this->data['page_description'] = 'Dashboard';
        $this->load->model('Projects_model');
        $this->load->model('Agency_model');
        $this->data['projectsCount'] = count($this->Projects_model->get_all_projects_nd());
        $this->data['agenciesCount'] = count($this->Agency_model->get_all_agencies_np());
        $this->data['inWork'] = $this->data['projectsCount'] - count($this->Projects_model->get_all_projects_done());

        $group_id = 2; //your group id in database
        $this->data['clientsNumber'] = count($this->ion_auth->users($group_id)->result_array());

    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $this->render('auth/dashboard');
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