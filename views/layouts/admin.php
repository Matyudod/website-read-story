<!DOCTYPE html>
<html lang="en">

<?php require_once "views/blocks/head-admin.php" ?>

<body>
    <style>
    #example2_filter label {
        display: flex;
        align-items: center;
    }
    </style>
    <div class="app">
        <div class="container-fluid bg-black">
            <?php require_once "views/blocks/header-admin.php" ?>

            <main class="container-fluid bg-dark pt-2 border-top">
                <div class="d-flex">
                    <?php require_once "views/blocks/aside.php" ?>
                    <?= $this->section("page") ?>
                </div>

            </main>

            <?php require_once "views/blocks/footer-admin.php" ?>

            <?php require_once "views/blocks/add-js-to-admin.php" ?>
        </div>
    </div>

</body>

</html>