<?php $this->layout("layouts/admin", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<form method="POST" action="" enctype="multipart/form-data" class="flex-grow-1">

    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-8">

            <h3>Chỉnh sửa truyện: "<?= $story->story_name ?>"</h3>

            <div class="mb-3">
                <label for="id" class="form-label">Mã truyện</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= $story->id ?>" disabled>
                <input type="text" class="form-control" id="id" name="id" value="<?= $story->id ?>" hidden required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Tên truyện</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $story->story_name ?>" required
                    placeholder="Vui lòng nhập tên truyện">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Thể loại</label>
                <select id="category" class="form-select" onchange="add_category(this,categories,categories_show)">
                    <option value="">---Chọn thể loại---</option>
                    <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->category_name ?>"><?= $category->category_name ?></option>
                    <?php } ?>
                </select>
                <textarea class="form-control" name="categories" id="categories" required
                    hidden><?= $genre ?></textarea>

            </div>
            <div class="mb-3" id="categories_show">

            </div>
            <div class="mb-3">
                <label for="decription" class="form-label">Tóm tắt truyện</label>
                <textarea class="form-control" id="decription" name="decription" rows="6"
                    placeholder="Vui lòng nhập tóm tắt truyện" required><?= $story->story_description ?></textarea>
            </div>

            <div class="form-check form-switch m-3">
                <input class="form-check-input" type="checkbox" role="switch" id="use_link" name="use_link"
                    onchange="useLink(this)" checked>
                <label class="form-check-label" for="use_link">Sử dụng link</label>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link poster truyện</label>
                <input type="text" class="form-control" id="link" name="link" value="<?= $story->story_background ?>"
                    required onblur="useLink(use_link)" placeholder="Vui lòng nhập link poster truyện">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload poster truyện</label>
                <input type="file" class="form-control" id="image" name="image[]" onchange="useLink(use_link)">
            </div>
            <div class="mb-3 text-center">
                <a href="/quan-ly/quan-ly-truyen">
                    <button class="btn btn-outline-light" type="button">Trở lại</button>
                </a>
                <button class="btn btn-light mx-3" name="updateStory" type="submit">Chỉnh sửa truyện</button>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex h-100">
                <img src="<?= $story->story_background ?>" id="poster" width="220" height="330" class="m-auto border"
                    alt="Poster truyện">
            </div>
            <script>
            update_categories(categories, categories_show)
            </script>
        </div>
    </div>

</form>

<?php $this->stop() ?>