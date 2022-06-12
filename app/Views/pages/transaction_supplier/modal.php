<!-- Modal content -->
<!-- Modal -->
<div class="modal fade" id="createTransactionModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Tambah Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if($type == 'checkSuppliers'): ?>
                <form method="post" action="<?= base_url(); ?>/check_suppliers/process">
            <?php else: ?>
                <form method="post" action="<?= base_url(); ?>/check_in/process">   
            <?php endif; ?>
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <div class="">
                            <select class="form-control" id="id_item" name="id_item">
                                <option value="">Pilih Barang</option>
                                <?php foreach ($items as $item) : ?>
                                    <option data-code="<?=$item['code']?>" data-price="<?=$item['price']?>" data-stock="<?=$item['stock']?>" value="<?=$item['id_item']?>"><?=$item['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Barang</label>
                        <input type="text" class="form-control" name="code" placeholder="Kode Barang" disabled>
                        <input type="hidden" required="required" name="code" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok tersedia</label>
                        <input type="text" class="form-control" name="stock" placeholder="Stok tersedia" disabled>
                        <input type="hidden" class="form-control product_code" name="codeTR" class="form-control" value="">
                    </div>
                    <?php if($type == 'checkSuppliers'): ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Satuan</label>
                        <input type="text" class="form-control" id="rupiah" name="price" placeholder="Harga" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Pasang</label>
                        <div class="">
                            <select class="form-control" id="plug" name="plug">
                                <?php foreach ($othercosts as $item) : ?>
                                    <option value="<?=$item['price']?>"><?= "Rp. " . number_format($item['price'],0,',','.'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diskon Barang</label>
                        <div class="">
                            <select class="form-control" id="discount" name="discount">
                                <?php foreach ($discounts as $item) : ?>
                                    <option value="<?=$item['value']?>"><?=$item['value']?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="total_stock" class="form-group">
                        <label for="exampleInputEmail1">Jumlah Beli</label>
                        <input type="number" class="form-control" id="source" name="total_stock" min="0" placeholder="Jumlah Beli" oninput="this.value = Math.abs(this.value)">
                        <p id="message_stock" class="red d-none">Jumlah pembelian melebihi stok tersedia</p>
                    </div>
                    <div id="total_stock" class="form-group d-none">
                        <label for="exampleInputEmail1">Total</label>
                        <p id="" class="red" style="font-size: 20px;">Rp. 0</p>
                    </div>
                    <?php else: ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="text" class="form-control" id="rupiah" name="price1" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Supplier</label>
                        <div class="">
                            <select class="form-control" id="" name="id_supplier">
                                <option value="">Pilih Supplier</option>
                                <?php foreach ($suppliers as $item) : ?>
                                    <option value="<?=$item['id_supplier']?>"><?=$item['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Beli</label>
                        <input type="number" class="form-control" name="total_stock" min="0" placeholder="Jumlah Beli" oninput="this.value = Math.abs(this.value)">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="button_simpan" type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editTransactionModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Edit Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if($type == 'checkSuppliers'): ?>
                <form id="checkSuppliers" method="post" action="<?= base_url(); ?>/check_suppliers/process">
            <?php else: ?>
                <form id="checkIns" method="post">   
            <?php endif; ?>
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <div class="">
                            <select class="form-control product_id" id="id_item" name="id_item" disabled>
                                <option value="">Pilih Barang</option>
                                <?php foreach ($items as $item) : ?>
                                    <option data-code="<?=$item['code']?>" data-price="<?=$item['price']?>" data-stock="<?=$item['stock']?>" value="<?=$item['id_item']?>"><?=$item['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Barang</label>
                        <input type="text" class="form-control product_code" name="code" placeholder="Kode Barang" disabled>
                        <input type="hidden" required="required" name="code" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok tersedia</label>
                        <input type="text" class="form-control product_availabel" name="stock" placeholder="Stok tersedia" disabled>
                        <input type="hidden" class="form-control product_trns" name="codeTR" class="form-control" value="">
                    </div>
                    <?php if($type == 'checkSuppliers'): ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Satuan</label>
                        <input type="text" class="form-control product_price2" id="rupiah1" name="price1" placeholder="Harga" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Pasang</label>
                        <div class="">
                            <select class="form-control product_plug" id="plug" name="plug">
                                <?php foreach ($othercosts as $item) : ?>
                                    <option value="<?=$item['price']?>"><?= "Rp. " . number_format($item['price'],0,',','.'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diskon Barang</label>
                        <div class="">
                            <select class="form-control product_discount" id="discount" name="discount">
                                <?php foreach ($discounts as $item) : ?>
                                    <option value="<?=$item['value']?>"><?=$item['value']?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="total_stock1" class="form-group">
                        <label for="exampleInputEmail1">Jumlah Beli</label>
                        <input type="number" class="form-control product_stock" id="source1" name="total_stock" min="0" placeholder="Jumlah Beli" oninput="this.value = Math.abs(this.value)">
                        <p id="message_stock1" class="red d-none">Jumlah pembelian melebihi stok tersedia</p>
                    </div>
                    <?php else: ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="text" class="form-control product_price2" id="rupiah1" name="price" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Supplier</label>
                        <div class="">
                            <select class="form-control product_supplier" id="id_supplier" name="id_supplier">
                                <option value="">Pilih Supplier</option>
                                <?php foreach ($suppliers as $item) : ?>
                                    <option data-code="<?=$item['code']?>" value="<?=$item['id_supplier']?>"><?=$item['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Beli</label>
                        <input type="number" class="form-control product_stock" min="0" name="total_stock" placeholder="Jumlah Beli" oninput="this.value = Math.abs(this.value)">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="button_simpan1" type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>