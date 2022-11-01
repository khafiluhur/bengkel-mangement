<!-- Modal content -->
<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if ($type == 'dataItems') : ?>
                <?php $validation = \Config\Services::validation(); ?>
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
                            <input type="text" class="form-control" name="name" placeholder="Nama Barang" <?= old('name'); ?> id="name">
                            <?php if ($validation->getError('name')) { ?>
                                <div class='alert alert-danger mt-2'>
                                    <?= $error = $validation->getError('name'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control" id="rupiah2" name="price" placeholder="Harga" <?= old('price'); ?> id="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ukuran</label>
                            <input type="text" class="form-control" name="size" placeholder="Ukuran" <?= old('size'); ?> id="size">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto Barang</label>
                            <input type="file" class="form-control" name="image" placeholder="Foto Barang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <div class="">
                                <select class="form-control" id="id_type" name="id_type">
                                    <option value="">Pilih Kategori Barang</option>
                                    <?php foreach ($typeitem as $item) : ?>
                                        <option value="<?= $item['id_type'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merk Barang</label>
                            <div class="">
                                <select class="form-control" id="id_merk" name="id_merk">
                                    <option value="">Pilih Merk Barang</option>
                                    <?php foreach ($merkitem as $item) : ?>
                                        <option value="<?= $item['id_merk'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok</label>
                            <input type="number" class="form-control" name="stock" placeholder="Stok" <?= old('stock'); ?> id="stock">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Minimal Stock</label>
                            <input type="number" class="form-control" name="limit_stock" placeholder="Minimal Stok" <?= old('limit_stock'); ?> id="limit_stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'typeItems') : ?>
                <form method="post" action="<?= base_url(); ?>/type_items/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <input type="text" class="form-control" name="name" placeholder="Kategori">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'merkItems') : ?>
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
            <?php elseif ($type == 'suppliers') : ?>
                <form method="post" action="<?= base_url(); ?>/suppliers/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
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
            <?php elseif ($type == 'manajemenUser') : ?>
                <form method="post" action="<?= base_url(); ?>/management_user/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name user</label>
                            <input type="text" class="form-control" name="name" placeholder="Name User">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pekerjaan</label>
                            <div class="">
                                <select class="form-control" id="id_level" name="id_level">
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>

            <?php elseif ($type == 'checkOuts') : ?>
                <form method="post" action="<?= base_url(); ?>/check_out/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control" id="id_item" name="id_item">
                                    <option value="">Pilih</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?= $item['id_item'] ?>" data-stock="<?= $item['stock'] ?>"><?= $item['code'] ?>(<?= $item['name'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Keluar</label>
                            <input type="date" class="form-control product_code" name="date_out" placeholder="Tanggal Keluar" value="">
                        </div>
                        <div id="total_stock" class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control product_code" id="source" name="stock" placeholder="Stock" value="">
                            <p id="message_stock" class="red d-none">Jumlah pembelian melebihi stok tersedia</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button id="button_simpan" type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'montirs') : ?>
                <form method="post" action="<?= base_url(); ?>/montirs/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone</label>
                            <input type="text" class="form-control product_type" name="telepone" placeholder="Telepone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea type="text" class="form-control product_stock" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'services') : ?>
                <form method="post" action="<?= base_url(); ?>/services/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Service</label>
                            <input type="text" class="form-control product_code" name="name" placeholder="Nama Service">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga Service</label>
                            <input type="text" class="form-control product_name" id="rupiah3" name="price" placeholder="Harga Service">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php else : ?>
                <form method="post" action="<?= base_url(); ?>/customers/process">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Customer</label>
                            <input type="text" class="form-control product_code" name="name" placeholder="Nama Customer">
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Ubah <?= $title ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if ($type == 'dataItems') : ?>
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
                            <input type="text" class="form-control product_name" name="name" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control product_price2" id="rupiah1" name="price" placeholder="Harga" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ukuran</label>
                            <input type="text" class="form-control product_size" name="size" placeholder="Ukuran" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto Barang</label>
                            <input type="file" class="form-control product_image" name="image" placeholder="Foto Barang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <div class="">
                                <select class="form-control product_type2" id="id_type" name="id_type" required>
                                    <option value="">Pilih Kategori Barang</option>
                                    <?php foreach ($typeitem as $item) : ?>
                                        <option value="<?= $item['id_type'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merk Barang</label>
                            <div class="">
                                <select class="form-control product_merk2" id="id_merk" name="id_merk" required>
                                    <option value="">Pilih Merk Barang</option>
                                    <?php foreach ($merkitem as $item) : ?>
                                        <option value="<?= $item['id_merk'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Minimal Stock</label>
                            <input type="number" class="form-control product_limit" name="limit_stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'typeItems') : ?>
                <form id="typeItems" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Kategori Barang" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'merkItems') : ?>
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
            <?php elseif ($type == 'suppliers') : ?>
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
            <?php elseif ($type == 'manajemenUser') : ?>
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
                            <label for="exampleInputEmail1">Pekerjaan</label>
                            <div class="">
                                <select class="form-control product_idlevel" id="id_level" name="id_level">
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
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
            <?php elseif ($type == 'checkOuts') : ?>
                <form id="checkOuts" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control product_code" id="id_item" name="id_item">
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?= $item['id_item'] ?>"><?= $item['code'] ?>(<?= $item['name'] ?>)</option>
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
            <?php elseif ($type == 'montirs') : ?>
                <form id="montirs" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Pegawai</label>
                            <input type="text" class="form-control product_code" name="name" placeholder="Nip" disabled>
                            <input type="hidden" class="form-control product_code" name="nip">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone</label>
                            <input type="text" class="form-control product_type" name="telepone" placeholder="Telepone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea type="text" class="form-control product_stock" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php elseif ($type == 'services') : ?>
                <form id="services" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Service</label>
                            <input type="text" class="form-control product_name" name="name" placeholder="Nama Service">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga Service</label>
                            <input type="text" class="form-control product_price2" id="rupiah4" name="price" placeholder="Harga Service">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            <?php else : ?>
                <form id="customers" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Customer</label>
                            <input type="text" class="form-control product_code" name="name" placeholder="Nama Customer">
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

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Hapus <?= $title ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if ($type == 'dataItems') : ?>
                <form id="deleteItems" method="get">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'typeItems') : ?>
                <form id="typeDelete" method="get">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'merkItems') : ?>
                <form id="merkDelete" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'suppliers') : ?>
                <form id="supplierDelete" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'manajemenUser') : ?>
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
                            <label for="exampleInputEmail1">Pekerjaan</label>
                            <div class="">
                                <select class="form-control product_idlevel" id="id_level" name="id_level">
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
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
            <?php elseif ($type == 'checkOuts') : ?>
                <form id="checkOuts" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <div class="">
                                <select class="form-control product_code" id="id_item" name="id_item">
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?= $item['id_item'] ?>"><?= $item['code'] ?>(<?= $item['name'] ?>)</option>
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
            <?php elseif ($type == 'montirs') : ?>
                <form id="montirDelete" method="post" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'services') : ?>
                <form id="servicesDelete" method="get" action="">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'checkIns') : ?>
                <form id="checkInsDelete" method="get">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php elseif ($type == 'checkSuppliers') : ?>
                <form id="checkOutsDelete" method="get">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php else : ?>
                <form id="customerDelete" method="get">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageDelete">Apakah anda yakin ingin menghapus data ?</label> <label class="product_name font-weight-bold"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>