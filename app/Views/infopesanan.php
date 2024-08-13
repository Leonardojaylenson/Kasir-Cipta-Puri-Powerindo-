<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .content {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .no-data-message {
        display: flex;
        text-align: center;
        font-size: 1.5em;
        color: #666;
        margin-top: 20px;
        margin-left: auto;
        margin-right: 40px;
    }

    .row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); /* 2 items per row */
        gap: 20px;
    }

    /* Responsive styling */
    @media (max-width: 767px) {
        .row {
            grid-template-columns: 1fr; /* 1 item per row on mobile */
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .row {
            grid-template-columns: repeat(2, 1fr); /* 2 items per row on tablet */
        }
    }

    @media (min-width: 1025px) {
        .row {
            grid-template-columns: repeat(2, 1fr); /* 2 items per row on desktop */
        }
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%; /* Ensure cards fill their container */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 20px;
        display: flex;
        align-items: center;
        text-align: left;
    }

    .dataplacement {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .photobarang > img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
    }

    .datakeranjang {
        flex-grow: 1;
    }

    .datakeranjang p {
        margin: 5px 0;
        font-size: 1em;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        padding: 15px;
        font-size: 1.25em;
        font-weight: bold;
        text-align: center;
    }

    .kelass{
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>
</head>
<body>
<div class="content">
    <div class="animated fadeIn">
    <?php if (empty($satu)) { ?>
        <div class="kelass">
                <div>
                    <p class="no-data-message">Tidak Ada Pesanan</p>
                </div>
        </div>
            <?php } else { ?>
        <div class="row">
            
                <?php foreach ($satu as $key) { ?>
                    <div class="card">
                        <div class="card-body text-secondary">
                            <a href="<?=base_url('home/dkeranjang/'.$key->kode_keranjang)?>" style="text-decoration: none; color: inherit;">
                                <div class="dataplacement">
                                    <div class="photobarang">
                                        <img src="<?=base_url('photo barang/'.$key->foto)?>" alt="Foto Barang">
                                    </div>
                                    <div class="datakeranjang">
                                        <p>Kode Keranjang: <?=$key->kode_keranjang?></p>
                                        <p>Total Harga: <?=number_format($key->total_harga, 2)?></p>
                                        <p>Alamat: <?=$key->alamat?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
