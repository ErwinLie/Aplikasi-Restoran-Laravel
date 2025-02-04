<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('home/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Data Voucher</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('home/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('home/voucher') }}">Data Voucher</a></div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Data Voucher</h4>
                    </div>
                    <div>
                        <!-- Button to Open the Modal for Adding Voucher -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahVoucherModal">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                    <div class="ml-auto">
                        <form class="form-inline">
                            <input id="searchInputVoucher" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Voucher</th>
                                    <th scope="col">Diskon</th>
                                    <th scope="col">Voucher Expired</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBodyVoucher">
                                <?php 
                                    $no = 1;
                                    foreach($erwin as $v) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $v->kode_voucher ?></td>
                                    <td><?= $v->diskon ?></td>
                                    <td><?= $v->voucher_expired ?></td>
                                    <td>
                                        <button type="button" 
                                                class="btn btn-primary btn-action btn-action-edit-voucher mr-1" 
                                                data-toggle="tooltip" 
                                                title="Edit"
                                                data-id_voucher="<?= $v->id_voucher ?>"
                                                data-kode_voucher="<?= $v->kode_voucher ?>"
                                                data-diskon="<?= $v->diskon ?>"
                                                data-voucher_expired="<?= $v->voucher_expired ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <a href="{{ route('hapus_voucher', $v->id_voucher) }}" 
                                           class="btn btn-danger btn-action" 
                                           data-toggle="tooltip" 
                                           title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Voucher -->
<div class="modal fade" id="tambahVoucherModal" tabindex="-1" role="dialog" aria-labelledby="tambahVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tambahVoucherForm" action="{{ route('aksi_t_voucher') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahVoucherModalLabel">Tambah Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambahKodeVoucher">Kode Voucher</label>
                        <input type="text" class="form-control" id="tambahKodeVoucher" name="kode_voucher" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahDiskon">Diskon</label>
                        <input type="text" class="form-control" id="tambahDiskon" name="diskon" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahVoucherExpired">Voucher Expired</label>
                        <input type="date" class="form-control" id="tambahVoucherExpired" name="voucher_expired" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Voucher -->
<div class="modal fade" id="editVoucherModal" tabindex="-1" role="dialog" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editVoucherForm" action="{{ route('aksi_e_voucher') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editVoucherModalLabel">Edit Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_voucher" id="editIdVoucher">
                    <div class="form-group">
                        <label for="editKodeVoucher">Kode Voucher</label>
                        <input type="text" class="form-control" id="editKodeVoucher" name="kode_voucher" required>
                    </div>
                    <div class="form-group">
                        <label for="editDiskon">Diskon</label>
                        <input type="text" class="form-control" id="editDiskon" name="diskon" required>
                    </div>
                    <div class="form-group">
                        <label for="editVoucherExpired">Voucher Expired</label>
                        <input type="date" class="form-control" id="editVoucherExpired" name="voucher_expired" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tampilkan modal edit voucher dan isi data
        $('.btn-action-edit-voucher').on('click', function() {
            var id_voucher = $(this).data('id_voucher');
            var kode_voucher = $(this).data('kode_voucher');
            var diskon = $(this).data('diskon');
            var voucher_expired = $(this).data('voucher_expired');

            $('#editIdVoucher').val(id_voucher);
            $('#editKodeVoucher').val(kode_voucher);
            $('#editDiskon').val(diskon);
            $('#editVoucherExpired').val(voucher_expired);

            $('#editVoucherModal').modal('show');
        });

        // Filter table voucher
        $('#searchInputVoucher').on('keyup', function() {
            var filter = $(this).val().toUpperCase();
            $('#tableBodyVoucher tr').filter(function() {
                $(this).toggle($(this).text().toUpperCase().indexOf(filter) > -1)
            });
        });
    });
</script>
