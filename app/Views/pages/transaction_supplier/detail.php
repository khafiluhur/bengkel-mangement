<?= $this->extend('layouts/app'); ?>

<?= $this->section('css'); ?>
<!-- iCheck -->
<link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- bootstrap-wysiwyg -->
<link href="/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<!-- Select2 -->
<link href="/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Switchery -->
<link href="/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- starrr -->
<link href="/vendors/starrr/dist/starrr.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<?= $this->endSection(); ?>
 
<?= $this->section('content'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=$title?></h3>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div class="item form-group col-md-12 left">
                            <label class="col-form-label col-md-2 col-sm-2" for="first-name" style="font-size: 16px; font-weight: bold;">Tanggal Penjualan :
                            </label>
                            <div class="col-md- col-sm-6">
                                <label class="col-form-label col-md-6 col-sm-6" for="first-name" style="font-size: 16px;"><?= $transactions['code_order'] ?>
                            </div>
                        </div>
                        <div class="item form-group col-md-6 left">
                            <label class="col-form-label col-md-4 col-sm-4" for="first-name" style="font-size: 16px; font-weight: bold;">Tanggal Penjualan :
                            </label>
                            <div class="col-md- col-sm-6">
                                <label class="col-form-label col-md-6 col-sm-6" for="first-name" style="font-size: 16px;"><?= $transactions['date_trasanction'] ?>
                            </div>
                        </div>
                        <div class="item form-group col-md-6 right">
                            <label class="col-form-label col-md-4 col-sm-4" for="first-name" style="font-size: 16px; font-weight: bold;">Tanggal Penjualan :
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <label class="col-form-label col-md-6 col-sm-6" for="first-name" style="font-size: 16px;"><?= $transactions['date_trasanction'] ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="">
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box table-responsive">
                                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">                
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Barang</th>
                                                                <th>Nama Barang</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $i=1; ?>
                                                            <?php foreach ($item_supplier as $item) : ?>
                                                            <tr>
                                                                <td><?=$i++?></td>
                                                                <td><?= $item->code_item ?></td>
                                                                <td><?= $item->nama_item ?></td>
                                                                <td><?= "Rp. " . number_format($item->price_item,0,',','.'); ?></td>
                                                                <td><?= $item->stock ?></td>
                                                            </tr>
                                                            <?php endforeach; ?>
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
            </div>
        </div>
    </div>
</div>
<?= $this->include('pages/transaction_supplier/modal'); ?>
<!-- /page content -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $('#id_item').on('change', function(){
        // ambil data dari elemen option yang dipilih
        const code = $('#id_item option:selected').data('code');
        const price = $('#id_item option:selected').data('price');
        const stock = $('#id_item option:selected').data('stock');
        
        // kalkulasi total harga
        // Convert to Rupiah            
        var	number_string = price.toString(),

        sisa 	= number_string.length % 3,
        rupiah 	= number_string.substr(0, sisa),
        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        // tampilkan data ke element
        $('[name=code]').val(code);
        $('[name=price]').val('Rp. ' + rupiah);
        $('[name=stock]').val(stock);
        
        // $('#total').text(`Rp ${total}`);
    });
</script>
<script>
$(document).ready(function(){
    $('.btn-create').on('click',function(){
        console.log($(this).data());
        // get data from button edit
        const code = $(this).data('codetr');
        // Set data to Form Edit
        $('.product_code').val(code);
        // Call Modal Edit
        $('#createTransactionModal').modal('show');
    });
});
</script>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>
<?= $this->endSection(); ?>
