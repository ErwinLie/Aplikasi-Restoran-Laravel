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

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('home/dashboard') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Data Menu</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ url('home/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ url('home/menu') }}">Data Menu</a>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <!-- Panel Menu Kiri -->
                <div class="col-md-6">
                    <h4>Menu</h4>
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

                    <!-- Input Harga Pembayaran -->
                    <div class="form-group mt-3">
                        <label for="input-harga">Jumlah Pembayaran</label>
                        <input type="text" class="form-control" id="input-harga" placeholder="Masukkan jumlah uang">
                    </div>

                    <!-- Kembalian -->
                    <h5 class="mt-2">Kembalian: <span id="kembalian-harga">Rp 0</span></h5>

                    <!-- Tombol Bayar -->
                    <button class="btn btn-success mt-2" id="btn-bayar">Bayar</button>
                </div>
            </div>
        </div>
    </section>
</div>

    <script>

$(document).on('input', '#input-harga', function() {
    hitungKembalian();
});

$('#btn-bayar').on('click', function () {
    let bayar = parseInt($('#input-harga').val());
    let totalAkhir = parseInt($('#total-harga').text().replace(/[^\d]/g, ''));
    let total = totalHarga;
    let diskon = parseInt($('#diskon-harga').text().replace(/[^\d]/g, '')) || 0;
    let kembalian = bayar - totalAkhir;

    if (isNaN(bayar) || bayar < totalAkhir) {
        alert('Jumlah pembayaran tidak cukup!');
        return;
    }

    let menuPesanan = daftarPesanan.map(item => ({
        nama: item.nama,
        harga: item.harga,
        jumlah: item.jumlah
    }));

    $.ajax({
        url: "{{ url('aksi_t_transaksi') }}",
        method: "POST",
        data: {
            kode_membership: $('#kode-membership').val(),
            kode_voucher: $('#kode-voucher').val(),
            diskon: diskon,
            total: total,
            total_akhir: totalAkhir,
            bayar: bayar,
            kembalian: kembalian,
            menu: menuPesanan,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                alert('Transaksi berhasil!');
                cetakNota(response.kode_transaksi); // Panggil fungsi cetak nota
            } else {
                alert('Gagal menyimpan transaksi');
            }
        },
        error: function () {
            alert('Gagal menyimpan transaksi');
        }
    });
});

function cetakNota(kodeTransaksi) {
    let printWindow = window.open("{{ url('cetak_nota') }}/" + kodeTransaksi, '_blank');
    printWindow.focus();
}

function hitungKembalian() {
    let bayar = parseInt($('#input-harga').val());
    let total = parseInt($('#total-harga').text().replace(/\D/g, ''));

    if (!isNaN(bayar) && bayar >= total) {
        let kembalian = bayar - total;
        $('#kembalian-harga').text(`Rp ${new Intl.NumberFormat().format(kembalian)}`);
    } else {
        $('#kembalian-harga').text('Rp 0');
    }
}

    let daftarPesanan = [];
    let totalHarga = 0;
    let diskonMembership = 0;
    let diskonVoucher = 0;

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
        totalHarga = 0;

        daftarPesanan.forEach((item, index) => {
            totalHarga += item.harga * item.jumlah;
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

        hitungTotalHarga();
    }

    function hitungTotalHarga() {
        let totalSetelahDiskon = totalHarga;
        
        if (diskonMembership > 0) {
            totalSetelahDiskon -= (totalHarga * (diskonMembership / 100));
        }
        if (diskonVoucher > 0) {
            totalSetelahDiskon -= (totalHarga * (diskonVoucher / 100));
        }

        $('#diskon-harga').text(`Rp ${new Intl.NumberFormat().format(totalHarga - totalSetelahDiskon)}`);
        $('#total-harga').text(`Rp ${new Intl.NumberFormat().format(totalSetelahDiskon)}`);
    }

    // Cek Membership
    $(document).on('blur', '#kode-membership', function() {
        let kodeMembership = $(this).val();

        if (kodeMembership.trim() === "") return;

        $.ajax({
            url: "{{ url('cekMembership') }}",
            method: 'POST',
            data: {
                kode_membership: kodeMembership,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                diskonMembership = response.status === 'valid' ? response.diskon : 0;
                hitungTotalHarga();
            },
            error: function() {
                alert('Terjadi kesalahan saat memverifikasi membership');
            }
        });
    });

    // Cek Voucher otomatis saat diketik
    $(document).on('input', '#kode-voucher', function() {
        let kodeVoucher = $(this).val();

        if (kodeVoucher.trim() === "") {
            diskonVoucher = 0;
            hitungTotalHarga();
            return;
        }

        $.ajax({
            url: "{{ url('cekVoucher') }}",
            method: 'POST',
            data: {
                kode_voucher: kodeVoucher,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                diskonVoucher = response.status === 'valid' ? response.diskon : 0;
                hitungTotalHarga();
            },
            error: function() {
                alert('Terjadi kesalahan saat memverifikasi voucher');
            }
        });
    });
</script>

</body>
</html>
