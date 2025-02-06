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
                                </tr>
                            </thead>
                            <tbody id="transaksi-table">
                                @php $no = 1; @endphp
                                @foreach($transaksi as $t)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $t->kode_transaksi }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($t->tanggal)) }}</td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
</script>
