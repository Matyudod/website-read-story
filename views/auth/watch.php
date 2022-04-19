<?php $this->layout("layouts/default", ["title" => APPNAME, "categories" => $categories]) ?>

<?php $this->start("page") ?>

<div class="p-4 rounded-top">
    <h1 class="h2 text-white text-center bg-secondary m-0 p-2 rounded-top"><?= $stories['info']->story_name ?></h1>
    <div class="bg-secondary d-flex my-2" style="height: fit-content;">
        <div class="bg-black  py-2 px-4 text-white h5 m-0 contentNav position-relative">
            <?= "Chapter " . $stories['this_ep']->episode . ": " . $stories['this_ep']->episode_name ?>
        </div>
    </div>
    <div class="bg-black p-5 rounded text-light" style="font-size: 18px;">
        <?= $stories['this_ep']->content ?>
    </div>

    <div class="bg-secondary py-3 rounded text-light text-center" style="font-size: 18px;">
        <?php if ($stories['this_ep']->episode > 1) { ?>
        <a href="<?= str_replace($stories['this_ep']->episode, $stories['this_ep']->episode - 1, $stories['this_ep']->slug) ?>"
            class="btn btn-dark">Trước</a>
        <?php } ?>
        <select class="btn btn-dark" onchange="window.location.href='/doc-truyen/'+this.value">
            <?php foreach ($stories['eps'] as $ep) { ?>
            <option value="<?= $ep->slug ?>" <?= $ep == $stories['this_ep'] ? "selected" : "" ?>>
                <?= "Chapter " . $ep->episode . ($ep == $stories['this_ep'] ? " ( * )" : "") ?>
            </option>
            <?php } ?>
        </select>
        <?php if ($stories['this_ep']->episode < count($stories['eps'])) { ?>
        <a href="<?= str_replace($stories['this_ep']->episode, $stories['this_ep']->episode + 1, $stories['this_ep']->slug) ?>"
            class="btn btn-dark">Tiếp</a>
        <?php } ?>
    </div>

</div>

<?php $this->stop() ?>