<?php $this->layout("layouts/admin", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>

<div class="card text-dark flex-grow-1">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title ">
            <div class="h3">Quản lý chapter : "<?= $story->story_name ?>"</div>
        </h3>
        <div>
            <a href="/quan-ly" class="btn btn-outline-primary me-2">Trở về <i class="fas fa-angle-left"></i></a>
            <a href="/quan-ly/them-chapter/<?= $story->story_slug ?>" class="btn btn-primary">Thêm chapter <i
                    class="fas fa-plus"></i></a>
        </div>


    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">

                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Chapter</th>
                            <th>Tên chapter</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_product_management">
                        <?php foreach ($eps as $ep) { ?>
                        <tr>
                            <td><?= $ep->episode  ?></td>
                            <td><?= $ep->status == 1 ? $ep->episode_name : "<b>(*) Đã bị gỡ xuống</b>" ?></td>
                            <td>
                                <a href="/quan-ly/chinh-sua-chapter/<?= $ep->slug ?>" class="btn btn-warning me-1">
                                    Sửa <i class="fas fa-cogs"></i>
                                </a>
                                <a onclick="if(confirm('Bạn có thật sự muốn gỡ  chapter này không?')) window.location.href='/quan-ly/xoa-chapter/<?= $ep->slug ?>'"
                                    class="btn btn-danger">
                                    Xóa <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Chapter</th>
                            <th>Tên chapter</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>