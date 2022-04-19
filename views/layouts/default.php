<!DOCTYPE html>
<html lang="en">

<?php require_once "views/blocks/head.php" ?>

<body>
    <div class="app">
        <div class="container-fluid bg-black">
            <?php require_once "views/blocks/header.php" ?>
            <main class="container bg-dark pt-2">
                <?= $this->section("page") ?>
            </main>

            <?php require_once "views/blocks/footer.php" ?>
        </div>
    </div>

</body>

</html>