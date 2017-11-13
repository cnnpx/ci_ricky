<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Danh sách Bài viết',
                array('scriptFooter' => array('js' => 'js/article.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'article')) {
                $data['deletearticle'] = $this->Mactions->checkAccess($listActions, 'article/delete');
                $data['changeStatus'] = $this->Mactions->checkAccess($listActions, 'article/edit');
                $this->loadModel(array('Marticles','Mcategories'));
                $data['listCategories'] = $this->Mcategories->getListByItemType(4);
                $data['listUsers'] = $this->Musers->getlist();
                $postData = $this->arrayFromPost(array('ArticleTitle', 'ArticleTypeId'));
                $rowCount = $this->Marticles->getCount($postData);
                $data['listArticles'] = array();
                if($rowCount > 0){
                    $perPage = 20;
                    $pageCount = ceil($rowCount / $perPage);
                    $page = $this->input->post('PageId');
                    if(!is_numeric($page) || $page < 1) $page = 1;
                    $data['listArticles'] = $this->Marticles->search($postData, $perPage, $page);
                    $data['paggingHtml'] = getPaggingHtml($page, $pageCount);
                }
                $this->load->view('article/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Thêm Bài viết',
                array(
                    'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                    'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/article_update.js')))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($data['listActions'], 'article/add')) {
                $this->load->model('Mcategories');
                $data['listCategories'] = $this->Mcategories->getListByItemType(4);
                $this->load->view('article/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($articleId){
        if($articleId > 0){
            $user = $this->session->userdata('user');
            if($user) {
                $data = $this->commonData($user,
                    'Cật nhật Bài viết',
                    array(
                    'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                    'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/article_update.js')))
                );
                $listActions = $data['listActions'];
                if($this->Mactions->checkAccess($data['listActions'], 'article/edit')) {
                    $this->loadModel(array('Marticles','Mcategories', 'Mtags', 'Mcategoryitems'));
                    $article = $this->Marticles->get($articleId);
                    $data['listCategories'] = $this->Mcategories->getListByItemType(4);
                    if($article) {
                        $data['articleId'] = $articleId;
                        $data['article'] = $article;
                        $data['categoryIds'] = $this->Mcategoryitems->getCateIds($articleId, 4);
                        $data['tagNames'] = $this->Mtags->getTagNames($articleId, 4);
                    }
                    else{
                        $data['articleId'] = 0;
                        $data['txtError'] = "Không tìm thấy Bài viết";
                    }
                    $this->load->view('article/edit', $data);
                }
                else $this->load->view('user/permission', $data);
            }
            else redirect('user');
        }
        else redirect('article');
    }

    public function update(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('ArticleTitle', 'ArticleSlug', 'ArticleLead', 'ArticleContent', 'ArticleTypeId', 'ArticleStatusId', 'ArticleImage'));
            if(empty($postData['ArticleSlug'])) $postData['ArticleSlug'] = makeSlug($postData['ArticleTitle']);
            else $postData['ArticleSlug'] = makeSlug($postData['ArticleSlug']);
            $postData['ArticleImage'] = replaceFileUrl($postData['ArticleImage']);
            $articleId = $this->input->post('ArticleId');
            $crDateTime = getCurentDateTime();
            if($articleId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $publishDateTime = trim($this->input->post('PublishDateTime'));
                if(!empty($publishDateTime)) $postData['PublishDateTime'] = $publishDateTime;
                else $postData['PublishDateTime'] = $crDateTime;
            }
            $this->load->model('Marticles');
            $categoryIds = json_decode(trim($this->input->post('CategoryIds')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $articleId = $this->Marticles->update($postData, $articleId, $categoryIds, $tagNames);
            if ($articleId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật Bài viết thành công", 'data' => $articleId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatus(){
        $articleId = $this->input->post('ArticleId');
        $statusId = $this->input->post('StatusId');
        if($articleId > 0 && $statusId >= 0 && $statusId <= count($this->Mconstants->status)) {
            $this->load->model('Marticles');
            $flag = $this->Marticles->changeStatus($statusId, $articleId, 'ArticleStatusId');
            if($flag) {
                $txtSuccess = "";
                $statusName = "";
                if($statusId == 0) $txtSuccess = "Xóa Bài viết thành công";
                else{
                    $txtSuccess = "Đổi trạng thái thành công";
                    $statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->status[$statusId] . '</span>';
                }
                echo json_encode(array('code' => 1, 'message' => $txtSuccess, 'data' => array('StatusName' => $statusName)));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}