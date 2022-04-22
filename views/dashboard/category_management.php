<?php $this->layout("layouts/admin", ["title" => APPNAME]) ?>
<?php $this->start("page") ?>
<div class="card text-dark flex-grow-1">
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
                            <th>Mã thể loại</th>
                            <th>Tên thể loại</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_product_management">
                        <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?= $category->id ?></td>

                            <td><?= $category->category_name ?></td>

                            <td>
                                <a href="/quan-ly/sua-the-loai/<?= $category->category_slug ?>"
                                    class="btn btn-warning me-1">
                                    Sửa <i class="fas fa-cogs"></i>
                                </a>
                                <a onclick="if(confirm('Bạn có thật sự muốn gỡ thể loại truyện này không?')) window.location.href='/quan-ly/xoa-the-loai/<?= $category->category_slug ?>'"
                                    class="btn btn-danger">
                                    Xóa <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Mã thể loại</th>
                            <th>Tên thể loại</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>