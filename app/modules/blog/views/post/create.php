<?php

/** @var Micro\db\Model $model */

echo \Micro\wrappers\Html::heading(1, 'Создание статьи');

echo $this->renderPartial('_form');