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
                    <h2>Pengaturan</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="POST" action="<?= base_url() ?>/updateSetting">
                                <?= csrf_field() ?>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Nama Bengkel</label>
                                    <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" name="name_site" value="<?= $data['name_site'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Alamat Bengkel</label>
                                    <div class="col-md-9 col-sm-9">
                                        <textarea class="form-control" name="address_site" data-parsley-trigger="keyup"><?= $data['address_site'] ?></textarea>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Telepone Bengkel
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" name="telepone_site" value="<?= $data['telepone_site'] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
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