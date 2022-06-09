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
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=$title?> </h2>
                        <ul class="nav navbar-right panel_toolbox">
                                <li><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Tambah</button></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">                
                                        <?php if($type == 'typeItems'): ?>
                                            <thead>
                                                <tr>
                                                    <th>Jenis Barang</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$item['name']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_type']?>" data-name="<?=$item['name']?>">Ubah</a> | <a href="<?= base_url('type_items/'.$item['id_type'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'merkItems'): ?>
                                            <thead>
                                                <tr>
                                                    <th>Merk Barang</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$item['name']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_merk']?>" data-name="<?=$item['name']?>">Ubah</a> | <a href="<?= base_url('merk_items/'.$item['id_merk'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'suppliers'): ?>
                                            <thead>
                                                <tr>
                                                    <th>Kode Supplier</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Nama PIC</th>
                                                    <th>Telepone PIC</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$item['code']?></td>
                                                        <td><?=$item['name']?></td>
                                                        <td><?=$item['name_pic']?></td>
                                                        <td><?=$item['telepone_pic']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_supplier']?>" data-name="<?=$item['name']?>" data-price="<?=$item['name_pic']?>" data-stock="<?=$item['telepone_pic']?>"  data-type="<?=$item['alamat']?>">Ubah</a> | <a href="<?= base_url('suppliers/'.$item['id_supplier'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'montirs'): ?>
                                            <thead>
                                                <tr>
                                                    <th>Nomor Pegawai</th>
                                                    <th>Nama</th>
                                                    <th>Telephone</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$item['nip']?></td>
                                                        <td><?=$item['name']?></td>
                                                        <td><?=$item['telepone']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-id="<?=$item['id']?>" data-code="<?=$item['nip']?>" data-name="<?=$item['name']?>" data-type="<?=$item['telepone']?>" data-stock="<?=$item['alamat']?>" data-toggle="modal" data-target="#editModal" >Ubah</a> | <a href="<?= base_url('montirs/'.$item['id'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'services'): ?>
                                            <thead>
                                                <tr>
                                                    <th>Nama Service</th>
                                                    <th>Harga</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$item['name']?></td>
                                                        <td><?=number_format($item['price'],0,',','.');?></td>
                                                        <td><a href="" class="btn-edit" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id']?>" data-name="<?=$item['name']?>" data-price="<?=$item['price']?>">Ubah</a> | <a href="<?= base_url('services/'.$item['id'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php else: ?>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Type Motor</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['code'] ?></td>
                                                        <td><?=$item['name']?></td>
                                                        <td><?=$item['plat_nomor']?></td>
                                                        <td><?=$item['type_motor']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-id="<?=$item['id']?>" data-code="<?=$item['name']?>" data-name="<?=$item['plat_nomor']?>" data-type="<?=$item['type_motor']?>" data-toggle="modal" data-target="#editModal" >Ubah</a> | <a href="<?= base_url('customers/'.$item['id'].'/delete'); ?>">Hapus</a></td>
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
<script>
    $(document).ready(function(){
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            var base_url = '<?php echo base_url();?>'
            const name = $(this).data('name');
            const code = $(this).data('code');
            const type = $(this).data('type');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
            const size = $(this).data('size');
            const supplier = $(this).data('supplier');
            const merk = $(this).data('merk');

            // Convert to Rupiah            
            var	number_string = price.toString(),

            sisa 	= number_string.length % 3,
            rupiah2 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah2 += separator + ribuan.join('.');
            }

            // Set data to Form Edit
            $('#dataItems').attr('action', base_url + '/items/' + id + '/update');
            $('#checkOuts').attr('action', base_url + '/check_out/' + id + '/update');
            $('#checkIns').attr('action', base_url + '/check_in/' + id + '/update');
            $('#services').attr('action', base_url + '/services/' + id + '/update');
            $('.product_name').val(name);
            $('.product_code').val(code);
            $('.product_price2').val('Rp. ' + rupiah2);
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
            $('#typeItems').attr('action', base_url + '/type_items/' + id + '/update');
            $('#merkItems').attr('action', base_url + '/merk_items/' + id + '/update');
            $('#suppliers').attr('action', base_url + '/suppliers/' + id + '/update');
            $('#customers').attr('action', base_url + '/customers/' + id + '/update');
            $('#montirs').attr('action', base_url + '/montirs/' + id + '/update');
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
<?php if($type == 'services'): ?>
<script type="text/javascript">		
    var rupiah3 = document.getElementById('rupiah3');
    rupiah3.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah3.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah3     	= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah3 += separator + ribuan.join('.');
        }

        rupiah3 = split[1] != undefined ? rupiah3 + ',' + split[1] : rupiah3;
        return prefix == undefined ? rupiah3 : (rupiah3 ? 'Rp. ' + rupiah3 : '');
    }
</script>
<script type="text/javascript">		
    var rupiah4 = document.getElementById('rupiah4');
    rupiah4.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah4.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah4     	= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah4 += separator + ribuan.join('.');
        }

        rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
        return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
    }
</script>
<?php else: ?>
<?php endif; ?>
<?= $this->endSection(); ?>