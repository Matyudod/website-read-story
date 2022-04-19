<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="container text-light">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-md-offset-2">

            <!-- FLASH MESSAGES HERE -->

            <div class="panel panel-default">
                <h3 class="panel-heading text-center">ĐĂNG NHẬP</h3>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="/dang-nhap">

                        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
                            <label for="email" class="col-md-12 control-label">Email</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control bg-black text-light"
                                    placeholder="Vui lòng nhập email" name="email"
                                    value="<?= isset($old['email']) ? $this->e($old['email']) : '' ?>" required
                                    autofocus>

                                <?php if (isset($errors['email'])) : ?>
                                <span class="help-block">
                                    <strong><?= $this->e($errors['email']) ?></strong>
                                </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
                            <label for="password" class="col-md-12 control-label">Mật khẩu</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control  bg-black text-light"
                                    placeholder="Vui lòng nhập mật khẩu" name="password" required>

                                <?php if (isset($errors['password'])) : ?>
                                <span class="help-block">
                                    <strong><?= $this->e($errors['password']) ?></strong>
                                </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="/register">
                                    You are a new user?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<style>
input:focus {

    color: black !important;
}
</style>
<?php $this->stop() ?>