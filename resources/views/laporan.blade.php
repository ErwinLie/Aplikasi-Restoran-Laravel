<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url ('home/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url ('home/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url ('home/laporan') }}">Laporan</a></div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <!-- PRINT WINDOW TABLE -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Print Window</h4>
                        </div>
                        <div class="card-body">
                            <form id="print-window-form">
                                <div class="form-group">
                                    <label for="start_date_window">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="awal" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date_window">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="akhir" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- PRINT PDF TABLE -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Print PDF</h4>
                        </div>
                        <div class="card-body">
                            <form id="print-pdf-form">
                                <div class="form-group">
                                    <label for="start_date_pdf">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="awal" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date_pdf">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="akhir" required>
                                </div>
                                <button type="button" class="btn btn-danger btn-block">
                                    <i class="fas fa-file-pdf"></i> Print PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
