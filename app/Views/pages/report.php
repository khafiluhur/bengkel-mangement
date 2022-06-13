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
<!-- Ion.RangeSlider -->
<script src="<?php echo base_url('/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js'); ?>"></script>
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
                    <form action="" method="GET">
                        <div class="col-12">
                            <div class="form-group row col-6 left">
                                <label class="control-label col-md-3 col-sm-3 mb-0 my-2">Nomor Transaksi</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="code_order" class="form-control" style="font-size: 12px" placeholder="TRXXXXX">
                                </div>
                            </div>
                            <div class="form-group row col-6 left">
                                <label class="control-label col-md-3 col-sm-3 mb-0 my-2">Plat Nomor</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" name="plat_nomor" class="form-control" placeholder="BX 1234 XXX" style="font-size: 12px">
                                </div>
                            </div>
                            <div class="form-group row col-12">
                                <button type="submit" class="btn btn-secondary">Generate</button>
                                <?php if($_SERVER['QUERY_STRING']): ?>
                                <a href="<?= base_url(); ?>/report/cetakhc?<?= $_SERVER['QUERY_STRING']; ?>" class="btn btn-success">Print</a>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="" class="table table-striped table-bordered" style="width:100%">              
                                            <thead>
                                                <tr>
                                                    <th>Kode Transaksi</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Type Motor</th>
                                                    <th>Total Bayar</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if($_SERVER['QUERY_STRING']): ?>
                                                    <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$item->code_order?></td>
                                                        <td><?=$item->nama_customer?> (<?=$item->plat_nomor?>)</td>
                                                        <td><?=$item->type_motor?></td>
                                                        <td><?=number_format($item->total_pay,0,',','.')?></td>
                                                        <td><?=$item->date_trasanction?></td>
                                                        <td><a data-toggle="modal" data-target="#rincianModal" data-id="<?=$item->code_order?>" data-name="<?=$item->nama_customer?>">Rincian</a></td>
                                                    </tr>
                                                    <?php endforeach; ?> 
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">No data available in table</td>
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

<div class="modal fade" id="rincianModal" tabindex="-1" role="dialog" aria-labelledby="rincianModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><?=$title?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kerusakan :</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tindakan 1 :</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tindakan 2 :</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tindakan 3 :</label>
                    </div>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">                
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
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
<script src="<?php echo base_url('/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Ion.RangeSlider -->
<script src="<?php echo base_url('/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js'); ?>"></script>

<?= $this->endSection(); ?>