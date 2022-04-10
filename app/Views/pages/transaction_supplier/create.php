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
                        <form action="<?= base_url(); ?>/check_suppliers/process-supplier" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <?= csrf_field() ?>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Kode Pemesanan
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control" value="<?=$new_code?>" disabled>
                                    <input type="hidden" required="required" class="form-control" name="code" value="<?=$new_code?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Customer
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="customer">
                                        <option value="">Pilih Customer</option>
                                        <?php foreach ($customers as $item) : ?>
                                            <option value="<?=$item['id']?>"><?=$item['name']?>(<?=$item['plat_nomor']?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Montir
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="montir">
                                        <option value="">Pilih Montir</option>
                                        <?php foreach ($montirs as $item) : ?>
                                            <option value="<?=$item['id']?>"><?=$item['name']?>(<?=$item['nip']?>)</option>
                                        <?php endforeach; ?>
                                    </select>
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
                                                                    <th>Jumlah</th>
                                                                    <th>Harga</th>
                                                                    <th>Subtotal</th>
                                                                    <th><a class="btn btn-primary btn-create" data-toggle="modal" data-target="#createTransactionModal" data-codeTR="<?=$new_code?>" style="font-size: 12px; color: white;">Tambah Pesanan</a></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php $i=1; ?>
                                                                <?php foreach ($item_supplier as $item) : ?>
                                                                <tr>
                                                                    <td><?=$i++?></td>
                                                                    <td><?= $item->code_item ?></td>
                                                                    <td><?= $item->nama_item ?></td>
                                                                    <td><?= $item->stock ?></td>
                                                                    <td><?= "Rp. " . number_format($item->price_item,0,',','.'); ?></td>
                                                                    <td><?= "Rp. " . number_format($item->subtotal,0,',','.'); ?></td>
                                                                    <td><a href="<?= base_url(); ?>/check_suppliers/<?= $item->id ?>/delete" class="btn btn-warning" style="font-size: 12px; color: white;">X</a</td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                                <tr>
                                                                    <td colspan="5">Total Harga</td>
                                                                    <?php if($total_pay[0]->total_pay != null) { ?>
                                                                        <td colspan="2" style="font-weight: bold;"><?= "Rp. " . number_format($total_pay[0]->total_pay,0,',','.'); ?></td>
                                                                    <?php } else { ?>
                                                                        <td colspan="2" style="font-weight: bold;"><?= "Rp. 0" ?></td>
                                                                    <?php } ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?= base_url(); ?>/check_suppliers" class="btn btn-primary" type="button" style="color: white">Close</a>
                                </div>
                            </div>
                        </form>
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
