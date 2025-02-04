
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url ('home/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Data Member</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url ('home/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url ('home/member') }}">Data Member</a></div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Data Member</h4>
                    </div>
                    <div>

                     <!-- Button to Open the Modal for Adding Kelas -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahMemberModal">
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Expired</th>
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
                                        <td><?= $wkwk->nama_member?></td>
                                        <td><?= $wkwk->kode_member?></td>
                                        <td><?= $wkwk->expired_member?></td>
                                        <!--  -->
                                        <td>
                                            <button type="button" 
                                                    class="btn btn-primary btn-action btn-action-edit mr-1" 
                                                    data-toggle="tooltip" 
                                                    title="Edit"
                                                    data-id_member="<?= $wkwk->id_member ?>"
                                                    data-nama_member="<?= $wkwk->nama_member ?>"
                                                    data-kode_member="<?= $wkwk->kode_member ?>"
                                                    data-expired_member="<?= $wkwk->expired_member ?>"> <!-- Tambahkan ini -->
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                           
                                            <a href="{{ route ('hapus_member',$wkwk->id_member) }}" 
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
<div class="modal fade" id="tambahMemberModal" tabindex="-1" role="dialog" aria-labelledby="tambahMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMemberModalLabel">Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahMemberForm" action="{{ route ('aksi_t_member') }}" method="POST">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambahNamaMember">Nama Member</label>
                        <input type="text" class="form-control" id="tambahNamaMember" name="nama_member" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahKodeMember">Kode Member</label>
                        <input type="text" class="form-control" id="tambahKodeMember" name="kode_member" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahExpiredMember">Expired Member</label>
                        <input type="date" class="form-control" id="tambahExpiredMember" name="expired_member" required>
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

<!-- Modal Edit User -->
<div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMemberForm" action="{{ route ('aksi_e_member') }}" method="POST">
            @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_member" id="editIdMember">
                    <div class="form-group">
                        <label for="editNamaMember">Nama Member</label>
                        <input type="text" class="form-control" id="editNamaMember" name="nama_member" required>
                    </div>
                    <div class="form-group">
                        <label for="editKodeMember">Kode Member</label>
                        <input type="text" class="form-control" id="editKodeMember" name="kode_member" required>
                    </div>
                    <div class="form-group">
                        <label for="editExpiredMember">Expired Member</label>
                        <input type="date" class="form-control" id="editExpiredMember" name="expired_member" required>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-action-edit').on('click', function() {
            // Ambil data dari atribut data-* di baris tabel
            var id_member = $(this).data('id_member');
            var nama_member = $(this).data('nama_member');
            var kode_member = $(this).data('kode_member');
            var expired_member = $(this).data('expired_member');

            // Isi form modal dengan data tersebut
            $('#editIdMember').val(id_member);
            $('#editNamaMember').val(nama_member);
            $('#editKodeMember').val(kode_member);
            $('#editExpiredMember').val(expired_member);

            // Tampilkan modal
            $('#editMemberModal').modal('show');
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
