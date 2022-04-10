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
<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
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
                        <ul class="nav navbar-right panel_toolbox">
                            <?php if($type == 'dataItems'): ?>
                                <li><button class="btn-create btn btn-primary btn-sm" style="color: white" data-toggle="modal" data-code="<?php echo $new_code; ?>" data-target="#createModal">Tambah</button></li>
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
                                        <?php if($type == 'dataItems'): ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Ukuran</th>
                                                    <th>Harga</th>
                                                    <th>Stock</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$item['code']?></td>
                                                        <td><?=$item['name']?></td>
                                                        <td><?=$item['size']?></td>
                                                        <td><?="Rp. " . number_format($item['price'],0,',','.');?></td>
                                                        <td><?=$item['stock']?></td>
                                                        <td><a href="" class="btn-edit" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_item']?>" data-code="<?=$item['code']?>" data-name="<?=$item['name']?>" data-price="<?=$item['price']?>" data-image="<?=$item['image']?>" data-type="<?=$item['id_type']?>" data-supplier="<?=$item['id_supplier']?>" data-merk="<?=$item['id_merk']?>" data-stock="<?=$item['stock']?>" data-size="<?=$item['size']?>">Ubah</a> | <a href="<?= base_url('items/'.$item['id_item'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'typeItems'): ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis Barang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$item['name']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_type']?>" data-name="<?=$item['name']?>">Ubah</a> | <a href="<?= base_url('type_items/'.$item['id_type'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'merkItems'): ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Merk Barang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$item['name']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_merk']?>" data-name="<?=$item['name']?>">Ubah</a> | <a href="<?= base_url('merk_items/'.$item['id_merk'].'/delete'); ?>">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php elseif($type == 'suppliers'): ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Supplier</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Nama PIC</th>
                                                    <th>Telepone PIC</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
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
                                                    <th>No</th>
                                                    <th>Nomor Pegawai</th>
                                                    <th>Nama</th>
                                                    <th>Telephone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$item['nip']?></td>
                                                        <td><?=$item['nama']?></td>
                                                        <td><?=$item['telepone']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-id="<?=$item['id']?>" data-code="<?=$item['nip']?>" data-name="<?=$item['nama']?>" data-type="<?=$item['telepone']?>" data-stock="<?=$item['alamat']?>" data-toggle="modal" data-target="#editModal" >Ubah</a> | <a href="">Hapus</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php else: ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Type Motor</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$item['nama']?></td>
                                                        <td><?=$item['plat_nomor']?></td>
                                                        <td><?=$item['type_motor']?></td>
                                                        <td><a href="" class="btn-edit-montir" data-id="<?=$item['id']?>" data-code="<?=$item['nama']?>" data-name="<?=$item['plat_nomor']?>" data-type="<?=$item['type_motor']?>" data-toggle="modal" data-target="#editModal" >Ubah</a> | <a href="">Hapus</a></td>
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
            const type = $(this).data('type');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
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
            $('#dataItems').attr('action', base_url + '/items/' + id + '/update');
            $('#checkOuts').attr('action', base_url + '/check_out/' + id + '/update');
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
            console.log($(this).data());
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
<?php if($type == 'dataItems'): ?>
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