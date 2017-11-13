<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contributors extends MY_Controller
{
    public function index()
    {
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Danh sách Cổ phần',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/contributor.js'))
                )
            );
            $listActions = $data['listActions'];
            if ($this->Mactions->checkAccess($listActions, 'contributors')) {
                $data['updateContributors'] = $this->Mactions->checkAccess($listActions, 'contributors/update');
                $data['deleteContributors'] = $this->Mactions->checkAccess($listActions, 'contributors/delete');
                $this->load->model('Mcontributors');
                $data['listContributors'] = $this->Mcontributors->get();
                $this->load->view('contributors/list', $data);
            } else $this->load->view('user/permission', $data);
        } else redirect('user');
    }

    public function add()
    {
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Thêm Cổ phần',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/contributor.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'contributors/add')) {
                $this->load->view('contributors/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($contributorId)
    {
        if($contributorId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật cổ phần',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/contributor.js'))
                    )
                );
                $this->load->model('Mcontributors');
                $contributor = $this->Mcontributors->get($contributorId);
                if ($contributor) {
                    if($this->Mactions->checkAccess($data['listActions'], 'contributorId')) {
                        $data['contributorId'] = $contributorId;
                        $data['contributor'] = $contributor;
                        $this->load->view('contributors/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['contributorId'] = 0;
                    $data['txtError'] = "Không tìm thấy Cổ phần";
                    $this->load->view('contributors/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('contributors');
    }

    public function update()
    {
        $user = $this->session->userdata('user');
        $postData = $this->arrayFromPost(array('ContributorName', 'ContributorPhone', 'BirthDay', 'Address'));
        $contributorId = $this->input->post('ContributorId');
        if (!empty($postData['ContributorName'])) {
            $this->load->model('Mcontributors');
            if ($this->Mcontributors->checkExist($contributorId, $postData['ContributorName'])) {
                echo json_encode(array('code' => -1, 'message' => "Tên cổ phần đã tồn tại trong hệ thống"));
            } else {
                $postData['BirthDay'] = ddMMyyyyToDate($postData['BirthDay']);
                $contributorId = $this->Mcontributors->update($postData, $contributorId);
                if ($contributorId > 0) {
                    echo json_encode(array('code' => 1, 'message' => "Cập nhật cổ phần thành công", 'data' => $contributorId));
                } else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
        } else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete()
    {
        $contributorId = $this->input->post('ContributorId');
        if($contributorId  > 0){
            $this->load->model('Mcontributors');
            $flag = $this->Mcontributors->delete($contributorId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa cổ phần thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}