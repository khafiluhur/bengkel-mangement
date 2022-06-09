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
                            <div class="form-group row col-6">
                                <label class="control-label col-md-3 col-sm-3 mb-0 my-2">Kategori Barang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" style="font-size: 12px" name="type">
                                        <option>All</option>
                                        <?php foreach($selectTypes as $key => $item): ?>
                                            <option value="<?= $item['id_type'] ?>"><?= $item['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row col-6">
                                <label class="control-label col-md-3 col-sm-3 mb-0 my-2">Merk Barang</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="select2_single form-control" style="font-size: 12px" name="merk">
                                        <option>All</option>
                                        <?php foreach($selectMerks as $key => $item): ?>
                                            <option value="<?= $item['id_merk'] ?>"><?= $item['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row col-12">
                                <button type="submit" class="btn btn-secondary">Generate</button>
                                <?php if($_SERVER['QUERY_STRING']): ?>
                                <a href="<?= base_url(); ?>/report/cetakli?<?= $_SERVER['QUERY_STRING']; ?>" class="btn btn-success">Print</a>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-listitems" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Ukuran</th>
                                                    <th>Stok</th>
                                                    <th>Harga Jual</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <?php if($_SERVER['QUERY_STRING']): ?>
                                                <tbody>    
                                                    <?php $i=1; ?>
                                                    <?php foreach ($items as $key => $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$item->code?></td>
                                                        <td><?=$item->name?></td>
                                                        <td><?=$item->size?></td>
                                                        <td><?=$item->stock?></td>
                                                        <td><?=number_format($item->price,0,',','.');?></td>
                                                        <td><?=number_format($item->stock * $item->price,0,',','.');?></td>
                                                    </tr>
                                                    <?php endforeach; ?> 
                                                </tbody>
                                                <tfoot style="background-color: rgba(0,0,0,.05)">
                                                    <tr>
                                                        <th colspan="6" style="text-align:center">Total:</th>
                                                        <th colspan="1" style="text-align:center"></th>
                                                    </tr>
                                                </tfoot>
                                            <?php else: ?>
                                                <tbody> 
                                                    <tr>
                                                        <td colspan="7" class="text-center">No data available in table</td>
                                                    </tr>
                                                </tbody> 
                                                <tfoot style="background-color: rgba(0,0,0,.05)">
                                                    <tr>
                                                        <th colspan="6" style="text-align:center">Total:</th>
                                                        <th colspan="1" style="text-align:center"></th>
                                                    </tr>
                                                </tfoot>
                                            <?php endif; ?>
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
<?php if($_SERVER['QUERY_STRING']): ?>
<script>
    $(document).ready(function () {
        $('#datatable-listitems').DataTable({
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
                var rupiah = [];
                console.log(api.column(6).data);
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\.,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
    
                // Total over all pages
                total = api
                    .column(6)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                
                /* Fungsi formatRupiah */
                var angkarev = total.toString().split('').reverse().join('');
                for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                var rupiah1 = rupiah.split('',rupiah.length-1).reverse().join('');
                // Update footer
                $(api.column(6).footer()).html(rupiah1);
            },
            searching: false,
            lengthChange: false
        });
    });
</script>
<?php else: ?>
<?php endif; ?>
<?= $this->endSection(); ?>