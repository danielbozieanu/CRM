<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proiecte extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Proiecte_model');
        $this->load->helper(array('url','language'));
        $this->load->library('ion_auth');
        $this->data['current'] = $this->ion_auth->user()->row();

    }

    /*
     * Listing of proiecte
     */
    function index()
    {
        $this->data['proiecte'] = $this->Proiecte_model->get_all_proiecte();

        $projectsCount = sizeof($this->data['proiecte']);

        $this->load->library('pagination');

        $this->load->helper('url');

        $config['base_url']=site_url('proiecte/page/');

        $config['total_rows']= $projectsCount;

        $config['per_page']=5;

        $this->pagination->initialize($config);

        echo $this->pagination->create_links();


        $this->pagination->initialize($config);

        echo $this->pagination->create_links();





        $this->render('auth/proiecte');
    }

    /*
     * Adding a new proiecte
     */
    function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('client_email','Client Email','valid_email');

        if($this->form_validation->run())
        {
            $params = array(
                'nume' => $this->input->post('nume'),
                'client' => $this->input->post('client'),
                'client_email' => $this->input->post('client_email'),
                'echipa' => $this->input->post('echipa'),
                'status' => $this->input->post('status'),
            );

            $proiecte_id = $this->Proiecte_model->add_proiecte($params);
            redirect('proiecte/index');
        }
        else
        {
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
                    'client_email' => $this->input->post('client_email'),
                    'echipa' => $this->input->post('echipa'),
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
