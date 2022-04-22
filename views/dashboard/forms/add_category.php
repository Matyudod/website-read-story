<?php $this->layout("layouts/admin", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<form method="POST" action="" class="flex-grow-1">

    <div class="row" style="height:450px">
        <div class="col-2">
        </div>
        <div class="col-8">

            <h3 class="text-center">Thêm thể loại truyện</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Tên loại truyện</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3 text-center">
                <a href="/quan-ly/quan-ly-the-loai">
                    <button class="btn btn-outline-light" type="button">Trở lại</button>
                </a>
                <button class="btn btn-light mx-3" name="addCategory" type="submit">Thêm thể loại</button>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>

</form>

<?php $this->stop() ?>