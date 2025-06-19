<?php
global $userReviewInfo;
global $userReviewMessage;
global $userReviewRating;
global $userReviewTime;
?>

<div class="review-message">
    <div class="card">
        <div class="card-header"><?= $userReviewInfo; ?></div>
        <div class="card-body">
            <div class="card-text"><?= $userReviewMessage; ?></div>
            <div class="text-muted">-- <?= $userReviewRating; ?> --</div>
        </div>
        <div class="card-footer"><?= $userReviewTime; ?></div>
    </div>
</div>