<div class="col-12">
    <form id="gift-form" action="<?= $app->url('gift_send') ?>" method="post" onsubmit="return false;">
        <h2 class="text-center">Gifts</h2>
        <div class="row">
            <?php foreach ($gifts as $gift) { ?>
                <div class="col-4">
                    <div class="gift text-center">
                        <label>
                            <img src="/asset/img/gift.png" class="gift">
                            <br/>
                            <?= $gift->getName() ?>
                            <br/>
                            <input type="radio" name="gift" value="<?= $gift->getId() ?>" required="true"/>
                        </label>

                    </div>
                </div>
            <?php } ?>
        </div>

        <h2 class="text-center">Users</h2>
        <div class="row">
            <?php foreach ($giftSendableUsers as $user) { ?>
                <div class="col-4">
                    <div class="gift text-center">
                        <label>
                            <img src="/asset/img/user.png" class="gift">
                            <br/>
                            <?= $user->getUsername() ?>
                            <br/>
                            <input type="radio" name="user" value="<?= $user->getId() ?>" required="true"/>
                        </label>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success" id="gift-send-button">Send</button>
        </div>
    </form>
</div>