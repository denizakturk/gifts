<div class="col-12">
    <h1 class="text-center">Welcome <?= $app->getToken()->getUser()->getName() ?>, have a fun.</h1>

    <?php if (!empty($socialScores)) { ?>
        <h2 class="text-center">Score Table</h2>
        <table class="table">
            <tr>
                <th class="text-center">User name</th>
                <th class="text-center">Score</th>
            </tr>
            <?php foreach ($socialScores as $name => $score) { ?>
                <tr>
                    <td class="text-center"><?= $name ?></td>
                    <td class="text-center"><?= $score ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    <div class="text-center">
        <a href="<?= $app->url('gift_index') ?>" class="btn btn-primary">Send a gift to your friends</a>
    </div>
</div>
