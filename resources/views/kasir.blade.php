<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir Restoran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .menu-card { cursor: pointer; transition: 0.3s; }
        .menu-card:hover { transform: scale(1.05); }
        .order-list { max-height: 400px; overflow-y: auto; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Panel Menu Kiri -->
            <div class="col-md-6">
                <h4>Menu Makanan</h4>
                <div class="row">
                    <?php foreach ($menu as $item): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card menu-card" data-id="<?= $item->id_menu ?>" data-nama="<?= $item->nama_menu ?>" data-harga="<?= $item->harga ?>">
                            <div class="card-body">
                                <h5><?= $item->nama_menu ?></h5>
                                <p class="text-muted"><?= $item->deskripsi ?></p>
                                <h6>Rp <?= number_format($item->harga, 0, ',', '.') ?></h6>
                                <button class="btn btn-primary btn-sm btn-tambah">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Panel Daftar Pesanan Kanan -->
            <div class="col-md-6">
    <h4>Daftar Pesanan</h4>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="order-list"></tbody>
    </table>

    <!-- Input untuk Kode Membership dan Kode Voucher -->
    <div class="mt-3">
        <div class="form-group">
            <label for="kode-membership">Kode Membership</label>
            <input type="text" class="form-control" id="kode-membership" placeholder="Masukkan Kode Membership">
        </div>
        <div class="form-group">
            <label for="kode-voucher">Kode Voucher</label>
            <input type="text" class="form-control" id="kode-voucher" placeholder="Masukkan Kode Voucher">
        </div>
    </div>

    <h5 class="mt-2">Diskon: <span id="diskon-harga">Rp 0</span></h5>

    <!-- Total Harga -->
    <h5 class="mt-3">Total: <span id="total-harga">Rp 0</span></h5>

    <!-- Tombol Bayar -->
    <button class="btn btn-success mt-2" id="btn-bayar">Bayar</button>
</div>

        </div>
    </div>

    <script>
        let daftarPesanan = [];

        $(document).on('click', '.btn-tambah', function () {
            let id = $(this).closest('.menu-card').data('id');
            let nama = $(this).closest('.menu-card').data('nama');
            let harga = parseInt($(this).closest('.menu-card').data('harga'));

            let item = daftarPesanan.find(p => p.id === id);
            if (item) {
                item.jumlah++;
            } else {
                daftarPesanan.push({ id, nama, harga, jumlah: 1 });
            }

            updatePesanan();
        });

        $(document).on('click', '.btn-hapus', function () {
            let id = $(this).data('id');
            daftarPesanan = daftarPesanan.filter(p => p.id !== id);
            updatePesanan();
        });

        function updatePesanan() {
            let orderList = $('.order-list');
            orderList.empty();
            let total = 0;

            daftarPesanan.forEach((item, index) => {
                total += item.harga * item.jumlah;
                orderList.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama}</td>
                        <td>${item.jumlah}</td>
                        <td>Rp ${new Intl.NumberFormat().format(item.harga * item.jumlah)}</td>
                        <td><button class="btn btn-danger btn-sm btn-hapus" data-id="${item.id}">Hapus</button></td>
                    </tr>
                `);
            });

            $('#total-harga').text(`Rp ${new Intl.NumberFormat().format(total)}`);
        }

        // Fungsi untuk verifikasi voucher dan mengupdate total harga
        $(document).on('click', '#btn-bayar', function() {
    let kodeVoucher = $('#kode-voucher').val();

    if (kodeVoucher.trim() === "") {
        alert("Masukkan kode voucher terlebih dahulu.");
        return;
    }

    $.ajax({
        url: "cekVoucher", // Pastikan URL ini sesuai dengan route di Laravel
        method: 'POST',
        data: {
            kode_voucher: kodeVoucher,
            _token: $('meta[name="csrf-token"]').attr('content') // Pastikan ada <meta> untuk CSRF
        },
        success: function(response) {
            if (response.status === 'valid') {
                let diskon = parseFloat(response.diskon);
                let totalHarga = hitungTotalHarga();
                let totalSetelahDiskon = totalHarga - (totalHarga * (diskon / 100));

                $('#total-harga').text('Rp ' + new Intl.NumberFormat().format(totalSetelahDiskon));
                $('#diskon-harga').text('Rp ' + new Intl.NumberFormat().format(totalHarga * (diskon / 100)));
            } else {
                alert(response.message || 'Voucher tidak valid atau telah expired');
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat memverifikasi voucher');
        }
    });
});


function hitungTotalHarga() {
    let total = 0;
    daftarPesanan.forEach(item => {
        total += item.harga * item.jumlah;
    });
    return total;
}
    </script>
</body>
</html>
