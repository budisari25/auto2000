<!-- Layout -->
<?=$this->layout('login::layout')?>

<div class="card fat">
    <div class="card-body">
        <h4 class="card-title">Register</h4>
        <form role="form" id="login-form" method="post" action="<?=BASE_URL;?>/register" autocomplete="off">

            <div class="form-group">
                <label for="username">User ID</label>
                <input id="username" type="text" class="form-control" name="username" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required data-eye>
            </div>

            <div class="form-group no-margin">
                <button type="submit" class="btn btn-primary btn-block">
                    Register
                </button>
            </div>
            <div class="margin-top20 text-center">
                Already have an account? <a href="<?=BASE_URL?>/login">Login</a>
            </div>
        </form>
    </div>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <!-- Console.log -->
<?php $this->end() ?>