<?= $this->extend('layouts/app'); ?>

<?= $this->section('css'); ?>
<!-- iCheck -->
<link href="<?php echo base_url('/vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="<?php echo base_url('/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
<!-- JQVMap -->
<link href="<?php echo base_url('/vendors/jqvmap/dist/jqvmap.min.css'); ?>" rel="stylesheet"/>
<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url('/vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
<style>
    .x_content {
        font-size: 1.2rem;
    }
    .black {
        color: #495057;
        font-weight: 500;
    }
    .card-animate {
        transition: all 0.4s;
    }
    .card-animate:hover {
        ransform: translateY(-0.3rem);
        box-shadow: 0 5px 10px rgb(30 32 37 / 12%);
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row w-100" style="display: inline-block;" >
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= $title ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success" role="alert">
                                <p class="mb-0 h6">Selamat Datang di <?= $name_site ?></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-md-3 col-sm-3">
                                <div class="x_panel tile rounded card-animate">
                                    <a href="<?= base_url(); ?>/items">
                                        <div class="col-12">
                                            <div class="col-4 left py-3 rounded text-center" style="background: rgba(64, 81, 137, 0.18) !important;">
                                                <i class="fa fa-briefcase fa-lg" style="color: #405189;"></i>
                                            </div>
                                            <div class="col-8 left">
                                                <div class="">
                                                    <h4>Barang</h4>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content black">
                                                    <?= $total_items ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <div class="x_panel tile rounded card-animate">
                                    <a href="<?= base_url(); ?>/items">
                                        <div class="col-12">
                                            <div class="col-4 left py-3 rounded text-center" style="background: rgba(247, 184, 75, 0.18) !important">
                                                <i class="fa fa-archive fa-lg" style="color: #f7b84b;"></i>
                                            </div>
                                            <div class="col-8 left">
                                                <div class="">
                                                    <h4>Stok</h4>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content black">
                                                    <?= $total_stocks ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <div class="x_panel tile rounded card-animate">
                                    <a href="<?= base_url(); ?>/check_suppliers">
                                        <div class="col-12">
                                            <div class="col-4 left py-3 rounded text-center" style="background: rgba(41, 156, 219, 0.18) !important">
                                                <i class="fa fa-shopping-cart fa-lg" style="color: #299cdb;"></i>
                                            </div>
                                            <div class="col-8 left">
                                                <div class="">
                                                    <h4>Terjual</h4>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content black">
                                                    <?= $total_stock_sells ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <div class="x_panel tile rounded card-animate">
                                    <a href="<?= base_url(); ?>/type_items">
                                        <div class="col-12">
                                            <div class="col-4 left py-3 rounded text-center" style="background: rgba(10,179,156,.18)!important">
                                                <i class="fa fa-book fa-lg" style="color: #0ab39c;"></i>
                                            </div>
                                            <div class="col-8 left">
                                                <div class="">
                                                    <h4>Kategori</h4>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content black">
                                                    <?= $total_types ?>
                                                </div>
                                            </div>
                                        </div> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- Chart.js -->
<script src="<?php echo base_url('/vendors/Chart.js/dist/Chart.min.js'); ?>"></script>
<!-- gauge.js -->
<script src="<?php echo base_url('/vendors/gauge.js/dist/gauge.min.js'); ?>"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
<!-- Skycons -->
<script src="<?php echo base_url('/vendors/skycons/skycons.js'); ?>"></script>
<!-- Flot -->
<script src="<?php echo base_url('/vendors/Flot/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/Flot/jquery.flot.pie.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/Flot/jquery.flot.time.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/Flot/jquery.flot.stack.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/Flot/jquery.flot.resize.js'); ?>"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url('/vendors/flot.orderbars/js/jquery.flot.orderBars.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/flot-spline/js/jquery.flot.spline.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/flot.curvedlines/curvedLines.js'); ?>"></script>
<!-- DateJS -->
<script src="<?php echo base_url('/vendors/DateJS/build/date.js'); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('/vendors/jqvmap/dist/jquery.vmap.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url('/vendors/moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<?= $this->endSection(); ?>