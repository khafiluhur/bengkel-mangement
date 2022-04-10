data transaction :
- transaction barang masuk
- trasaction barang kelaur
- pemesanan ke supplier
<?= $this->extend('layouts/app'); ?>

<?= $this->section('css'); ?>
<!-- Bootstrap -->
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<!-- Datatables -->
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<style>
    .panel_toolbox>li>a:hover {
        color: #fff !important;
        background-color: #0069d9 !important;
        border-color: #0062cc !important;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="right_col" role="main">
    <div class="">
    <div class="page-title">

        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=$title?> </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <?php if($type == 'checkSuppliers'): ?>
                                <li><a href="<?= base_url(); ?>/check_suppliers/store" class="btn btn-primary btn-sm btn-create" style="color: white;">Tambah Transaksi</a></li>
                            <?php else: ?>
                                <li><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Tambah</button></li>
                            <?php endif; ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <?php if($type == 'checkIns'): ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    <th>Stock</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($transactions as $transaction) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$transaction->item?>(<?=$transaction->code_item?>)</td>
                                                        <td><?=$transaction->supplier?>(<?=$transaction->code_supplier?>)</td>
                                                        <td><?="Rp. " . number_format($transaction->price,0,',','.');?></td>
                                                        <td><?=$transaction->stock?></td>
                                                        <td><a href="" class="btn-edit" data-toggle="modal" data-target="#editModal" data-id="<?=$transaction->id?>" data-code="<?=$transaction->id_item?>" data-name="<?=$transaction->id_supplier?>" data-stock="<?=$transaction->stock?>" data-price="<?=$transaction->price?>">Ubah</a> | <a href="<?= base_url('check_in/'.$transaction->id.'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'checkOuts'): ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Tanggal Keluar</th>
                                                    <th>Jumlah</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($transactions as $transaction) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$transaction->item?>(<?=$transaction->code_item?>)</td>
                                                        <td><?=$transaction->date_out?></td>
                                                        <td><?=$transaction->stock?></td>
                                                        <td><a href="" class="btn-edit-montir" data-toggle="modal" data-target="#editModal" data-id="<?=$transaction->id?>" data-code="<?=$transaction->id_item?>" data-name="<?=$transaction->date_out?>" data-stock="<?=$transaction->stock?>">Ubah</a> | <a href="<?= base_url('check_out/'.$transaction->id.'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php else: ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Total Bayar</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($transactions as $transaction) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$transaction['code_order']?></td>
                                                        <td><?=$transaction['date_trasanction']?></td>
                                                        <td><?="Rp. " . number_format($transaction['total_pay'],0,',','.');?></td>
                                                        <td>
                                                            <a href="<?= base_url(); ?>/check_suppliers/<?= $transaction['id'] ?>/detail" class="btn btn-warning btn-sm" style="color: black">Detail</a>
                                                            <a href="<?= base_url(); ?>/check_suppliers/<?= $transaction['id'] ?>/delete-supplier" class="btn btn-danger btn-sm" style="color: white;">Hapus</a>
                                                            <a href="<?= base_url(); ?>/check_suppliers/cetak" class="btn btn-success btn-sm" style="color: white;">Cetak</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
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
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<script>
    $(document).ready(function(){
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            var base_url = '<?php echo base_url();?>'
            const name = $(this).data('name');
            const code = $(this).data('code');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
            const type = $(this).data('type');
            const size = $(this).data('size');
            const supplier = $(this).data('supplier');
            const merk = $(this).data('merk');

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
            $('#checkIns').attr('action', base_url + '/check_in/' + id + '/update');
            $('.product_name').val(name);
            $('.product_code').val(code);
            $('.product_price2').val('Rp. ' + rupiah);
            $('.product_stock2').val(stock);
            $('.product_type2').val(type);
            $('.product_supplier2').val(supplier);
            $('.product_merk2').val(merk);
            $('.product_size').val(size);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
        $('.btn-edit-montir').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            var base_url = '<?php echo base_url();?>'
            const name = $(this).data('name');
            const code = $(this).data('code');
            const type = $(this).data('type');
            const stock = $(this).data('stock');
            const price = $(this).data('price');

            // Set data to Form Edit
            $('#checkOuts').attr('action', base_url + '/check_out/' + id + '/update');
            $('.product_name').val(name);
            $('.product_code').val(code);
            $('.product_price2').val(price);
            $('.product_stock').val(stock);
            $('.product_type').val(type);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
        // Get Create Items
        $('.btn-create').on('click', function(){
            const code = $(this).data('code');
            $('.product_code').val(code);
            $('#createModal').modal('show');
        });
    });
</script>
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
<?php else: ?>
<?php endif; ?>
<?= $this->endSection(); ?>