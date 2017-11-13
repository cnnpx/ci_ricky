<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contributorproducttype extends MY_Controller
{
	public function index()
	{
		$user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Danh sách loại cổ phần',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js','js/contributor_type.js'))
                )
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'contributorProductTypes')) {
                $this->load->model('Mcontributorproducttypes');
                $data['listContributorProductTypes'] = $this->Mcontributorproducttypes->getList(PHP_INT_MAX, 1);
                $this->load->view('contributorTypes/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
	}

    public function add()
    {
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Thêm loại cổ phần',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'contributorTypes/add')) {
                $this->load->model('Musers');
                $data['listUsers'] = $this->Musers->getList();
                $this->load->model('Mproducttypes');
                $data['listProductTypes'] = $this->Mproducttypes->getList();
                $this->load->model('Mcontributorproducttypes');
                $data['listContributors'] = $this->Mcontributorproducttypes->getListContributor();
                $this->load->view('contributorTypes/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function store()
    {
        /* Load form helper */
        $this->load->helper(array('form', 'html', 'url'));

        /* Load form validation library */
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ContributorId', 'cổ phần', 'required');
        $this->form_validation->set_rules('ProductTypeId', 'mảng kinh doanh', 'required');
        $this->form_validation->set_rules('Cost', 'số $ đóng góp', 'required');
        $this->form_validation->set_message('required', 'Cần nhập %s.');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('contributorProductTypes/add');
        }
        else {
            $postData = $this->arrayFromPost(array('ContributorId','ProductTypeId', 'Cost', 'CrUserId'));
            $this->load->model('Mcontributorproducttypes');
            $this->Mcontributorproducttypes->insert($postData);
            $this->session->set_flashdata('success', 'Tạo mới loại cổ phần thành công.');
            redirect('contributorProductTypes');
        }
    }

    public function edit($contributorTypeId= 0){
        if($contributorTypeId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật loại Cổ phần'
//                    array('scriptFooter' => array('js' => 'js/contributor.js'))
                );
                $this->load->model('Mcontributorproducttypes');
                $contributorType = $this->Mcontributorproducttypes->get($contributorTypeId);
                if ($contributorType) {
                    if($this->Mactions->checkAccess($data['listActions'], 'contributorTypeId')) {
                        $data['contributorTypeId'] = $contributorTypeId;
                        $data['contributorType'] = $contributorType;
                        $this->load->model('Musers');
                        $data['listUsers'] = $this->Musers->getList();
                        $this->load->model('Mproducttypes');
                        $data['listProductTypes'] = $this->Mproducttypes->getList();
                        $this->load->model('Mcontributorproducttypes');
                        $data['listContributors'] = $this->Mcontributorproducttypes->getListContributor();
                        $this->load->view('contributorTypes/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['contributorTypeId'] = 0;
                    $data['txtError'] = "Không tìm thấy loại Cổ phần";
                    $this->load->view('contributorTypes/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('contributorProductTypes');
    }

    public function update()
    {
        $contributorTypeId = $this->input->post('ContributorTypeId');
        $this->load->helper(array('form', 'html', 'url'));

        /* Load form validation library */
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ContributorId', 'cổ phần', 'required');
        $this->form_validation->set_rules('ProductTypeId', 'mảng kinh doanh', 'required');
        $this->form_validation->set_rules('Cost', 'số $ đóng góp', 'required');
        $this->form_validation->set_message('required', 'Cần nhập %s.');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('contributorProductTypes/edit/'.$contributorTypeId);
        }
        else {
            $postData = $this->arrayFromPost(array('ContributorId','ProductTypeId', 'Cost', 'CrUserId'));
            $this->load->model('Mcontributorproducttypes');
            $this->Mcontributorproducttypes->update($postData,$contributorTypeId);
            $this->session->set_flashdata('success', 'Cập nhật loại cổ phần thành công.');
            redirect('contributorProductTypes');
        }
    }

    public function delete()
    {
        $contributorTypeId = $this->input->post('ContributorTypeId');
        if($contributorTypeId  > 0){
            $this->load->model('Mcontributorproducttypes');
            $flag = $this->Mcontributorproducttypes->delete($contributorTypeId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa cổ phần thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

}