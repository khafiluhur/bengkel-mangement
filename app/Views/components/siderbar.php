<!-- siderbar content-->
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"> <span class="h6">Motekar Jaya Motor</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
        <!-- <i class="fa fa-edit img-circle profile_img"></i> -->
        <img src="<?= base_url(); ?>/images/img.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
        <span>Selamat Datang,</span>
        <h2><?= session()->get('name'); ?></h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="<?= base_url(); ?>/home"><i class="fa fa-home"></i> Dashboard </a>
            </li>
            <?php if(session()->get('level') == '1' ): ?>
                <li><a><i class="fa fa-edit"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url(); ?>/items">Data Barang</a></li>
                        <li><a href="<?= base_url(); ?>/type_items">Jenis Barang</a></li>
                        <li><a href="<?= base_url(); ?>/merk_items">Merek Barang</a></li>
                        <li><a href="<?= base_url(); ?>/suppliers">Supplier</a></li>
                        <li><a href="<?= base_url(); ?>/montirs">Data Montir</a></li>
                        <li><a href="<?= base_url(); ?>/customers">Data Pelanggan</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> Data Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url(); ?>/check_in">Transaksi Barang Masuk</a></li>
                        <!-- <li><a href="<?= base_url(); ?>/check_out">Transaksi Barang Keluar</a></li> -->
                        <li><a href="<?= base_url(); ?>/check_suppliers">Transaksi Barang Keluar</a></li>
                    </ul>
                </li>
                <li><a href="<?= base_url(); ?>/management_user"><i class="fa fa-users"></i> Manajemen User</a>
                </li>
                <li><a><i class="fa fa-table"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url(); ?>/report/historycustomer">Riwayat Service</a></li>
                        <li><a href="<?= base_url(); ?>/report/listitem">Daftar Barang</a></li>
                        <li><a href="<?= base_url(); ?>/report/cardstock">Kartu Stok</a></li>
                    </ul>
                </li>
                <li><a href="<?= base_url(); ?>/"><i class="fa fa-gear"></i>Pengantur</a>
            <?php else: ?>
                <li><a href="<?= base_url(); ?>/check_out"><i class="fa fa-desktop"></i>Transaksi Barang Keluar</a></li>
            <?php endif; ?>
        </ul>
        </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a style="background: red" class="w-100 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url(); ?>/logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
    </div>
</div>
<!-- /siderbar content -->