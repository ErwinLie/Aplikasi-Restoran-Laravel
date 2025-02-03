
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route ('home/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Data User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route ('home/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route ('home/user') }}">Data User</a></div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Data User</h4>
                    </div>
                    <div>

                     <!-- Button to Open the Modal for Adding Kelas -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahKelasModal">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                    <div class="ml-auto">
                        <form class="form-inline">
                            <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"> 
                                <?php 
                                    $no=1;
                                    foreach($erwin as $wkwk){
                                ?>                          
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $wkwk->username?></td>
                                        <td><?= $wkwk->email?></td>
                                        <td>
                                            <?php
                                                if ($wkwk->id_level == 1) {
                                                    echo "Admin";
                                                } else if ($wkwk->id_level == 2) {
                                                    echo "Kepala Sekolah";
                                                } else if ($wkwk->id_level == 3) {
                                                    echo "Wakil";
                                                } else if ($wkwk->id_level == 4) {
                                                    echo "Wali Kelas";
                                                } else if ($wkwk->id_level == 5) {
                                                    echo "Orang Tua";
                                                } else if ($wkwk->id_level == 6) {
                                                    echo "Murid";
                                                }
                                            ?>
                                        </td>
                                        <!--  -->
                                        <td>
                                            <button type="button" 
                                                    class="btn btn-primary btn-action btn-action-edit mr-1" 
                                                    data-toggle="tooltip" 
                                                    title="Edit"
                                                    data-id_user="<?= $wkwk->id_user ?>"
                                                    data-username="<?= $wkwk->username ?>"
                                                    data-email="<?= $wkwk->email ?>"
                                                    data-level="<?= $wkwk->id_level ?>"
                                                    data-no_telp="<?= $wkwk->no_telp ?>"
                                                    data-id_kelas="<?= $wkwk->id_kelas ?>"> <!-- Tambahkan ini -->
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                           
                                            <a href="{{ route ('home/hapus_user/'.$wkwk->id_user) }}" 
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

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahKelasModal" tabindex="-1" role="dialog" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKelasModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahUserForm" action="{{ route ('home/aksi_t_user') }}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambahUsername">Username</label>
                        <input type="text" class="form-control" id="tambahUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahEmail">Email</label>
                        <input type="email" class="form-control" id="tambahEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahLevel">Level</label>
                        <select class="form-control" id="tambahLevel" name="level" required>
                            <option value="1">Admin</option>
                            <option value="2">Kepala Sekolah</option>
                            <option value="3">Wakil</option>
                            <option value="4">Wali Kelas</option>
                            <option value="5">Orang Tua</option>
                            <option value="6">Murid</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="tambahNotelp">No Telepon</label>
                        <input type="text" class="form-control" id="tambahNotelp" name="no_telp" required>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="tambahJk">Jenis Kelamin</label>
                        <select class="form-control" id="tambahJk" name="jk" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm" action="{{ route ('home/aksi_e_user') }}" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="editIdUser">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editLevel">Level</label>
                        <select class="form-control" id="editLevel" name="level" required>
                            <option value="1">Admin</option>
                            <option value="2">Kepala Sekolah</option>
                            <option value="3">Wakil</option>
                            <option value="4">Wali Kelas</option>
                            <option value="5">Orang Tua</option>
                            <option value="6">Murid</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="editNotelp">No Telepon</label>
                        <input type="text" class="form-control" id="editNotelp" name="no_telp" required>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="editJk">Jenis Kelamin</label>
                        <select class="form-control" id="editJk" name="jk" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-action-edit').on('click', function() {
            // Ambil data dari atribut data-* di baris tabel
            var id_user = $(this).data('id_user');
            var username = $(this).data('username');
            var email = $(this).data('email');
            var level = $(this).data('level');
            var no_telp = $(this).data('no_telp');

            // Isi form modal dengan data tersebut
            $('#editIdUser').val(id_user);
            $('#editUsername').val(username);
            $('#editEmail').val(email);
            $('#editLevel').val(level);
            $('#editNotelp').val(no_telp);

            // Tampilkan modal
            $('#editUserModal').modal('show');
        });

        // Filter table function
        $('#searchInput').on('keyup', function() {
            var filter = $(this).val().toUpperCase();
            $('#tableBody tr').filter(function() {
                $(this).toggle($(this).text().toUpperCase().indexOf(filter) > -1)
            });
        });

        
    });
</script>
