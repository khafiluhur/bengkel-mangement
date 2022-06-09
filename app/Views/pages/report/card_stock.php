<?= $this->extend('layouts/app'); ?>

<?= $this->section('css'); ?>
<!-- Bootstrap -->
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<!-- Datatables -->
<link href="<?php echo base_url('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('/vendors/select2/dist/css/select2.min.css'); ?>" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url('/vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
<style>
    .input-group-addon {
        padding: 11px 12px !important;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
    <div class="page-title">
        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=$title?> </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-12">
                        <form action="" method="GET">
                            <div class="form-group row col-6 left">
                                <label class="control-label col-md-3 col-sm-3 mb-0 my-2">Range Tanggal</label>
                                <div class="col-md-9 col-sm-9 ">
                                <fieldset>
                                    <div class="control-group ">
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" style="width: 200px" name="date" id="reservation" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                </fieldset>
                                </div>
                            </div>
                            <div class="form-group row col-6">
                                <label class="control-label col-md-3 col-sm-3 mb-0 my-2">Nama Barang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" style="font-size: 12px" name="name">
                                        <option>All</option>
                                        <?php foreach($selectItems as $key => $item): ?>
                                            <option value="<?= $item['code'] ?>"><?= $item['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row col-12">
                                <button type="submit" class="btn btn-secondary">Generate</button>
                                <?php if($_SERVER['QUERY_STRING']): ?>
                                    <a href="<?= base_url(); ?>/report/cetakcs?<?= $_SERVER['QUERY_STRING']; ?>" class="btn btn-success">Print</a>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Stok Masuk</th>
                                                    <th>Stok Keluar</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if($_SERVER['QUERY_STRING']): ?>
                                                    <?php if($_SERVER['QUERY_STRING']=='name=All'): ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">No data available in table</td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <?php foreach ($items as $key => $item) : ?>
                                                        <tr>
                                                            <td><?= $item->date ?></td>
                                                            <td><?= $item->information ?></td>
                                                            <td><?= $item->stock_in ?></td>
                                                            <td><?= $item->stock_out ?></td>
                                                            <td><?= $item->saldo ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No data available in table</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- Datatables -->
<script src="<?php echo base_url('/vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-buttons/js/buttons.flash.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/datatables.net-scroller/js/dataTables.scroller.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/jszip/dist/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url('/vendors/moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<?= $this->endSection(); ?>