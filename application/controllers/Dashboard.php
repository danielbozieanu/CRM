<?php
class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CRM LOW - Dashboard';
        $this->data['page_description'] = 'Dashboard';
        $this->load->model('Projects_model');
        $this->data['projectsCount'] = count($this->Projects_model->get_all_projects_nd());
    }

    public function index()
    {
        $this->render('auth/dashboard');
    }

    /*
     * Render page
     */

    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }
}