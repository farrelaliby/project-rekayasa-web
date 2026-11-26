@extends('admin.template')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3 py-3">
            <h3>Data Users</h3>
            <header class="justify-content-end">
                <button class="btn btn-primary" id="btnAdd">Tambah User</button>
            </header>
        </div>
    </div>

    <div id="alertBox" class="alert d-none" role="alert"></div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered" id="table-users">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah / Edit User -->
<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formUser" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUserTitle">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password <small class="text-muted" id="passwordHint">(wajib saat tambah user)</small></label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <input type="text" id="role" name="role" class="form-control" value="user">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambahan (Bootstrap 5) -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    const userModalEl = document.getElementById('modalUser');
    const userModal = new bootstrap.Modal(userModalEl);

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 3000
    };

    function showAlert(type, message) {
        const box = $('#alertBox');
        box.removeClass('d-none alert-success alert-danger').addClass('alert-' + type).text(message);

        if (type === 'success') {
            toastr.success(message);
        } else {
            toastr.error(message);
        }
    }

    const table = $('#table-users').DataTable({
        ajax: {
            url: '/api/users-list',
            type: 'GET',
            headers: {
                'Authorization': API_TOKEN ? `Bearer ${API_TOKEN}` : '',
                'Accept': 'application/json'
            },
            dataSrc: function(json) {
                return json.data ?? json;
            },
            error: function(xhr) {
                showAlert('danger', 'Gagal memuat data users (Status ' + xhr.status + ').');
            }
        },
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: 'name' },
            { data: 'email' },
            { data: 'phone', defaultContent: '-' },
            { data: 'address', defaultContent: '-' },
            { data: 'role', defaultContent: '-' },
            {
                data: 'id',
                render: function(id) {
                    return `
                        <button class="btn btn-sm btn-warning btn-edit" data-id="${id}">Edit</button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="${id}">Hapus</button>
                    `;
                }
            }
        ]
    });

    $('#btnAdd').on('click', function() {
        $('#formUser')[0].reset();
        $('#user_id').val('');
        $('#role').val('user');
        $('#password').prop('required', true);
        $('#passwordHint').text('(wajib saat tambah user)');
        $('#modalUserTitle').text('Tambah User');
        userModal.show();
    });

    $('#table-users').on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `/api/users/${id}`,
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${API_TOKEN}`,
                'Accept': 'application/json'
            },
            success: function(res) {
                const u = res.data ?? res;
                $('#user_id').val(u.id);
                $('#name').val(u.name);
                $('#email').val(u.email);
                $('#password').val('').prop('required', false);
                $('#passwordHint').text('(kosongkan jika tidak diubah)');
                $('#phone').val(u.phone ?? '');
                $('#address').val(u.address ?? '');
                $('#role').val(u.role ?? 'user');
                $('#modalUserTitle').text('Edit User');
                userModal.show();
            },
            error: function(xhr) {
                showAlert('danger', 'Gagal mengambil detail user (Status ' + xhr.status + ').');
            }
        });
    });

    $('#formUser').on('submit', function(e) {
        e.preventDefault();
        const id = $('#user_id').val();
        const isEdit = Boolean(id);
        const url = isEdit ? `/api/users/${id}` : '/api/users';
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            name: $('#name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            role: $('#role').val()
        };

        const passwordVal = $('#password').val();
        if (passwordVal) {
            payload.password = passwordVal;
        }

        $.ajax({
            url: url,
            type: method,
            headers: {
                'Authorization': `Bearer ${API_TOKEN}`,
                'Accept': 'application/json'
            },
            data: payload,
            success: function(res) {
                userModal.hide();
                table.ajax.reload();
                showAlert('success', res.message || 'Data user berhasil disimpan.');
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal menyimpan data user.';
                showAlert('danger', msg);
            }
        });
    });

    $('#table-users').on('click', '.btn-delete', function() {
        if (!confirm('Yakin ingin menghapus user ini?')) return;
        const id = $(this).data('id');

        $.ajax({
            url: `/api/users/${id}`,
            type: 'DELETE',
            headers: {
                'Authorization': `Bearer ${API_TOKEN}`,
                'Accept': 'application/json'
            },
            success: function(res) {
                table.ajax.reload();
                showAlert('success', res.message || 'User berhasil dihapus.');
            },
            error: function(xhr) {
                showAlert('danger', 'Gagal menghapus user (Status ' + xhr.status + ').');
            }
        });
    });
});
</script>
@endsection