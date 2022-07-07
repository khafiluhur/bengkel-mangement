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
                            <li><button class="btn-create btn btn-primary btn-sm" style="color: white" data-toggle="modal" data-code="<?php echo $new_code; ?>" data-target="#createModal">Tambah</button></li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-items" class="table table-striped table-bordered" style="width:100%">                
                                            <thead>
                                                <tr>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kategori</th>
                                                    <th>Merk</th>
                                                    <th>Ukuran</th>
                                                    <th>Stock</th>
                                                    <th>Min Stock</th>
                                                    <th>Harga Jual</th>
                                                    <th>Total</th>
                                                    <th>Pilihan</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($items as $item) : ?>
                                                    <?php if($item['stock'] <= $item['limit_stock'] ): ?>
                                                        <tr>
                                                        <td class="red"><?=$item['code']?></td>
                                                        <td class="red"><?=$item['name']?></td>
                                                        <?php if($item['id_type'] == 0): ?>
                                                            <td class="red">-</td>
                                                        <?php else: ?>
                                                            <td class="red"><?=$item['name_type']?></td>
                                                        <?php endif; ?>
                                                        <?php if($item['id_merk'] == 0): ?>
                                                            <td class="">-</td>
                                                        <?php else: ?>
                                                            <td class="red"><?=$item['name_merk']?></td>
                                                        <?php endif; ?>
                                                            <td class="red"><?=$item['size']?></td>
                                                            <td class="red"><?=$item['stock']?></td>
                                                            <td class="red"><?=$item['limit_stock']?></td>
                                                            <td class="red"><?=number_format($item['price'],0,',','.');?></td>
                                                            <td class="red"><?=number_format($item['stock'] * $item['price'],0,',','.');?></td>
                                                            <td class="red"><a href="" class="btn-edit" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_item']?>" data-code="<?=$item['code']?>" data-name="<?=$item['name']?>" data-price="<?=$item['price']?>" data-image="<?=$item['image']?>" data-type="<?=$item['id_type']?>" data-merk="<?=$item['id_merk']?>" data-stock="<?=$item['stock']?>" data-size="<?=$item['size']?>" data-limit="<?=$item['limit_stock']?>"><i class="fa fa-pencil red"></i></a> | <a data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash red"></i></a></td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <tr>
                                                        <td><?=$item['code']?></td>
                                                        <td><?=$item['name']?></td>
                                                        <?php if($item['id_type'] == 0): ?>
                                                            <td class="">-</td>
                                                        <?php else: ?>
                                                            <td class=""><?=$item['name_type']?></td>
                                                        <?php endif; ?>
                                                        <?php if($item['id_merk'] == 0): ?>
                                                            <td class="">-</td>
                                                        <?php else: ?>
                                                            <td class=""><?=$item['name_merk']?></td>
                                                        <?php endif; ?>
                                                            <td><?=$item['size']?></td>
                                                            <td><?=$item['stock']?></td>
                                                            <td class=""><?=$item['limit_stock']?></td>
                                                            <td><?=number_format($item['price'],0,',','.');?></td>
                                                            <td><?=number_format($item['stock'] * $item['price'],0,',','.');?></td>
                                                            <td>
                                                                <a href="" class="btn-edit" data-toggle="modal" data-target="#editModal" data-id="<?=$item['id_item']?>" data-code="<?=$item['code']?>" data-name="<?=$item['name']?>" data-price="<?=$item['price']?>" data-image="<?=$item['image']?>" data-type="<?=$item['id_type']?>" data-merk="<?=$item['id_merk']?>" data-stock="<?=$item['stock']?>" data-size="<?=$item['size']?>" data-limit="<?=$item['limit_stock']?>"><i class="fa fa-pencil"></i></a>
                                                                <?php if($item['count_suppiler_item'] == 0 && $item['count_check_in_item'] == 0): ?>
                                                                    | <a href="" class="btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="<?=$item['id_item']?>" data-name="<?=$item['name']?>"><i class="fa fa-trash"></i></a>
                                                                <?php else: ?>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?> 
                                            </tbody>
                                            <tfoot style="background-color: rgba(0,0,0,.05)">
                                                <tr>
                                                    <th colspan="7" style="text-align:center">Total:</th>
                                                    <th colspan="3" style="text-align:center"></th>
                                                </tr>
                                            </tfoot>
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
            const limit = $(this).data('limit');
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
            $('.product_limit').val(limit);
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

        $('.btn-delete').on('click', function(){
            const id = $(this).data('id');
            var base_url = '<?php echo base_url();?>'
            const name = $(this).data('name');
            $('#deleteItems').attr('action', base_url + '/items/' + id + '/delete');
            $('.product_name').html(name);
            $('#deleteModal').modal('show');
        });
    });
</script>
<script type="text/javascript">		
    var rupiah = document.getElementById('rupiah2');
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
    $(document).ready(function () {
        $('#datatable-items').DataTable({
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
                var rupiah = '';
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\.,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
    
                // Total over all pages
                total = api
                    .column(8)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                
                /* Fungsi formatRupiah */
                var angkarev = total.toString().split('').reverse().join('');
                for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                var rupiah1 = rupiah.split('',rupiah.length-1).reverse().join('');
                var rupiah2 = rupiah1.split(']')
                
                // Update footer
                $(api.column(8).footer()).html(rupiah2[0]);
            },
        });
    });
</script>
<?= $this->endSection(); ?>