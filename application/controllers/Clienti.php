<?php

class Clienti extends MY_Controller
{
    private $limit = 20;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Clienti_model');
    }

    /*
     * Listing of clienti
     */
    function index($offset = 0, $order_column = 'id_client', $order_type = 'asc')
    {
        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id';
        if (empty($order_type)) $order_type = 'asc';

        //load data
        $clienti = $this->Clienti_model->get_all_clienti($this->limit, $offset, $order_column, $order_type)->result();

        //generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('proiecte/index/');
        $config['total_rows'] = $this->Clienti_model->count_all();
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
            'table_open' => '<table class="table table-bordered">'
        );

        $this->table->set_template($template);
        $this->table->set_heading(
            anchor('clienti/index/' . $offset . '/id_client/' . $new_order, '#'),
            anchor('clienti/index/' . $offset . '/nume_client/' . $new_order, 'Nume'),
            anchor('clienti/index/' . $offset . '/email_client/' . $new_order, 'Email'),
            anchor('clienti/index/' . $offset . '/tel/' . $new_order, 'Telefon'),
            [
                'data' => 'Actiuni',
                'colspan' => 2,
                'style' => 'width:5%'
            ]
        );


        $i = 0 + $offset;

        foreach ($clienti as $client) {


            $this->table->add_row(++$i . '.',

                $client->nume_client,

                $client->email_client,

                $client->tel,

                anchor('clienti/edit/' . $client->id_client, '<i class="fa fa-eye"></i>', 'class="btn btn-warning btn-xs" data-skin="skin-yellow"'),
                anchor('clienti/remove/' . $client->id_client, '<i class="fa fa-trash-o"></i>', 'class="btn btn-danger btn-xs" data-skin="skin-yellow"')

            );

        }

        $this->data['table'] = $this->table->generate();

        if ($this->uri->segment(3) == 'delete_success')

            $this->data['message'] = 'The Data was successfully deleted';

        else if ($this->uri->segment(3) == 'add_success')

            $this->data['message'] = 'The Data has been successfully added';

        else

            $this->data['message'] = '';

        // load view

        $this->render('auth/clienti');

    }

    /*
     * Adding a new clienti
     */
    function add()
    {
        if ($this->ion_auth->is_admin()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', ['valid_email', 'required']);
            $this->form_validation->set_rules('nume', 'Nume', ['required']);
            $this->form_validation->set_rules('tel', 'Telefon', ['required']);


            if ($this->form_validation->run()) {
                $params = array(
                    'nume_client' => $this->input->post('nume'),
                    'email_client' => $this->input->post('email'),
                    'tel' => $this->input->post('tel'),
                );

                $clienti_id = $this->Clienti_model->add_clienti($params);
                redirect('clienti/index');
            } else {
                $this->render('auth/clienti_add');
            }
        }
    }

    /*
     * Editing a clienti
     */
    function edit($id)
    {
        // check if the clienti exists before trying to edit it
        $clienti = $this->Clienti_model->get_clienti($id);

        if (isset($clienti['id_client']) && $this->ion_auth->is_admin()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'valid_email');

            if ($this->form_validation->run()) {
                $params = array(
                    'nume_client' => $this->input->post('nume'),
                    'email_client' => $this->input->post('email'),
                    'tel' => $this->input->post('tel'),
                );

                $this->Clienti_model->update_clienti($id, $params);
                redirect('clienti');
            } else {
                $this->data['clienti'] = $this->Clienti_model->get_clienti($id);

                $this->render('auth/clienti_edit');
            }
        } else
            show_error('The clienti you are trying to edit does not exist or you are not administrator.');
    }

    /*
     * Deleting clienti
     */
    function remove($id)
    {

        $clienti = $this->Clienti_model->get_clienti($id);

        // check if the clienti exists before trying to delete it
        if (isset($clienti['id']) && $this->ion_auth->is_admin()) {
            $this->Clienti_model->delete_clienti($id);
            redirect('clienti');
        } else
            show_error('The clienti you are trying to delete does not exist or you are not administrator.');
    }

    protected function render($the_view = NULL, $template = 'master')
    {
        parent::render($the_view, $template);
    }

}
