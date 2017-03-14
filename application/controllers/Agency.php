<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agency extends MY_Controller
{
    private $limit = 20;


    function __construct()
    {
        parent::__construct();
        $this->load->model('Agency_model');
        $this->data['page_title'] = 'CRM LOW - Agencies';
        $this->data['page_description'] = 'Agencies administration';
        $this->load->helper(array('url','language'));
        $this->load->library('ion_auth');
        $this->load->helper('string');
    }

    /*
     * Listing of agencies
     */
    function index($offset = 0, $order_column = '', $order_type = 'asc')
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {
            if (empty($offset)) $this->data['offset'] = $offset = 0;
            if (empty($order_column)) $order_column = 'id';
            if (empty($order_type)) $order_type = 'asc';
            $this->data['noAgencies'] = '';

            $this->data['new_order'] = ($order_type == 'asc' ? 'desc' : 'asc');


            //load data
            $this->data['agencies'] = $this->Agency_model->get_all_agencies($this->limit, $offset, $order_column, $order_type)->result_array();

            $this->render('auth/agencies');
        }
    }

    /*
     * Adding a new agency
     */
    function add()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $params = array(
                'agency_name' => $this->input->post('agency_name'),
                'agency_type' => $this->input->post('agency_type'),
                'agency_start_date' => $this->input->post('agency_start_date'),
            );

            $agency_id = $this->Agency_model->add_agency($params);
            redirect('agency/index');
        }
        else
        {
            $this->render('auth/agency_add');
        }
    }

    /*
     * Editing a agency
     */
    function edit($id)
    {
        // check if the agency exists before trying to edit it
        $this->data['agency'] = $this->Agency_model->get_agency($id);


        if(isset($this->data['agency']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)
            {
                $params = array(
                    'agency_name' => $this->input->post('agency_name'),
                    'agency_type' => $this->input->post('agency_type'),
                    'agency_start_date' => $this->input->post('agency_start_date'),
                );

                $this->Agency_model->update_agency($id,$params);
                redirect('agency');
            }
            else
            {
                $this->render('auth/agency_edit');
            }
        }
        else
            show_error('The agency you are trying to edit does not exist.');
    }

    /*
     * Deleting agency
     */
    function remove($id)
    {
        $agency = $this->Agency_model->get_agency($id);

        // check if the agency exists before trying to delete it
        if(isset($agency['id']))
        {
            $this->Agency_model->delete_agency($id);
            redirect('agency/index');
        }
        else
            show_error('The agency you are trying to delete does not exist.');
    }

    /*
     * Render page
     */

    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }

}