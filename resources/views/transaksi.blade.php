<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('home/dashboard') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Data Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ url('home/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Data Transaksi</div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Transaksi</h4>
                    <form id="filter-form" class="form-inline">
                        <input type="date" name="start_date" id="start_date" class="form-control mr-2" required>
                        <input type="date" name="end_date" id="end_date" class="form-control mr-2" required>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="transaksi-table">
                                @php $no = 1; @endphp
                                @foreach($transaksi as $t)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $t->kode_transaksi }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($t->tanggal)) }}</td>
                                        <td>
    <button class="btn btn-info btn-sm btn-detail" data-id="{{ $t->kode_transaksi }}">
        <i class="fas fa-eye"></i> Detail
    </button>
</td>
                                    </tr>
                                @endforeach
                                @if(count($transaksi) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Tanggal</th><td id="modalTanggal"></td></tr>
                        <tr><th>Kode Transaksi</th><td id="modalKodeTransaksi"></td></tr>
                        <tr><th>Kode Member</th><td id="modalKodeMember"></td></tr>
                        <tr><th>Kode Voucher</th><td id="modalKodeVoucher"></td></tr>
                        <tr><th>Menu</th><td id="modalJumlah"></td></tr>
                        <!-- <tr><th>Menu</th><td id="modalMenu"></td></tr> -->
                        <tr><th>Total</th><td id="modalTotal"></td></tr>
                        <tr><th>Diskon</th><td id="modalDiskon"></td></tr>
                        <tr><th>Total Akhir</th><td id="modalTotalAkhir"></td></tr>
                        <tr><th>Bayar</th><td id="modalBayar"></td></tr>
                        <tr><th>Kembalian</th><td id="modalKembalian"></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).ready(function () {
        $('#filter-form').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman

            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            $.ajax({
                url: "{{ route('filter_transaksi') }}",
                type: "GET",
                data: { start_date: start_date, end_date: end_date },
                success: function (response) {
                    let transaksiTable = $('#transaksi-table');
                    transaksiTable.empty();

                    if (response.transaksi.length > 0) {
                        let no = 1;
                        response.transaksi.forEach(function (t) {
                            transaksiTable.append(`
                                <tr>
                                    <td>${no++}</td>
                                    <td>${t.kode_transaksi}</td>
                                    <td>${new Date(t.tanggal).toLocaleString('id-ID')}</td>
                                </tr>
                            `);
                        });
                    } else {
                        transaksiTable.append(`
                            <tr>
                                <td colspan="3" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        `);
                    }
                }
            });
        });
    });
</script> -->

<script>
    $(document).ready(function () {
        // Filter transaksi berdasarkan tanggal
        $('#filter-form').on('submit', function (e) {
            e.preventDefault(); 

            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            $.ajax({
                url: "{{ route('filter_transaksi') }}",
                type: "GET",
                data: { start_date: start_date, end_date: end_date },
                success: function (response) {
                    let transaksiTable = $('#transaksi-table');
                    transaksiTable.empty();

                    if (response.transaksi.length > 0) {
                        let no = 1;
                        response.transaksi.forEach(function (t) {
                            transaksiTable.append(`
                                <tr>
                                    <td>${no++}</td>
                                    <td>${t.kode_transaksi}</td>
                                    <td>${new Date(t.tanggal).toLocaleString('id-ID')}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm btn-detail" data-id="${t.kode_transaksi}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        transaksiTable.append(`
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        `);
                    }
                }
            });
        });

        // Tampilkan modal dengan detail transaksi
        $(document).on('click', '.btn-detail', function () {
    let kode_transaksi = $(this).data('id');

    $.ajax({
        url: "{{ route('get_detail_transaksi') }}",
        type: "GET",
        data: { kode_transaksi: kode_transaksi },
        success: function (response) {
            if (response.success) {
                let transaksi = response.data;

                $('#modalTanggal').text(transaksi.tanggal);
                $('#modalKodeTransaksi').text(transaksi.kode_transaksi);
                $('#modalKodeMember').text(transaksi.kode_member || '-');
                $('#modalKodeVoucher').text(transaksi.kode_voucher || '-');

                // Menggabungkan jumlah dan menu
                let jumlahArray = transaksi.jumlah.split(',');
                let menuArray = transaksi.nama_menu.split(',');
                let menuList = '';

                for (let i = 0; i < jumlahArray.length; i++) {
                    menuList += jumlahArray[i] + 'x ' + menuArray[i] + '<br>';
                }

                $('#modalJumlah').html(menuList); // Tampilkan hasil yang sudah digabung

                $('#modalTotal').text('Rp ' + transaksi.total.toLocaleString());
                $('#modalDiskon').text('Rp ' + transaksi.diskon.toLocaleString());
                $('#modalTotalAkhir').text('Rp ' + transaksi.total_akhir.toLocaleString());
                $('#modalBayar').text('Rp ' + transaksi.bayar.toLocaleString());
                $('#modalKembalian').text('Rp ' + transaksi.kembalian.toLocaleString());

                $('#detailTransaksiModal').modal('show');
            } else {
                alert('Data transaksi tidak ditemukan');
            }
        }
    });
});
    });
</script>

