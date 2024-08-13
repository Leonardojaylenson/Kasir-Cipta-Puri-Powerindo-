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
            text-align: center;
            font-size: 1.5em;
            color: #666;
            margin-top: 20px;
        }

        .row {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 15px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            flex-grow: 1;
        }

        .card-body a {
            text-decoration: none;
            color: inherit;
        }

        .card-body p {
            margin: 5px 0;
            font-size: 1em;
        }

        .statust {
            margin-left: 20px;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .btn {
            padding: 5px 10px;
            border-radius: 20px;
            color: #fff;
            font-size: 0.9em;
            text-align: center;
        }

        .btn-danger { background-color: #dc3545; }
        .btn-info { background-color: #17a2b8; }
        .btn-success { background-color: #28a745; }
        .btn-secondary { background-color: #6c757d; }

        .buttonpe {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 0.9em;
            display: flex;
            align-items: center;
        }

        .buttonpe:hover {
            background-color: #0056b3;
        }

        .buttonpe.fa-check::before {
            content: "\f00c";
            font-family: FontAwesome;
            margin-right: 5px;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
    padding-top: 0; /* Remove top padding */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* Center the modal */
    padding: 20px;
    border: 1px solid #888;
    border-radius: 8px;
    width: 50%; /* Adjust width as needed */
    max-width: 500px; /* Limit max width */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative; /* For positioning the close button */
}

.close {
    color: #aaa;
    position: absolute; /* Position the close button */
    top: 10px;
    right: 10px;
    font-size: 24px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Style for the form elements */
form {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Space between form elements */
}

select {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1em;
}

button {
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-size: 1em;
    cursor: pointer;
    background-color: #007bff;
    color: white;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <?php if (empty($satu)) { ?>
                <div class="col-12">
                    <p class="no-data-message">Tidak Ada Pesanan</p>
                </div>
            <?php } else { ?>
                <?php foreach ($satu as $key) { ?>
                    <div class="card">
                        <div class="card-body text-secondary">
                            <a href="<?=base_url('home/dkeranjang/'.$key->kode_keranjang)?>">
                                <p>Kode Keranjang: <?=$key->kode_keranjang?></p>
                                <p>Total Harga: <?=number_format($key->total_transaksi, 2)?></p>
                            </a>
                        </div>
                        <?php if (session()->get('level') == 1) { ?>
                                <a href="<?=base_url('home/printnota/'.$key->kode_keranjang)?>" target="blank">
                                    <button class="buttonpe fa fa-check">Print Nota</button>
                                    </a>
                            <?php } ?>

                        <div class="statust">
                            <?php
                            $buttonClass = '';
                            switch ($key->status_transaksi) {
                                case 'Pending':
                                    $buttonClass = 'btn-danger';
                                    break;
                                case 'On The Way':
                                    $buttonClass = 'btn-info';
                                    break;
                                case 'Done':
                                    $buttonClass = 'btn-success';
                                    break;
                                default:
                                    $buttonClass = 'btn-secondary';
                                    break;
                            }
                            ?>
                            <div class="btn <?= $buttonClass ?>">
                                <?= $key->status_transaksi ?>
                            </div>

                            <?php if (session()->get('level') == 1 && $key->status_transaksi == 'Pending') { ?>
                                    <button class="buttonpe fa fa-check"  onclick="openModal('<?=$key->id_transaksi?>')">Verifikasi</button>
                            <?php } ?>
                            
                            <?php if (session()->get('id') == $satu[0]->id_user || session()->get('level') == 1) { ?>    
                            <?php if ($key->status_transaksi == 'On The Way') { ?>
                                <a href="<?=base_url('home/statustd/'.$key->id_transaksi)?>">
                                    <button class="buttonpe fa fa-check">Selesai</button>
                                </a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="verificationForm" action="<?=base_url('home/statusto')?>" method="POST">
        <label for="pengantar">Pengantar:</label>
        <select id="pengantar" name="pengantar">
            <option value="">-Pilih-</option>
            <?php foreach ($user as $userItem) { ?> 
                <option value="<?=$userItem->id_user?>"><?=$userItem->username?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="id" value="<?=$key->id_transaksi?>">
        <input type="hidden" id="transactionId" name="transactionId">
        <button type="submit">Apply</button>
    </form>
  </div>
</div>

<script>
    // Modal handling
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    function openModal(id) {
        modal.style.display = "block";
        document.getElementById("transactionId").value = id;
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
</body>
</html>
