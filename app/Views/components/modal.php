<!-- Modal content -->
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><?=$title?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if($type == 'dataItems'): ?>
                <form method="post" action="<?= base_url(); ?>/items/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <input type="text" class="form-control product_code" name="code" placeholder="Kode Barang" value="" disabled>
                            <input type="hidden" class="form-control product_code" name="code" placeholder="Kode Barang" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control" id="rupiah" name="price" placeholder="Harga">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ukuran</label>
                            <input type="text" class="form-control" name="size" placeholder="Ukuran">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto Barang</label>
                            <input type="file" class="form-control" name="image" placeholder="Foto Barang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Barang</label>
                            <div class="">
                                <select class="form-control" id="id_type" name="id_type">
                                    <option value="">Pilih</option>
                                    <?php foreach ($typeitem as $item) : ?>
                                        <option value="<?=$item['id_type']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merk Barang</label>
                            <div class="">
                                <select class="form-control" id="id_merk" name="id_merk">
                                    <option value="">Pilih</option>
                                    <?php foreach ($merkitem as $item) : ?>
                                        <option value="<?=$item['id_merk']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Supplier</label>
                            <div class="">
                                <select class="form-control" id="id_supplier" name="id_supplier">
                                    <option value="">Pilih</option>
                                    <?php foreach ($supplier as $item) : ?>
                                        <option value="<?=$item['id_supplier']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok</label>
                            <input type="number" class="form-control" name="stock" placeholder="Stok">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'typeItems'): ?>
                <form method="post" action="<?= base_url(); ?>/type_items/process">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Barang</label>
                            <input type="text" class="form-control" name="name" placeholder="Jenis Barang">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'merkItems'): ?>
                <form method="post" action="<?= base_url(); ?>/merk_items/process">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merk Barang</label>
                            <input type="text" class="form-control" name="name" placeholder="Merk Barang">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'suppliers'): ?>
                <form method="post" action="<?= base_url(); ?>/suppliers/process">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Supplier</label>
                            <input type="text" class="form-control" name="code" placeholder="Kode Supplier">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Supplier</label>
                            <input type="text" class="form-control" name="name" placeholder="Name Supplier">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama PIC</label>
                            <input type="text" class="form-control" name="name_pic" placeholder="Nama PIC">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone PIC</label>
                            <input type="text" class="form-control" name="telepone_pic" placeholder="Telephone PIC">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'manajemenUser'): ?>
                <form method="post" action="<?= base_url(); ?>/management_user/process">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name user</label>
                            <input type="text" class="form-control" name="name" placeholder="Name User">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Level</label>
                            <div class="">
                                <select class="form-control" id="id_level" name="id_level">
                                    <option value="">Pilih</option>
                                    <option value="1">Admin</option>
                                    <option value="3">Kasir</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'checkIns'): ?>
                <form method="post" action="<?= base_url(); ?>/check_in/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control" id="id_item" name="id_item">
                                    <option value="">Pilih</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?=$item['id_item']?>"><?=$item['code']?>(<?=$item['name']?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Supplier</label>
                            <div class="">
                                <select class="form-control" id="id_supplier" name="id_supplier">
                                    <option value="">Pilih</option>
                                    <?php foreach ($suppliers as $item) : ?>
                                        <option value="<?=$item['id_supplier']?>"><?=$item['code']?>(<?=$item['name']?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control product_code" name="stock" placeholder="Stock" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control" id="rupiah" name="price" placeholder="Harga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'checkOuts'): ?>
                <form method="post" action="<?= base_url(); ?>/check_out/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control" id="id_item" name="id_item">
                                    <option value="">Pilih</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?=$item['id_item']?>"><?=$item['code']?>(<?=$item['name']?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Keluar</label>
                            <input type="date" class="form-control product_code" name="date_out" placeholder="Tanggal Keluar" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control product_code" name="stock" placeholder="Stock" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php else: ?>
                <form method="post" action="<?= base_url(); ?>/customers/process">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Customer</label>
                            <input type="text" class="form-control product_code" name="name" placeholder="Nomor Customer">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Plat Nomor</label>
                            <input type="text" class="form-control product_name" name="plat_nomor" placeholder="Plat Nomor">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type Motor</label>
                            <input type="text" class="form-control product_type" name="type_motor" placeholder="Type Motor">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><?=$title?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if($type == 'dataItems'): ?>
                <form id="dataItems" method="post">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <input type="text" class="form-control product_code" name="code" placeholder="Kode Barang" value="" disabled>
                            <input type="hidden" class="form-control product_code" name="code" placeholder="Kode Barang" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control product_price2" id="rupiah1" name="price" placeholder="Harga">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto Barang</label>
                            <input type="file" class="form-control product_image" name="image" placeholder="Foto Barang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Barang</label>
                            <div class="">
                                <select class="form-control product_type2" id="id_type" name="id_type">
                                    <option value="">Pilih</option>
                                    <?php foreach ($typeitem as $item) : ?>
                                        <option value="<?=$item['id_type']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merk Barang</label>
                            <div class="">
                                <select class="form-control product_merk2" id="id_merk" name="id_merk">
                                    <option value="">Pilih</option>
                                    <?php foreach ($merkitem as $item) : ?>
                                        <option value="<?=$item['id_merk']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Supplier</label>
                            <div class="">
                                <select class="form-control product_supplier2" id="id_supplier" name="id_supplier">
                                    <option value="">Pilih</option>
                                    <?php foreach ($supplier as $item) : ?>
                                        <option value="<?=$item['id_supplier']?>"><?=$item['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok</label>
                            <input type="number" class="form-control product_stock2" name="stock" placeholder="Stok">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'typeItems'): ?>
                <form id="typeItems" method="post" action="">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Barang</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Jenis Barang" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'merkItems'): ?>
                <form id="merkItems" method="post" action="">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merk Barang</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Merk Barang" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'suppliers'): ?>
                <form id="suppliers" method="post" action="">
                <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Supplier</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Nama Supplier" value="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama PIC</label>
                            <input type="text" class="form-control product_price2" name="name_pic" placeholder="Nama PIC" value="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone PIC</label>
                            <input type="text" class="form-control product_stock" name="telepone_pic" placeholder="Telephone PIC" value="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control product_type" name="alamat" placeholder="Alamat" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'manajemenUser'): ?>
                <form id="managementuser" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name user</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Name User">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control product_username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control product_email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Level</label>
                            <div class="">
                                <select class="form-control product_idlevel" id="id_level" name="id_level">
                                    <option value="">Pilih</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Supplier</option>
                                    <option value="3">Kasir</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'checkIns'): ?>
                <form id="checkIns" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control product_code" id="id_item" name="id_item">
                                    <option value="">Pilih</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?=$item['id_item']?>"><?=$item['code']?>(<?=$item['name']?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Supplier</label>
                            <div class="">
                                <select class="form-control product_name" id="id_supplier" name="id_supplier">
                                    <option value="">Pilih</option>
                                    <?php foreach ($suppliers as $item) : ?>
                                        <option value="<?=$item['id_supplier']?>"><?=$item['code']?>(<?=$item['name']?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control product_stock2" name="stock" placeholder="Stock" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control product_price2" id="rupiah1" name="price" placeholder="Harga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'checkOuts'): ?>
                <form id="checkOuts" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control product_code" id="id_item" name="id_item">
                                    <option value="">Pilih</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?=$item['id_item']?>"><?=$item['code']?>(<?=$item['name']?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Keluar</label>
                            <input type="date" class="form-control product_name" name="date_out" placeholder="Tanggal Keluar" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control product_stock" name="stock" placeholder="Stock" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif($type == 'montirs'): ?>
                <form id="montirs" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Pegawai</label>
                            <input type="text" class="form-control product_code" name="nip" placeholder="Nomor Pegawai">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control product_name" name="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone</label>
                            <input type="text" class="form-control product_type" name="telepone" placeholder="Telepone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control product_stock" name="alamat" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php else: ?>
                <form id="customers" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Customer</label>
                            <input type="text" class="form-control product_code" name="nama" placeholder="Nama Customer">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Plat Nomor</label>
                            <input type="text" class="form-control product_name" name="plat_nomor" placeholder="Plat Nomor">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type Motor</label>
                            <input type="text" class="form-control product_type" name="type_motor" placeholder="Type Motor">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>