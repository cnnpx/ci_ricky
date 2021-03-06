<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php if($articleId > 0){ ?>
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('article'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php echo form_open('article/update', array('id' => 'articleForm')); ?>
                <div class="row">
                    <div class="col-sm-8 no-padding">
                        <div class="box box-default padding15">
                            <div class="form-group">
                                <label class="control-label normal">Tiêu đề <span class="required">*</span></label>
                                <input type="text" name="ArticleTitle" class="form-control hmdrequired" id="articleTitle" value="<?php echo $article['ArticleTitle']; ?>" data-field="Tiêu đề">
                            </div>
                            <div class="form-group">
                                <label class="control-label normal">Đường dẫn</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default"><?php echo base_url('/'); ?></button>
                                    </div>
                                    <input type="text" name="ArticleSlug" class="form-control" id="articleSlug" value="<?php echo $article['ArticleSlug']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label normal">Trích dẫn</label>
                                <textarea name="ArticleLead" class="form-control"><?php echo $article['ArticleLead']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label normal">Nội dung</label>
                                <textarea name="ArticleContent" class="form-control"><?php echo $article['ArticleContent']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-default padding15">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label normal">Chuyên mục</label>
                                    <?php $this->Mconstants->selectObject($listCategories, 'CategoryId', 'CategoryName', 'CategoryId', $categoryIds, false, '', ' select2', ' multiple="multiple" data-placeholder="Chọn chuyên mục" style="width: 100%;"'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Nhãn (cách nhau bởi dấu phẩy)</label>
                                    <input type="text" class="form-control" id="tags">
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Ngày xuất bản</label>
                                    <div id="divDateTime">
                                        <div class="col-sm-6 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control datepicker" id="articleDate" value="<?php echo ddMMyyyy($article['PublishDateTime']); ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 no-padding">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control timepicker " id="articleTime" value="<?php echo ddMMyyyy($article['PublishDateTime'], 'h:i A'); ?>">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Trạng thái</label>
                                    <?php $this->Mconstants->selectConstants('status', 'ArticleStatusId', $article['ArticleStatusId']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ảnh đại diện</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" id="btnUpImage"><i class="fa fa-upload"></i> Chọn hình</button>
                                </div>
                            </div>
                            <div class="box-body">
                                <img src="<?php echo IMAGE_PATH.$article['ArticleImage']; ?>" style="width: 100%;" id="articleImage">
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('article'); ?>" id="articleListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="articleId" name="ArticleId" value="<?php echo $articleId; ?>">
                    <input type="text" hidden="hidden" id="articleTypeId" value="<?php echo $article['ArticleTypeId']; ?>">
                    <?php foreach($tagNames as $tagName){ ?>
                        <input type="text" hidden="hidden" class="tagName" value="<?php echo $tagName; ?>">
                    <?php } ?>
                </ul>
                <?php echo form_close(); ?>
            </section>
            <?php } else{ ?>
                <section class="content"><?php $this->load->view('includes/notice'); ?></section>
            <?php } ?>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>