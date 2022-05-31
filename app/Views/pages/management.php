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
                            <li><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Tambah User</button></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name User</th>
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td>
                                                    <?=$i++?>
                                                </td>
                                                <td>
                                                    <?=$user['name']?>
                                                </td>
                                                <td>
                                                    <?=$user['username']?>
                                                </td>
                                                <td>
                                                    <?php if($user['id_level'] == 1) : ?>
                                                        Admin
                                                    <?php else: ?>
                                                        Kasir
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="" class="btn-edit" data-toggle="modal" data-target="#editModal" data-id="<?=$user['id']?>" data-name="<?=$user['name']?>" data-username="<?=$user['username']?>" data-email="<?=$user['email']?>" data-idlevel="<?=$user['id_level']?>">Ubah</a> | <a href="<?= base_url('management_user/'.$user['id'].'/delete'); ?>">Hapus</a>
                                                </td>
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
            const name = $(this).data('name');
            const username = $(this).data('username');
            const email = $(this).data('email');
            const idlevel = $(this).data('idlevel');
            var base_url = '<?php echo base_url();?>'
            // Set data to Form Edit
            $('#managementuser').attr('action', base_url + '/management_user/' + id + '/update');
            $('.product_name').val(name);
            $('.product_username').val(username);
            $('.product_email').val(email);
            $('.product_idlevel').val(idlevel);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>