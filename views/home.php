<?php $this->layout("layouts/default", ["title" => APPNAME, "categories" => $categories]) ?>

<?php $this->start("page") ?>

<div class="position-relative">
    <div class="bg-secondary d-flex my-2" style="height: fit-content;">
        <div class="bg-black  py-2 px-4 text-white h5 m-0 contentNav position-relative">
            Mới cập nhật
        </div>
    </div>
    <div class="d-flex" style="flex-wrap: wrap;">
        <?php foreach ($stories as $story) { ?>
        <div class="mx-2 my-3 movie-items" id="movie-id-2751">
            <a href="/thong-tin-truyen/<?= $story['info']->story_slug ?>" title="<?= $story['info']->story_name ?>">
                <div class="episode-latest bg-danger text-light position-absolute  p-1 text-center rounded">
                    <span><?= $story['count_ep'] . " chap" ?></span>
                </div>
                <div class="w-100 h-100">
                    <img class="w-100 h-100" src="<?= $story['info']->story_background ?>"
                        alt="<?= $story['info']->story_name ?>">
                </div>

                <div class="name-movie position-absolute">
                    <?= $story['info']->story_name ?>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
    <div class="d-flex justify-content-center p-2 scroll-bar">
        <div>
            <a href="/trang-1">Đầu</a>
            <?php if ($menu_page['active_page'] - 1 > 0) { ?>
            <a href="/trang-<?= $menu_page['active_page'] - 1 ?>" style="background: #d3b208;">Trước</a>
            <?php } ?>
            <?php for ($i = 1; $i <= $menu_page['quantily_page']; $i++) { ?>
            <a href="/trang-<?= $i ?>" class="<?= $i == $menu_page['active_page'] ? "active_page" : "" ?>"><?= $i ?></a>
            <?php } ?>
            <?php if ($menu_page['active_page'] + 1 <= $menu_page['quantily_page']) { ?>
            <a href="/trang-<?= $menu_page['active_page'] + 1 ?>" style="background: #a54f4f;">Tiếp</a>
            <?php } ?>
            <a href="/trang-<?= $menu_page['quantily_page'] ?>">Cuối</a>
        </div>
    </div>
</div>

<?php $this->stop() ?>