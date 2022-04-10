<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="<?= base_url(); ?>/images/favicon.ico" type="image/ico" />

    <title><?php echo $title; ?> | Bengkel Indonesia</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- CSS Page -->
    <?= $this->renderSection('css'); ?>
    <!-- Custom Theme Style -->
    <link href="/build/css/custom.min.css" rel="stylesheet">
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?= $this->include('components/siderbar'); ?>
            
            <?= $this->renderSection('content'); ?>

            <?= $this->include('components/footer'); ?>

            <?php if($title == 'Dashboard'): ?>
            <?php else: ?>
                <?= $this->include('components/modal'); ?>
            <?php endif; ?> 
        </div>
    </div> 

    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="/vendors/iCheck/icheck.min.js"></script>
    <!-- Script Page -->
    <?= $this->renderSection('script'); ?>
    <!-- Custom Theme Scripts -->
    <script src="/build/js/custom.min.js"></script>
</body>
</html>