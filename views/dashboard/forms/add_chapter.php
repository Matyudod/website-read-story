<?php $this->layout("layouts/admin", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<form method="POST" action="" class="flex-grow-1">

    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">

            <h3 class="text-center">Thêm chapter</h3>
            <div class="mb-3">
                <label for="story_name" class="form-label">Tên truyện</label>
                <input type="text" class="form-control" id="story_name" value="<?= $story->story_name ?>" disabled>
                <input type="text" class="form-control" name="story_id" value="<?= $story->id ?>" hidden>
            </div>
            <div class="mb-3">
                <label for="ep" class="form-label">Chapter</label>
                <input type="text" class="form-control" id="ep" value="<?= $ep ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên chapter</label>
                <input type="text" class="form-control" id="name" name="name" required
                    placeholder="Vui lòng nhập tên chapter">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung chapter</label>
                <textarea class="form-control" id="content" name="content" rows="30"
                    placeholder="Vui lòng nhập nội dung chapter" required></textarea>
            </div>
            <div class="mb-3 text-center">
                <a href="/quan-ly/danh-sach-chapter/<?= $story->story_slug ?>">
                    <button class="btn btn-outline-light" type="button">Trở lại</button>
                </a>
                <button class="btn btn-light mx-3" name="addChapter" type="submit">Thêm chapter</button>
            </div>
        </div>
        <div class="col-1">
        </div>
    </div>

</form>

<?php $this->stop() ?>