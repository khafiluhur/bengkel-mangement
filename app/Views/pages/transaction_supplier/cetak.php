<!DOCTYPE html>
<html lang="en" >
<head>
 <meta charset="UTF-8">
 <title>Invoice</title>
 <link rel="stylesheet" href="css/style.css">
 <style>
     #hiderow,
.delete {
    display: none;
}

* {
    margin: 0;
    padding: 0;
}

body {
    font: 14px/1.4 Georgia, serif;
}

#page-wrap {
    width: 800px;
    margin: 0 auto;
}

textarea {
    border: 0;
    font: 14px Georgia, Serif;
    overflow: hidden;
    resize: none;
}

table {
    border-collapse: collapse;
}

table td,
table th {
    border: 1px solid black;
    padding: 5px;
}

#header {
    height: 15px;
    width: 100%;
    margin: 20px 0;
    text-align: center;
    color: black;
    font: bold 15px Helvetica, Sans-Serif;
    text-decoration: uppercase;
    letter-spacing: 20px;
    padding: 8px 0px;
}

#address {
    width: 500px;
    height: 150px;
    float: left;
}

#logo {
    text-align: right;
    float: right;
    position: relative;
    margin-top: 25px;
    border: 1px solid #fff;
    max-width: 540px;
    max-height: 100px;
    overflow: hidden;
}

#logo:hover,
#logo.edit {
    border: 1px solid #000;
    margin-top: 0px;
    max-height: 125px;
}

#logoctr {
    display: none;
}

#logo:hover #logoctr,
#logo.edit #logoctr {
    display: block;
    text-align: right;
    line-height: 25px;
    background: #eee;
    padding: 0 5px;
}

#logohelp {
    text-align: left;
    display: none;
    font-style: italic;
    padding: 10px 5px;
}

#logohelp input {
    margin-bottom: 5px;
}

.edit #logohelp {
    display: block;
}

.edit #save-logo,
.edit #cancel-logo {
    display: inline;
}

.edit #image,
#save-logo,
#cancel-logo,
.edit #change-logo,
.edit #delete-logo {
    display: none;
}

#customer-title {
    font-size: 20px;
    font-weight: bold;
    float: left;
}

#meta {
    margin-top: 1px;
    width: 266px;
    float: right;
}

#meta td {
    text-align: right;
}

#meta td.meta-head {
    text-align: left;
    background: #eee;
}

#meta td textarea {
    width: 100%;
    height: 20px;
    text-align: right;
}

#items {
    clear: both;
    width: 100%;
    margin: 30px 0 0 0;
    border: 1px solid black;
    padding-top: 30px;
}

#items th {
    background: #eee;
}

#items textarea {
    width: 80px;
    height: 50px;
}

#items tr.item-row td {
    border: 0;
    vertical-align: top;
}

#items td.description {
    width: 300px;
}

#items td.item-name {
    width: 175px;
}

#items td.description textarea,
#items td.item-name textarea {
    width: 100%;
}

#items td.total-line {
    border-right: 0;
    text-align: right;
}

#items td.total-value {
    border-left: 0;
    padding: 10px;
}

#items td.total-value textarea {
    height: 20px;
    background: none;
}

#items td.balance {
    background: #eee;
}

#items td.blank {
    border: 0;
}

#terms {
    text-align: center;
    margin: 20px 0 0 0;
}

#terms h5 {
    text-transform: uppercase;
    font: 13px Helvetica, Sans-Serif;
    letter-spacing: 10px;
    border-bottom: 1px solid black;
    padding: 0 0 8px 0;
    margin: 0 0 8px 0;
}

#terms textarea {
    width: 100%;
    text-align: center;
}

textarea:hover,
textarea:focus,
#items td.total-value textarea:hover,
#items td.total-value textarea:focus,
.delete:hover {
    background-color: #EEFF88;
}

.delete-wpr {
    position: relative;
}

.delete {
    display: block;
    color: #000;
    text-decoration: none;
    position: absolute;
    background: #EEEEEE;
    font-weight: bold;
    padding: 0px 3px;
    border: 1px solid;
    top: -6px;
    left: -22px;
    font-family: Verdana;
    font-size: 12px;
}
.cost {
    text-align: center;
}
.qty{
    text-align: center;
}
.price {
    text-align: center;
}
.due {
    text-align: center;
}
.balance {
    text-align: center;
}
.pb-5 {
    padding-bottom: 10px;
    font-size: 14px;
}
.font-weight-bold {
    font-weight: bold
}
 </style>
</head>
<body>
 <html lang="en">
 <head>
  <meta charset='UTF-8'>
 </head>
 <body>
  <div id="page-wrap">
   <p id="header">INVOICE</p>

   <div id="customer">
    <table id="meta">
     <tr>
      <td class="meta-head">Nomor Pelanggan</td>
      <td><?= $transactions[0]->code_customers ?></td>
     </tr>
     <tr>

      <td class="meta-head">Nama Pelanggan</td>
      <td id="date"><?= $transactions[0]->nama_customers ?></td>
     </tr>
     <tr>
      <td class="meta-head">Tipe Motor</td>
      <td class="due"><?= $transactions[0]->type_motor ?>(<?= $transactions[0]->plat_nomor ?>)</td>
     </tr>

    </table>
   </div>

   <div id="customer">
        <table id="meta">
            <tr>
                <td class="meta-head">Nama Montir</td>
                <td id="date"><?= $transactions[0]->name_montirs ?></td>
            </tr>
        </table>
   </div>

   <div id="customer">
    <table id="meta">
     <tr>
      <td class="meta-head">Invoice #</td>
      <td><?= $code ?></td>
     </tr>
     <tr>
      <td class="meta-head">Tanggal</td>
      <td id="date"><?= $transactions[0]->date_trasanction ?></td>
     </tr>

    </table>
   </div>

   <table id="items">
        <tr>
            <th>Item</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>
        </tr>
        <?php foreach($items as $index => $data) { ?> 
            <tr class="item-row">
                <td class="item-name"><?= $data->nama_item ?>
                <?php if($data->plug != "0"): ?>
                    + Pasang
                <?php else: ?>
                <?php endif; ?>
                </td>
                <td class="qty"><?= $data->stock ?></td>
                <td class="price"><?="Rp. " . number_format($data->subtotal,0,',','.');?></td>
            </tr>
        <?php } ?> 
        <?php if($transactions[0]->service != null): ?> 
            <tr class="item-row">
                <td><?= $transactions[0]->service_name ?></td>
                <td></td>
                <td class="price"><?= "Rp. " . number_format($transactions[0]->service_price,0,',','.'); ?></td>
            </tr> 
        <?php else:?>
        <?php endif; ?> 
        <?php if($transactions[0]->service1 != null): ?> 
            <tr class="item-row">
                <td><?= $transactions[0]->service_name1 ?></td>
                <td></td>
                <td class="price"><?= "Rp. " . number_format($transactions[0]->service_price1,0,',','.'); ?></td>
            </tr> 
        <?php else:?>
        <?php endif; ?> 
        <?php if($transactions[0]->service2 != null): ?> 
            <tr class="item-row">
                <td><?= $transactions[0]->service_name2 ?></td>
                <td></td>
                <td class="price"><?= "Rp. " . number_format($transactions[0]->service_price2,0,',','.'); ?></td>
            </tr> 
        <?php else:?>
        <?php endif; ?> 
        <tr>
            <td colspan="2" class="balance">Total</td>
            <td colspan="1" class="total-value balance due"><?="Rp. " . number_format($transactions[0]->total_pay,0,',','.'); ?></td>
        </tr>
   </table>

   <br><br><br><br>
   <div id="terms">
    <p class="pb-5 font-weight-bold">Barang yang sudah dibeli tidak dapat kembalikan</p>
    <h5><?= $sites[0]->name_site ?></h5>
    <p class="pb-5"><?= $sites[0]->address_site ?></p>
    <p><?= $sites[0]->telepone_site ?></p>
   </div>

  </div>
 </body>
 </html>
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script  src="<?php echo base_url('js/index.js'); ?>"></script>
</body>
</html>