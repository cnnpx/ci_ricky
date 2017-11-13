<div class="box box-default padding15">
    <div class="box-header with-border">
        <h3 class="box-title">Lịch sử</h3>
    </div>
    <div class="box-body">
        <ul class="timeline">
            <?php foreach ($listActionLogs as $al) {?>
                <li class="time-label">
                    <span class="bg-blue"><?php echo ddMMyyyy($al['CrDateTime']); ?></span>
                </li>
                <li>
                    <i class="fa fa-user bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo ddMMyyyy($al['CrDateTime'], 'H:i'); ?></span>
                        <h3 class="timeline-header"><?php echo $al['Comment']; ?></h3>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>