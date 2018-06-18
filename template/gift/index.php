<div class="col-12">
    <form action="<?= $app->url('gift_send') ?>" method="post">
        <h2 class="text-center">Gifts</h2>
        <div class="row">
            <?php foreach ($gifts as $gift) { ?>
                <div class="col-4">
                    <div class="gift text-center">
                        <label><?= $gift->getName() ?>
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
                        <label><?= $user->getUsername() ?>
                            <input type="radio" name="user" value="<?= $user->getId() ?>" required="true"/>
                        </label>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Send</button>
        </div>
    </form>
</div>