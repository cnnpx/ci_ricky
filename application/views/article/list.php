<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('article/add'); ?>" class="btn btn-default">Thêm bài viết mới</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="box box-default">
                    <?php sectionTitleHtml('Tìm kiếm'); ?>
                    <div class="box-body row-margin">
                        <?php echo form_open('article'); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" name="ArticleTitle" class="form-control" value="<?php echo set_value('ArticleTitle'); ?>" placeholder="Tên bài viết">
                            </div>
                            <div class="col-sm-3">
                                <?php $this->Mconstants->selectObject($listCategories, 'CategoryId', 'CategoryName', 'ArticleTypeId', 0, true, 'Chọn chuyên mục', ' select2') ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="Tìm kiếm">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="box box-success">
                    <?php sectionTitleHtml($title, isset($paggingHtml) ? $paggingHtml : ''); ?>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Chuyên mục</th>
                                <th>Người viết</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyArticle">
                            <?php $i = 0;
                            $itemTypes = $this->Mconstants->itemTypes;
                            $status = $this->Mconstants->status;
                            $labelCss = $this->Mconstants->labelCss;
                            foreach($listArticles as $a){
                                $i++; ?>
                                <tr id="article_<?php echo $a['ArticleId']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?php echo base_url('article/edit/'.$a['ArticleId']); ?>"><?php echo $a['ArticleTitle']; ?></a></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listCategories, 'CategoryId', $a['ArticleTypeId'], 'CategoryName'); ?></td>
                                   <td><?php echo $this->Mconstants->getObjectValue($listUsers, 'UserId', $a['CrUserId'], 'FullName'); ?></td>
                                   <td><?php echo ddMMyyyy($a['CrDateTime'], 'd/m/Y'); ?></td>
                                    <td id="statusName_<?php echo $a['ArticleId']; ?>"><span class="<?php echo $labelCss[$a['ArticleStatusId']]; ?>"><?php echo $status[$a['ArticleStatusId']]; ?></span></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $a['ArticleId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                        <div class="btn-group" id="btnGroup_<?php echo $a['ArticleId']; ?>">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-check"></i><span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <?php foreach($status as $j => $v){ ?>
                                                    <li><a href="javascript:void(0)" class="link_status" data-id="<?php echo $a['ArticleId']; ?>" data-status="<?php echo $j; ?>"><?php echo $v; ?></a></li>
                                                <?php }  ?>
                                            </ul>
                                        </div>
                                        <input type="text" hidden="hidden" id="statusId_<?php echo $a['ArticleId']; ?>" value="<?php echo $a['ArticleStatusId']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('article/changeStatus'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>