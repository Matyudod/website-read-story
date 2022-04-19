<?php $this->layout("layouts/default", ["title" => APPNAME, "categories" => $categories]) ?>

<?php $this->start("page") ?>

<div class="p-4 rounded-top">
    <h1 class="h2 text-white text-center bg-secondary m-0 p-2 rounded-top"><?= $stories['info']->story_name ?></h1>
    <div class="border-top d-flex text-white inforAV rounded-bottom">
        <div class="px-5">
            <img class="border" src="<?= $stories['info']->story_background ?>"
                alt="<?= $stories['info']->story_name ?>" width="220" height="330">
        </div>
        <div class="d-flex flex-column tableInfo flex-fill">

            <div class="name_other">
                <div>Tên khác</div>
                <div><?= $stories['info']->story_name ?> </div>
            </div>
            <div class="list_cate">
                <div>Thể loại</div>
                <div>
                    <?php foreach ($stories['categories'] as $category) { ?>
                    <a href="/the-loai/<?= $category->category_slug ?>">
                        <?= $category->category_name ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="status">
                <div>Trạng thái</div>
                <div>
                    <?= $stories['info']->status == 1 ? "Đang tiến hành" : ($stories['info']->status == 2 ? "Đã hoàn thành" : "Đã Drop") ?>
                </div>
            </div>
            <div class="update_time">
                <div>Phát hành</div>
                <div>
                    <?= date_format(date_create($stories['info']->created_at), "Y"); ?> </div>
            </div>
            <div class="duration">
                <div>Số chapter</div>
                <div>
                    <?= $stories['count_ep'] . " chapter" ?> </div>
            </div>
        </div>
    </div>
    <div class="d-flex rounded p-2 my-4 btnControl justify-content-between">
        <div class="d-flex">
            <a href="<?= $stories['count_ep'] != 0 ? "/doc-truyen/" . $stories['eps'][0]->slug : "" ?>"
                class="btn btn-success m-2 rounded text-light" title="Xem Ngay">
                Xem từ đầu
            </a>
            <a href="<?= $stories['count_ep'] != 0 ? "/doc-truyen/" . $stories['eps'][$stories['count_ep'] - 1]->slug : "" ?>"
                class="btn btn-warning m-2 rounded" title="Xem Ngay">
                Xem chapter mới nhất
            </a>
        </div>

    </div>

    <div class="d-flex epAV">
        <div class="w-25 p-3 m-3 btnControl rounded text-light">
            <div class="h3">
                Danh sách tập
            </div>
            <div class="border-top scroll-bar pt-3">
                <?php foreach ($stories['eps'] as $ep) { ?>
                <a href="/doc-truyen/<?= $ep->slug ?>" style="width: 40px;" class="px-0 text-center"
                    title="Chapter <?= $ep->episode ?>">
                    <span><?= $ep->episode ?> </span>
                </a>
                <?php } ?>
            </div>
        </div>
        <div class="w-25 p-3 m-3 flex-grow-1 btnControl rounded text-light">
            <div class="h3">
                Nội dung
            </div>
            <div class="border-top pt-3 contentAV">
                <?= $stories['info']->story_description ?>
            </div>
        </div>
    </div>

</div>

<?php $this->stop() ?>