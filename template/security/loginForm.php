<div class="col-3"></div>
<div class="col-6">
    <h1 class="text-center">Login</h1>
    <form action="<?php echo $app->url('login', ['id']) ?>" class="form" method="post">
        <div class="form-group">
            <input type="email" name="_email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="_password" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
<div class="col-3"></div>