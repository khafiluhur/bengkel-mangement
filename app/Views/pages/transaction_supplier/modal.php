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
            <form method="post" action="<?= base_url(); ?>/check_suppliers/process">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <div class="">
                            <select class="form-control" id="id_item" name="id_item">
                                <option value="">Pilih</option>
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="text" class="form-control" id="rupiah" name="price" placeholder="Harga" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Beli</label>
                        <input type="number" class="form-control" name="total_stock" placeholder="Jumlah Beli">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>