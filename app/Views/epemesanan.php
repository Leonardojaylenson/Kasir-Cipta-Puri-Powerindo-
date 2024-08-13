<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart and Modal Example</title>
    <style>
        .sspemesanan {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .sspemesanan .item {
            flex: 1 0 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            box-sizing: border-box;
            padding: 10px;
        }
        .sspemesanan .item .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .sspemesanan .item .card .photobarang {
            height: 210px;
            object-fit: cover;
        }
        .sspemesanan .item .card .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }
        .quantity-control button {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }
        .quantity-control input {
            width: 60px;
            text-align: center;
        }
        .quantity-control .qty-reset {
            background-color: red;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 5px 10px;
            cursor: pointer;
            margin-left: 5px;
        }
        .quantity-control .qty-reset:hover {
            background-color: darkred;
        }
        .cart-container {
            position: fixed;
            bottom: 0;
            width: 50%;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: none;
            flex-direction: column;
            z-index: 1000;
        }
        .cart-header {
            padding: 10px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-items {
            max-height: 200px;
            overflow-y: auto;
        }
        .cart-item {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-summary {
            padding: 10px;
            background-color: #e9ecef;
            margin-bottom: 60px;
        }
        .cart-display {
    display: flex; /* Ensure it is always displayed */
    justify-content: space-between;
    align-items: center;
    border: 1px solid black;
    border-radius: 50px;
    padding: 10px 20px;
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: white;
    z-index: 1000;
}
        .lihat-item-btn {
            background-color: green;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 5px 10px;
            cursor: pointer;
            margin-left: 5px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            position: relative;
            display: flex;
            flex-direction: column;
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
        .payment-btn {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            z-index: 10;
        }
        .save-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            z-index: 10;
        }
        @media only screen and (max-width: 768px) {
            .sspemesanan .item {
                flex: 1 0 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
            .cart-display {
                width: 100%;
                left: 0;
                transform: none;
                padding: 10px;
            }
            .modal-content {
                width: 90%;
            }
        }
        @media only screen and (max-width: 480px) {
            .sspemesanan .item {
                flex: 1 0 100%;
                max-width: 100%;
            }
            .sspemesanan .item .card {
                padding: 5px;
            }
            .quantity-control input {
                width: 40px;
            }
            .cart-display span {
                font-size: 14px;
            }
            .save-btn,
            .payment-btn {
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">UI Elements</a></li>
                                <li class="active">Grids</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="sspemesanan">
            <?php foreach ($satu as $key) { 
    $quantity = 0; // Default quantity
    $itemInCart = false;

    foreach ($tiga as $cartItem) {
        if ($cartItem->nama_barang == $key->nama_barang) {
            $quantity = $cartItem->quantity;
            $itemInCart = true;
            break;
        }
    }
?>
<div class="item" data-id="<?= $key->id_barang ?>">
    <div class="card">
        <img class="card-img-top photobarang" src="<?= base_url('photo barang/'.$key->foto) ?>" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title mb-3"><?= $key->nama_barang ?></h4>
            <p class="card-text"><?= "Rp " . number_format($key->harga_jual, 2, ',', '.') ?></p>
            <p class="card-text stok">Stok <?= $key->stok ?></p>
            <?php if (session()->get('level') == 1) { ?>
                <div class="quantity-control" data-id="<?= $key->id_barang ?>" data-nama="<?= $key->nama_barang ?>">
                    <button class="qty-minus" data-id="<?= $key->id_barang ?>">-</button>
                    <input type="text" class="qty-input" data-id="<?= $key->id_barang ?>" value="<?= $quantity ?>" readonly>
                    <button class="qty-plus" data-id="<?= $key->id_barang ?>">+</button>
                    <?php if ($itemInCart) { ?>
                        <button class="qty-reset" data-id="<?= $key->id_barang ?>" data-idkeranjang="<?= $cartItem->id_Keranjang ?>">X</button>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <button class="beli-btn" data-id="<?= $key->id_barang ?>" data-nama="<?= $key->nama_barang ?>" data-harga="<?= $key->harga_jual ?>" data-stok="<?= $key->stok ?>">Beli</button>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
            </div>
        </div>

        <div class="cart-container" id="cartContainer">
            <div class="cart-header">
                <h4>Cart</h4>
                <button id="closeCart">X</button>
            </div>
            <div class="cart-items" id="cartItems"></div>
            <div class="cart-summary" id="cartSummary">
                <div class="cart-display" id="cartDisplay">
                    <span>Total Items: 0</span>
                    <span>Total Price: Rp 0</span>
                    <button id="lihatItem" class="lihat-item-btn">Lihat Item</button>
                </div>
            </div>
            <button id="saveCart" class="save-btn">Simpan</button>
            <button id="checkoutCart" class="payment-btn">Bayar</button>
        </div>
    </div>

    <!-- Modal for viewing cart items -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h4>Cart Items</h4>
            <div id="modalCartItems"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartContainer = document.getElementById('cartContainer');
            const cartItemsDiv = document.getElementById('cartItems');
            const cartDisplay = document.getElementById('cartDisplay');
            const modal = document.getElementById('cartModal');
            const modalCartItems = document.getElementById('modalCartItems');
            const closeModal = document.getElementById('closeModal');
            const lihatItemBtn = document.getElementById('lihatItem');
            const closeCart = document.getElementById('closeCart');
            const saveCartBtn = document.getElementById('saveCart');
            const checkoutCartBtn = document.getElementById('checkoutCart');
            
            function toggleQuantityControls(id, show) {
                const controls = document.querySelector(`.quantity-control[data-id="${id}"]`);
                const beliBtn = document.querySelector(`.beli-btn[data-id="${id}"]`);
                if (controls) {
                    controls.style.display = show ? 'flex' : 'none';
                }
                if (beliBtn) {
                    beliBtn.style.display = show ? 'none' : 'block';
                }
            }

            function updateCartDisplay() {
        fetch('<?= base_url('home/get_cart_items') ?>')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const items = data.items;
                let totalItems = 0;
                let totalPrice = 0;
                cartItemsDiv.innerHTML = '';
                items.forEach(item => {
                    totalItems += item.quantity;
                    totalPrice += item.quantity * item.harga_jual;
                    cartItemsDiv.innerHTML += `
                        <div class="cart-item" data-id="${item.id_keranjang}">
                            <span>${item.nama_barang}</span>
                            <button class="qty-minus" data-id="${item.id_keranjang}">-</button>
                            <input type="text" class="qty-input" data-id="${item.id_keranjang}" value="${item.quantity}" readonly>
                            <button class="qty-plus" data-id="${item.id_keranjang}">+</button>
                            <button class="beli-btn" data-id="${item.id_keranjang}" data-nama="${item.nama_barang}" data-harga="${item.harga_jual}" data-stok="${item.stok}">Beli</button>
                        </div>
                    `;
                });
                cartDisplay.innerHTML = `
                    <span>Total Items: ${totalItems}</span>
                    <span>Total Price: Rp ${totalPrice.toFixed(2)}</span>
                `;
            } else {
                console.error('Failed to fetch cart items');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function resetItemQuantity(idKeranjang) {
        fetch(`<?= base_url('home/delete_cart_item/') ?>/${idKeranjang}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Item successfully removed from cart');
                updateCartDisplay();
            } else {
                console.error('Failed to remove item from cart');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateItemQuantity(idKeranjang, quantity) {
        fetch('<?= base_url('home/update_cart_item') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: idKeranjang,
                quantity: quantity
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateCartDisplay();
            } else {
                console.error('Failed to update cart item');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    document.querySelectorAll('.qty-minus').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const input = document.querySelector(`.qty-input[data-id="${id}"]`);
            let quantity = parseInt(input.value);
            if (quantity > 0) {
                quantity--;
                input.value = quantity;
                if (quantity === 0) {
                    resetItemQuantity(id);
                } else {
                    updateItemQuantity(id, quantity);
                }
            }
        });
    });

    document.querySelectorAll('.qty-plus').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const input = document.querySelector(`.qty-input[data-id="${id}"]`);
            let quantity = parseInt(input.value);
            quantity++;
            input.value = quantity;
            updateItemQuantity(id, quantity);
        });
    });

    document.querySelectorAll('.beli-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const harga = this.getAttribute('data-harga');
            const stok = this.getAttribute('data-stok');
            addToCart(id, nama, harga, stok);
        });
    });

    function addToCart(id, nama, harga, stok) {
        fetch('<?= base_url('home/add_to_cart') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                nama: nama,
                harga: harga,
                stok: stok
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateCartDisplay();
            } else {
                console.error('Failed to add item to cart');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Initial cart display update
    updateCartDisplay();
});
    </script>
</body>
</html>
