<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends MY_Controller
{
    private $limit = 20;
    private $status ='';
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CRM LOW - Projects';
        $this->data['page_description'] = 'Projects administration';
        $this->load->model('Projects_model');
        $this->load->helper(array('url','language'));
        $this->load->library('ion_auth');

        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user)
        {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
    }

    /*
     * Listing of projects
     */
    function index($offset = 0, $order_column = 'project_id', $order_type = 'asc')
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else{
        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id';
        if (empty($order_type)) $order_type = 'asc';
        $this->data['noProjects'] = '';


        //load data
        $projects = $this->Projects_model->get_all_projects($this->limit, $offset, $order_column, $order_type)->result();

        //generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('projects/index/');
        $config['total_rows'] = $this->Projects_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("");
        $new_order = ($order_type == 'asc' ? 'desc' : 'asc');
        $template = array(
            'table_open'  => '<table class="table table-bordered table-hover">'
        );

        $this->table->set_template($template);
        $this->table->set_heading(
            anchor('projects/index/'.$offset.'/project_id/'.$new_order,'#'),
            anchor('projects/index/'.$offset.'/project_name/'.$new_order, 'Project name'),
            anchor('projects/index/'.$offset.'/project_client/'.$new_order, 'Client name'),
            anchor('projects/index/'.$offset.'/project_status/'.$new_order, 'Status'),
            [
                'data' => 'Actiuni',
                'colspan' => 2,
                'style' => 'width:5%'
            ]
        );


        $i = 0 + $offset;

        if ( $projects ){

        foreach ($projects as $project){

            if ( $project->project_status == 1 ){
                $this->status = '<span class="label label-success">Done</span>';
            }else{
                $this->status = '<span class="label label-primary">In work</span>';
            }

            //Id of the project
            $projectClientId = $project->project_client;

            //Get the client of the project
            $client = $this->ion_auth->user($projectClientId)->row();

            $this->table->add_row($project->project_id.'.',

                $project->project_name,

                $client->first_name,

                $this->status,

                anchor('projects/edit/'.$project->project_id,'<i class="fa fa-pencil"></i>','class="btn btn-primary btn-xs" data-skin="skin-yellow"'),

               '<a href=""  class="btn btn-danger btn-xs" data-toggle="modal" onclick="confirm_modal(\''.site_url('projects/remove/'.$project->project_id).'\',\'Title\')" > <i class="fa fa-trash-o"></i>  </a>'
            );

        }
        } else {
            $this->data['noProjects'] = 'There are no projects yet!';
        }

        $this->data['table'] = $this->table->generate();

        if ($this->uri->segment(3)=='delete_success')

            $this->data['message'] = 'The Data was successfully deleted';

        else if ($this->uri->segment(3)=='add_success')

            $this->data['message'] = 'The Data has been successfully added';

        else

            $this->data['message'] = '';

        // load view
        $this->render('auth/projects');
        }
    }

    /*
     * Adding a new projects
     */
    function add()
    {
        //DEVELOPERS
       $this->data['developers'] = $this->Projects_model->getDevelopers();

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            //Get clients - group with id 2 (account)
            $this->data['clients'] = $this->ion_auth->users(2)->result();

            $this->load->library('form_validation');
            $this->form_validation->set_rules('project_name', 'Name', 'required',
                array('required' => 'Please type a name for project')
            );
            $this->form_validation->set_rules('project_client', 'Client', 'required|greater_than[0]',
                array('greater_than' => 'Please select a client')
            );
            $this->form_validation->set_rules('project_start_date', 'Start project date', 'required',
                array('required' => 'Please insert start date for project')
            );

            //Verify if we have POST and if the form is validated
            if (isset($_POST) && count($_POST) > 0 && $this->form_validation->run()) {
                $params = array(
                    'project_name' => $this->input->post('project_name'),
                    'project_client' => $this->input->post('project_client'),
                    'project_created' => $this->input->post('project_start_date'),
                    'project_estimate' => $this->input->post('project_estimation'),
                    'project_final_client'  => $this->input->post('project_final_client'),
                    'project_value' =>  $this->input->post('project_value'),
                    'project_costs' =>  $this->input->post('project_costs')
                );

                //Get developers assigned to project
                $developersInput = $this->input->post('developerToProject');

                $this->Projects_model->add_projects($params, $developersInput);
                redirect('projects/index');
            } else {
                $this->render('auth/projects_add');
            }
        }
    }

    /*
     * Editing a projects
     */
    function edit($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            // check if the projects exists before trying to edit it
            $project = $this->Projects_model->get_project($id);

            $this->data['developersToProject'] = $this->Projects_model->get_developers($id)->result();

            if (isset($project['project_id']) && $this->ion_auth->is_admin()) {
                if (isset($_POST) && count($_POST) > 0) {
                    $params = array(
                        'project_name' => $this->input->post('nume'),
                        'project_status' => $this->input->post('status'),
                    );

                    $this->Projects_model->update_projects($id, $params);
                    redirect('projects/index');
                } else {
                    //Get the form for project
                    $this->load->model('Form_model');
                    $this->data['form'] = $this->Form_model->get_project_form($id);

                    //Get all form questions
                    $this->load->model('Question_model');
                    $this->data['all_questions'] = $this->Question_model->get_all_questions($this->data['form']['form_id']);

                    $this->data['all_answers'] = $this->Question_model->get_answers();

                    $this->data['projects'] = $this->Projects_model->get_project($id);
                    $this->render('auth/projects_edit');
                }
            } else
                show_error('The projects you are trying to edit does not exist or you are not administrator.');
        }
    }

    /*
     * Deleting projects
     */
    function remove($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            $projects = $this->Projects_model->get_project($id);

            // check if the projects exists before trying to delete it
            if (isset($projects['project_id']) && $this->ion_auth->is_admin()) {
                $this->Projects_model->delete_projects($id);
                redirect('projects/index');
            } else
                show_error('The projects you are trying to delete does not exist or you are not administrator.');
        }
    }

    /*
     * Render page
     */

    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }



//    //Return all available project_clients
//   function getAllproject_clients(){
//        if (empty($offset)) $offset = 0;
//        if (empty($order_column)) $order_column = 'id_project_client';
//        if (empty($order_type)) $order_type = 'asc';
//
//       $this->load->model('project_clienti_model');
//
//       $availableproject_clients = $this->project_clienti_model->get_all_project_clienti($this->limit, $offset, $order_column, $order_type)->result();
//
//       return $availableproject_clients;
//
//    }
}
