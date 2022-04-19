<?php $this->layout("layouts/admin", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>

<div class="card text-dark">
    <div class="card-header">
        <h3 class="card-title ">
            <div class="h3">Quản lý truyện</div>
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">

                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã truyện</th>
                            <th>Poster</th>
                            <th>Tên truyện</th>
                            <th>Thể loại</th>
                            <th>Số chapter</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_product_management">
                        <?php foreach ($stories as $story) { ?>
                        <tr>
                            <td><?= $story['info']->id ?></td>
                            <td>
                                <img src="<?= $story['info']->story_background ?>"
                                    alt="<?= $story['info']->story_name ?>" width="150" height="200">
                            </td>
                            <td><?= $story['info']->story_name ?></td>
                            <td>
                                <?php
                                    foreach ($story['categories'] as $category) {
                                        echo $category . "<br>";
                                    }
                                    ?>
                            </td>
                            <td><?= $story['quantily_ep'] ?></td>
                            <td>
                                <a href="/quan-ly/danh-sach-chapter/<?= $story['info']->story_slug ?>"
                                    class="btn btn-success mb-1">
                                    Danh sách chapter <i class="fas fa-list"></i>
                                </a>
                                <br>
                                <a href="/quan-ly/chinh-sua-truyen/<?= $story['info']->story_slug ?>"
                                    class="btn btn-warning me-1">
                                    Sửa <i class="fas fa-cogs"></i>
                                </a>
                                <a href="/quan-ly/xoa-truyen/<?= $story['info']->story_slug ?>" class="btn btn-danger">
                                    Xóa <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Mã truyện</th>
                            <th>Poster</th>
                            <th>Tên truyện</th>
                            <th>Thể loại</th>
                            <th>Số chapter</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>