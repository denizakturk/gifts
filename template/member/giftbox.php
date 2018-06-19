<div class="col-12">
    <h2 class="text-center">Gifts</h2>
    <div class="row">
        <?php
        if (!empty($unapprovedGifts)) {
            /** @var \App\Model\GiftSentModel $giftSent */
            foreach ($unapprovedGifts as $giftSent) {
                ?>
                <div class="col-4">
                    <div class="gift text-center">
                        <label>
                            Sent to <?= $giftSent->getSenderName() ?>
                            <br/>
                            <img src="/asset/img/gift.png" class="gift">
                            <br/>
                            <?= $giftSent->getGiftName() ?>
                            <br/>
                            <button class="btn btn-danger btn-sm approve" data-approve-id="<?= $giftSent->getId() ?>"
                                    data-approved="0">Cancel
                            </button>
                            <button class="btn btn-success btn-sm approve" data-approve-id="<?= $giftSent->getId() ?>"
                                    data-approved="1">Approved
                            </button>
                        </label>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="col-12 text-center">No gifts, If you send a gift to your friends, maybe they can send it to
                you<br/><a href="<?= $app->url('gift_index') ?>" class="btn btn-primary">Send a gift to your friends</a>
            </div>
        <?php } ?>
    </div>
</div>