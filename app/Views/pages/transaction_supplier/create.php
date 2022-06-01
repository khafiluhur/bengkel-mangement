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
<style>
    .close {
        font-size: 15px !important;
    }
</style>
<?= $this->endSection(); ?>
 
<?= $this->section('content'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        if(session()->getFlashData('success')){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php
        }
        ?>

        <?php
        if(session()->getFlashData('error')){
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php
        }
        ?>
        <div class="page-title">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
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
                        <?php if($type == 'checkSuppliers'): ?>
                            <form action="<?= base_url(); ?>/check_suppliers/process-supplier" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        <?php else: ?>
                            <form action="<?= base_url(); ?>/check_in/process-supplier" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        <?php endif; ?>
                            <?= csrf_field() ?>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Kode Pemesanan
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control" value="<?=$new_code?>" disabled>
                                    <input type="hidden" required="required" class="form-control" name="code" value="<?=$new_code?>">
                                </div>
                            </div>
                            <?php if($type == 'checkSuppliers'): ?>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Pelanggan
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="customer">
                                        <option value="">Pilih Pelanggan</option>
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
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Kerusakan
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <textarea id="crash" class="form-control" name="crash" data-parsley-trigger="keyup"></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Tindakan 1
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <textarea id="crashrepair1" class="form-control" name="crashrepair1" data-parsley-trigger="keyup"></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Tindakan 2
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <textarea id="crashrepair2" class="form-control" name="crashrepair2" data-parsley-trigger="keyup"></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Tindakan 3
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <textarea id="crashrepair3" class="form-control" name="crashrepair3"></textarea>
                                </div>
                            </div>
                            <?php else: ?>
                            <?php endif; ?>
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
                                                                    <?php if($type == 'checkIns'): ?>
                                                                    <th>Supplier</th>
                                                                    <?php else: ?>
                                                                    <?php endif; ?>
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
                                                                    <?php if($type == 'checkIns'): ?>
                                                                        <td><?= $item->name_supplier ?></td>
                                                                    <?php else: ?>
                                                                    <?php endif; ?>
                                                                    <td><?= $item->stock ?></td>
                                                                    <td><?= "Rp. " . number_format($item->price,0,',','.'); ?></td>
                                                                    <td><?= "Rp. " . number_format($item->subtotal,0,',','.'); ?></td>
                                                                    <?php if($type == 'checkSuppliers'): ?>
                                                                        <td>
                                                                        <a href="" class="btn btn-warning btn-edit-transaksi" data-toggle="modal" data-target="#editTransactionModal" data-trns="<?=$item->code_order?>" data-trid="<?=$item->id?>" data-id="<?=$item->id_item?>" data-code="<?= $item->code_item ?>" data-availabel="<?= $item->stock_item ?>" data-price="<?= $item->price ?>" data-stock="<?= $item->stock ?>" style="font-size: 12px;"><i class="fa fa-edit"></i></a>
                                                                        <a href="<?= base_url(); ?>/check_suppliers/<?= $item->id ?>/delete" class="btn btn-danger" style="font-size: 12px; color: white;">X</a>
                                                                        </td>
                                                                    <?php else: ?>
                                                                        <td>
                                                                            <a href="" class="btn btn-warning btn-edit-transaksi" data-toggle="modal" data-target="#editTransactionModal" data-trns="<?=$item->code_order?>" data-trid="<?=$item->id?>" data-id="<?=$item->id_item?>" data-code="<?= $item->code_item ?>" data-availabel="<?= $item->stock_item ?>" data-price="<?= $item->price ?>" data-supplier="<?= $item->id_supplier ?>" data-stock="<?= $item->stock ?>" style="font-size: 12px;"><i class="fa fa-edit"></i></a>
                                                                            <a href="<?= base_url(); ?>/check_in/<?= $item->id ?>/delete" class="btn btn-danger" style="font-size: 12px; color: white;">X</a>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                                <tr>
                                                                    <td colspan="6">Total Harga</td>
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
                                    <?php if($type == 'checkIns'): ?>
                                        <a href="<?= base_url(); ?>/check_in" class="btn btn-primary" type="button" style="color: white">Close</a>
                                    <?php else: ?>
                                        <a href="<?= base_url(); ?>/check_suppliers" class="btn btn-primary" type="button" style="color: white">Close</a>
                                    <?php endif; ?>
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
<?php if($type == 'checkIns'): ?>
    <script type="text/javascript">		
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    <script type="text/javascript">		
        var rupiah1 = document.getElementById('rupiah1');
        rupiah1.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah1.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah1     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah1 += separator + ribuan.join('.');
            }

            rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
            return prefix == undefined ? rupiah1 : (rupiah1 ? 'Rp. ' + rupiah1 : '');
        }
    </script>
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
        });
    </script>
<?php else: ?>
<?php endif; ?>
<?php if($type == 'checkSuppliers'): ?>
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
            const req_stock = document.getElementById('source');
            var element = document.getElementById("total_stock");
            var element1 = document.getElementById("message_stock");
            req_stock.addEventListener('input', function() {
                // Do something
                if(stock - this.value < 0) {
                    element.classList.add("bad");
                    element1.classList.remove("d-none");
                    document.getElementById("button_simpan").disabled = true;
                } else {
                    element.classList.remove("bad");
                    element1.classList.add("d-none");
                    document.getElementById("button_simpan").disabled = false;
                }
                
            });
        });
    </script>
<?php else: ?>
<?php endif; ?>
<script>
    $(document).ready(function(){
        $('.btn-create').on('click',function(){
            // get data from button edit
            const code = $(this).data('codetr');
            // Set data to Form Edit
            $('.product_code').val(code);
            // Call Modal Edit
            $('#createTransactionModal').modal('show');
        });
    });
</script>
<script>
    $('.btn-edit-transaksi').on('click',function(){
            // get data from button edit
            const trid = $(this).data('trid');
            const trns = $(this).data('trns');
            const id = $(this).data('id');
            var base_url = '<?php echo base_url();?>'
            const code = $(this).data('code');
            const availabel = $(this).data('availabel');
            const stock = $(this).data('stock');
            const supplier = $(this).data('supplier');
            const price = $(this).data('price');

            // Convert to Rupiah            
            var	number_string = price.toString(),

            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            const req_stock = document.getElementById('source1');
            var element = document.getElementById("total_stock1");
            var element1 = document.getElementById("message_stock1");
            req_stock.addEventListener('input', function() {
                // Do something
                if(availabel - this.value < 0) {
                    element.classList.add("bad");
                    element1.classList.remove("d-none");
                    document.getElementById("button_simpan1").disabled = true;
                } else {
                    element.classList.remove("bad");
                    element1.classList.add("d-none");
                    document.getElementById("button_simpan1").disabled = false;
                }
            });

            // Set data to Form Edit
            $('#checkIns').attr('action', base_url + '/check_in/' + trid + '/update');
            $('#checkSuppliers').attr('action', base_url + '/check_suppliers/' + trid + '/update');
            $('.product_trns').val(trns);
            $('.product_id').val(id);
            $('.product_code').val(code);
            $('.product_availabel').val(availabel);
            $('.product_price2').val('Rp. ' + rupiah);
            $('.product_supplier').val(supplier);
            $('.product_stock').val(stock);
            // Call Modal Edit
            $('#editTransactionModal').modal('show');
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
