<h1>Welcome <?= $app->getToken()->getUser()->getName() ?>, your email <?= $app->getToken()->getUser()->getEmail(
    ) ?></h1>
<div class="col-12">
    <h2 class="text-center">Score Table</h2>
    <table class="table">
        <tr>
            <th>User name</th>
            <th>Score</th>
        </tr>
        <?php foreach ($socialScores as $name => $score) { ?>
            <tr>
                <td><?= $name ?></td>
                <td><?= $score ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
