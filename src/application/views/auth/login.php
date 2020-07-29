
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url()?>dist/app.css">
    <script src="<?= base_url()?>dist/app.js"></script>
    <title> <?= $title ?? '' ?></title>
</head>
<body class="login-page">
<div class="container-fluid">
    <div class="user-default-login">
        <div class="login-box" style="max-width:420px;width:auto;">
            <div class="login-logo" style="margin-bottom: 10px;">

                <b>Minty</b>Mint
                <div class="text-center" style="font-size: 14px">Test TASK</div>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg">Вход в систему</p>
                <?php if(isset($message)):?>
                    <div class="text-center text-danger">
                        <?= $message?>
                    </div>
                <?php endif?>
                <?php echo form_open("login",['id' => 'login-form','class' => 'form-login']); ?>
                <div class="text-center" style="border-radius: 5px;">
                    <div class="has-feedback  field-login form-username required">
                        <?php echo form_input($username); ?>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <p class="help-block help-block-error"></p>
                    </div>
                    <div class="has-feedback  field-login form-password required">
                        <?php echo form_input($password); ?>

                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <p class="help-block help-block-error"></p>
                    </div>
                    <!--                    <div class="text-left field-remember form-remember mb-2 required">-->
                    <!--                        --><?php //echo form_checkbox('remember', '1', FALSE); ?>
                    <!--                        <label for="remember">Запомнить меня</label>-->
                    <!--                    </div>-->

                    <?php echo form_submit('submit', 'Войти',['class' => 'btn btn-primary btn-block btn-flat']);?>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>


</div>
</body>
