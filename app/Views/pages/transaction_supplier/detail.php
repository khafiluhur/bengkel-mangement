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
                        <div class="item form-group col-md-7 left">
                            <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Nomor Transaksi :
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <label class="col-form-label col-md-6 col-sm-6" for="first-name" style="font-size: 16px;"><?= $transactions[0]->code_order ?>
                            </div>
                        </div>
                        <div class="item form-group col-md-5 right">
                            <label class="col-form-label col-md-5 col-sm-5" for="first-name" style="font-size: 16px; font-weight: bold;">Tanggal Penjualan :
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <label class="col-form-label col-md-7 col-sm-7" for="first-name" style="font-size: 16px;"><?= $transactions[0]->date_trasanction ?>
                            </div>
                        </div>
                        <?php if($type == 'checkSuppliers'): ?>
                        <div class="item form-group col-md-7 left">
                            <label  class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Pelanggan :
                            </label>
                            <div class="col-md- col-sm-6">
                                <label class="col-form-label col-md-12 col-sm-12" for="first-name" style="font-size: 16px;"><?= $customers[0]->name ?> (<?= $customers[0]->plat_nomor ?>)</label>
                            </div>
                        </div>
                        <div class="item form-group col-md-5 right">
                            <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Montir :
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <label class="col-form-label col-md-12 col-sm-12" for="first-name" style="font-size: 16px;"><?= $montirs[0]->name ?> (<?= $montirs[0]->nip ?>)</label>
                            </div>
                        </div>
                        <div class="item form-group col-md-12">
                            <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Kerusakan :
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <label class="col-form-label col-md-12 col-sm-12" for="first-name" style="font-size: 16px;"><?= $transactions[0]->crash ?></label>
                            </div>
                        </div>
                        <div class="item form-group col-md-12">
                            <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Tindakan 1 :
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <label class="col-form-label col-md-12 col-sm-12" for="first-name" style="font-size: 16px;"><?= $transactions[0]->crashrepair1 ?></label>
                            </div>
                        </div>
                        <div class="item form-group col-md-12">
                            <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Tindakan 2 :
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <label class="col-form-label col-md-12 col-sm-12" for="first-name" style="font-size: 16px;"><?= $transactions[0]->crashrepair2 ?></label>
                            </div>
                        </div>
                        <div class="item form-group col-md-12">
                            <label class="col-form-label col-md-3 col-sm-3" for="first-name" style="font-size: 16px; font-weight: bold;">Tindakan 3 :
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <label class="col-form-label col-md-12 col-sm-12" for="first-name" style="font-size: 16px;"><?= $transactions[0]->crashrepair3 ?></label>
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
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                                <th>Total</th>
                                                                <th>Piihan</th>
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
                                                                <td><?= "Rp. " . number_format($item->price,0,',','.'); ?></td>
                                                                <td><?= $item->stock ?></td>
                                                                <td><?= "Rp. " . number_format($item->price * $item->stock,0,',','.'); ?></td>
                                                                <?php if($type == 'checkIns'): ?>
                                                                    <td><a href="" class="btn-edit-transaksi" data-trns="<?=$item->code_order?>" data-trid="<?=$item->id?>" data-id="<?=$item->id_item?>" data-code="<?= $item->code_item ?>" data-availabel="<?= $item->stock_item ?>" data-price="<?= $item->price ?>" data-supplier="<?= $item->id_supplier ?>" data-stock="<?= $item->stock ?>" data- data-code data-toggle="modal" data-target="#editTransactionModal">Ubah</a></td>
                                                                <?php else: ?>
                                                                    <td><a href="" class="btn-edit-transaksi" data-trns="<?=$item->code_order?>" data-trid="<?=$item->id?>" data-id="<?=$item->id_item?>" data-code="<?= $item->code_item ?>" data-availabel="<?= $item->stock_item ?>" data-price="<?= $item->price ?>" data-stock="<?= $item->stock ?>" data- data-code data-toggle="modal" data-target="#editTransactionModal">Ubah</a></td>
                                                                <?php endif; ?>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center font-weight-bold" style="background-color: gainsboro;">Total Bayar</td>
                                                                <td colspan="4" class="text-center font-weight-bold" style="background-color: darkgray;"><?= "Rp. " . number_format($transactions[0]->total_pay,0,',','.'); ?></td>
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

            // Set data to Form Edit
            $('#checkIns').attr('action', base_url + '/check_in/' + trid + '/detail-update');
            $('#checkSuppliers').attr('action', base_url + '/check_suppliers/' + trid + '/detail-update');
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

<?= $this->endSection(); ?>
