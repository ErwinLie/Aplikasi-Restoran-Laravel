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

        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Data Menu</h4>
                    </div>
                    <div>
                        <!-- Button to Open the Modal for Adding Menu -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahMenuModal">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                    <div class="ml-auto">
                        <form class="form-inline">
                            <input id="searchInputMenu" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBodyMenu">
                                <?php 
                                    $no = 1;
                                    foreach($erwin as $m) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $m->nama_menu ?></td>
                                    <td><?= $m->harga ?></td>
                                    <td><?= $m->deskripsi ?></td>
                                    <td><?= $m->kategori ?></td>
                                    <td>
                                        <button type="button" 
                                                class="btn btn-primary btn-action btn-action-edit-menu mr-1" 
                                                data-toggle="tooltip" 
                                                title="Edit"
                                                data-id_menu="<?= $m->id_menu ?>"
                                                data-nama_menu="<?= $m->nama_menu ?>"
                                                data-harga="<?= $m->harga ?>"
                                                data-deskripsi="<?= $m->deskripsi ?>"
                                                data-kategori="<?= $m->kategori ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <a href="{{ route('hapus_menu_kfc', $m->id_menu) }}" 
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

<!-- Modal Tambah Menu -->
<div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tambahMenuForm" action="{{ route('aksi_t_menu') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambahNamaMenu">Nama Menu</label>
                        <input type="text" class="form-control" id="tambahNamaMenu" name="nama_menu" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahHarga">Harga</label>
                        <input type="text" class="form-control" id="tambahHarga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahDeskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="tambahDeskripsi" name="deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahKategori">Kategori</label>
                        <select class="form-control" id="tambahKategori" name="kategori" required>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Paket">Paket</option>
                        </select>
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

<!-- Modal Edit Menu -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editMenuForm" action="{{ route('aksi_e_menu') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_menu" id="editIdMenu">
                    <div class="form-group">
                        <label for="editNamaMenu">Nama Menu</label>
                        <input type="text" class="form-control" id="editNamaMenu" name="nama_menu" required>
                    </div>
                    <div class="form-group">
                        <label for="editHarga">Harga</label>
                        <input type="text" class="form-control" id="editHarga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="editDeskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="editDeskripsi" name="deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="editKategori">Kategori</label>
                        <select class="form-control" id="editKategori" name="kategori" required>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Paket">Paket</option>
                        </select>
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
        // Tampilkan modal edit menu dan isi data
        $('.btn-action-edit-menu').on('click', function() {
            var id_menu    = $(this).data('id_menu');
            var nama_menu  = $(this).data('nama_menu');
            var harga      = $(this).data('harga');
            var deskripsi  = $(this).data('deskripsi');
            var kategori   = $(this).data('kategori');

            $('#editIdMenu').val(id_menu);
            $('#editNamaMenu').val(nama_menu);
            $('#editHarga').val(harga);
            $('#editDeskripsi').val(deskripsi);
            $('#editKategori').val(kategori);

            $('#editMenuModal').modal('show');
        });

        // Filter table menu
        $('#searchInputMenu').on('keyup', function() {
            var filter = $(this).val().toUpperCase();
            $('#tableBodyMenu tr').filter(function() {
                $(this).toggle($(this).text().toUpperCase().indexOf(filter) > -1)
            });
        });
    });
</script>
