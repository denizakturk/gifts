<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="/asset/css/bootstrap.min.css" rel="stylesheet"/>
    <link type="text/css" href="/asset/css/app.css" rel="stylesheet"/>
    <script src="/asset/js/jquery.3.3.1.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <a href="<?=$app->url('home')?>" class="no-link-style">Gifts</a>
                        </div>
                    </div>
                    <div class="col-8 text-right">Send a gift!</div>
                </div>
            </div>
        </header>
        <?php if ($app->getToken()->isLogin()) { ?>
            <nav class="navbar navbar-toggler navbar-collapse navbar-expand-lg navbar-light bg-light"
                 style="width:100%;">
                <div class="collapse navbar-collapse" id="navbarText">
                    <div class="container">
                        <div class="row">
                            <ul class="navbar-nav mr-auto text-center category-nav-bar">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?= $app->url('member_index') ?>">Profile</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?= $app->url('gift_index') ?>">Gifts</a>
                                </li>
                                <li class="nav-item pull-right">
                                    <a class="nav-link" href="<?= $app->url('logout') ?>">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        <?php } ?>
    </div>

    <div class="container">
        <div class="row">
            <?= (!empty($content) ? $content : '') ?>
        </div>
    </div>
</div>
</body>
</html>