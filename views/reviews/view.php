<?php

use app\models\Reviews\Review;

/**
 * @var Review $review
 */
$this->title = 'Review';
?>

<div class="reviews__view">
    <h3 class="mb-3"><?= $review->title ?></h3>
    <p><?= $review->text ?></p>
    <div class="d-flex justify-content-between">
        <div class=""> <?= $review->getUSCreatedAt() ?> </div>
    <div class=""> <?= $review->author->getFullName() ?></div>
    </div>
</div>

