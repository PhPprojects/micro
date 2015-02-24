<?php

use Micro\web\Language;
use Micro\wrappers\Html;

/** @var array $blogs */
/** @var integer $pages */
/** @var Language $lang */

$currPage = 0;
if (!empty($_GET['page'])) {
    $currPage = $_GET['page'];
}

$this->widget('App\modules\blog\widgets\TopblogsWidget');
echo Html::href('Создать', '/blog/post/create');

if (!$blogs) {
    ?><p>Ничего не найдено</p><?php
} else {
    ?>
    <?php foreach ($blogs AS $blog): ?>
        <?= Html::heading(1, Html::href($blog->name, '/blog/post/' . $blog->id)) ?>
        <p><?= $blog->content ?></p>
    <?php endforeach; ?>
    <p>
        <?php for ($page = 0; $page < $pages; $page++): ?>
            <?php if ($page !== $currPage): ?>
                <?= Html::openTag('a', ['href' => '/blog/post/index/' . $page]) ?>
            <?php endif; ?>

            <?= $page + 1; ?>

            <?php if ($page !== $currPage): ?>
                <?= Html::closeTag('a') ?>
            <?php endif; ?>
        <?php endfor; ?>
    </p>
    <p><?= $lang->hello; ?></p>
<?php } ?>