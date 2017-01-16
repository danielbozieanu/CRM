<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proiecte extends MY_Controller
{
    private $limit = 20;
    private $status ='';
    function __construct()
    {
        parent::__construct();
        $this->load->model('Proiecte_model');
        $this->load->helper(array('url','language'));
        $this->load->library('ion_auth');
        $this->data['current'] = $this->ion_auth->user()->row();

        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user)
        {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
    }

    /*
     * Listing of proiecte
     */
    function index($offset = 0, $order_column = 'id', $order_type = 'asc')
    {
        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id';
        if (empty($order_type)) $order_type = 'asc';


        //load data
        $proiecte = $this->Proiecte_model->get_all_proiecte($this->limit, $offset, $order_column, $order_type)->result();

        //generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('proiecte/index/');
        $config['total_rows'] = $this->Proiecte_model->count_all();
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
            'table_open'  => '<table class="table table-bordered">'
        );

        $this->table->set_template($template);
        $this->table->set_heading(
            '#',
            anchor('proiecte/index/'.$offset.'/nume/'.$new_order, 'Nume'),
            anchor('proiecte/index/'.$offset.'/client/'.$new_order, 'Client'),
            anchor('proiecte/index/'.$offset.'/status/'.$new_order, 'Status'),
            'Actiuni'
        );


        $i = 0 + $offset;

        foreach ($proiecte as $proiect){

            if ( $proiect->status == 1 ){
                $this->status = '<span class="label label-success">Done</span>';
            }else{
                $this->status = '<span class="label label-primary">In work</span>';
            }

            $this->table->add_row(++$i.'.',

                $proiect->nume,

                $proiect->client,

                $this->status,

                anchor('proiecte/edit/'.$proiect->id,'<i class="fa fa-eye"></i>','class="btn btn-warning btn-xs" data-skin="skin-yellow"')

            );

        }

        $this->data['table'] = $this->table->generate();

        if ($this->uri->segment(3)=='delete_success')

            $this->data['message'] = 'The Data was successfully deleted';

        else if ($this->uri->segment(3)=='add_success')

            $this->data['message'] = 'The Data has been successfully added';

        else

            $this->data['message'] = '';

    // load view

        $this->render('auth/proiecte');

    }

    /*
     * Adding a new proiecte
     */
    function add()
    {

       if ( isset($_POST) && count($_POST) >0 ){
           $params = array(
               'nume' => $this->input->post('nume'),
               'client' => $this->input->post('client')
           );

           $getUsersProiecte = $this->input->post('usersProiect');

           $paramsUsersProiecte = array();
           foreach ( $getUsersProiecte as $item ){
               array_push($paramsUsersProiecte, $item);
           }

           $proiecte_id = $this->Proiecte_model->add_proiecte($params, $paramsUsersProiecte);
           redirect('proiecte/index');
       }else{
           $this->render('auth/proiecte_add');
       }
    }

    /*
     * Editing a proiecte
     */
    function edit($id)
    {
        // check if the proiecte exists before trying to edit it
        $proiecte = $this->Proiecte_model->get_proiecte($id);

        if(isset($proiecte['id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('client_email','Client Email','valid_email');

            if($this->form_validation->run())
            {
                $params = array(
                    'nume' => $this->input->post('nume'),
                    'client' => $this->input->post('client'),
                    'status' => $this->input->post('status'),
                );

                $this->Proiecte_model->update_proiecte($id,$params);
                redirect('proiecte/index');
            }
            else
            {
                $this->data['proiecte'] = $this->Proiecte_model->get_proiecte($id);

                $this->render('auth/proiecte_edit');
            }
        }
        else
            show_error('The proiecte you are trying to edit does not exist.');
    }

    /*
     * Deleting proiecte
     */
    function remove($id)
    {
        $proiecte = $this->Proiecte_model->get_proiecte($id);

        // check if the proiecte exists before trying to delete it
        if(isset($proiecte['id']))
        {
            $this->Proiecte_model->delete_proiecte($id);
            redirect('proiecte/index');
        }
        else
            show_error('The proiecte you are trying to delete does not exist.');
    }

    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }

}
