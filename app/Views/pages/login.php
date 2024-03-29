<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('/images/favicon.ico'); ?>" type="image/ico" />

    <title>Bengkel Motekar Jaya Motor</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('/vendors/animate.css/animate.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/build/css/custom.min.css'); ?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo session()->getFlashdata('error'); ?>
              </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url(); ?>/login/process">
              <?= csrf_field(); ?>
              <h1>Silahkan Login Disini</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" value="<?= old('username') ?>"/>
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" value="<?= old('passwordf') ?>"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary submit w-100">Masuk</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><?= $name_site ?></h1>
                  <p>©2022 All Rights Reserved. <?= $name_site ?>. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
