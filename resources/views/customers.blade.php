@extends('layout.main')

@section('content')

<div class="container">
    <div class="d-flex flex-row-reverse mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Customer
        </button>
    </div>
    <table class="table table-bordered table-hover" id="customer-table">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Kewarganegaraan</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewModalLabel">View Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="view-name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="view-name" disabled>
                </div>
                <div class="mb-3">
                    <label for="view-dob" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="view-dob" disabled>
                </div>
                <div class="mb-3">
                    <label for="view-phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="view-phone" disabled>
                </div>
                <div class="mb-3">
                    <label for="view-email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="view-email" disabled>
                </div>
                <div class="mb-3">
                    <label for="view-nat" class="form-label">Kewarganegaraan</label>
                    <input type="text" class="form-control" id="view-nat" disabled>
                </div>
                <hr>
                <div id="view-fl">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit-name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="edit-name" >
                </div>
                <div class="mb-3">
                    <label for="edit-dob" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="edit-dob" >
                </div>
                <div class="mb-3">
                    <label for="edit-phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="edit-phone" >
                </div>
                <div class="mb-3">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="edit-email" >
                </div>
                <div class="mb-3">
                    <label for="edit-nat" class="form-label">Kewarganegaraan</label>
                    <select class="form-select" name="edit-nat" id="edit-nat">
                        <option selected disabled>Pilih Kewarganegaraan</option>
                        @foreach ($nationalities as $nat)
                            <option value="{{ $nat->nationality_id }}">{{$nat->nationality_name}} ({{ $nat->nationality_code }})</option>
                        @endforeach
                      </select>
                </div>
                <hr>
                <div class="row">
                    <div class="col">Keluarga</div>
                    <div class="col">
                        <a href="javascript:void(0)" class="addFamilyList" data-insert-type="edit">+ Tambah Keluarga</a>
                    </div>
                </div>
                <div id="edit-fl">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary editSubmit" data-id="">Submit</button>
            </div>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="add-name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="add-name" >
                </div>
                <div class="mb-3">
                    <label for="add-dob" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="add-dob" >
                </div>
                <div class="mb-3">
                    <label for="add-phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="add-phone" >
                </div>
                <div class="mb-3">
                    <label for="add-email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="add-email" >
                </div>
                <div class="mb-3">
                    <label for="add-nat" class="form-label">Kewarganegaraan</label>
                    <select class="form-select" name="add-nat" id="add-nat">
                        <option selected disabled>Pilih Kewarganegaraan</option>
                        @foreach ($nationalities as $nat)
                            <option value="{{ $nat->nationality_id }}">{{$nat->nationality_name}} ({{ $nat->nationality_code }})</option>
                        @endforeach
                      </select>
                </div>
                <hr>
                <div class="row">
                    <div class="col">Keluarga</div>
                    <div class="col">
                        <a href="javascript:void(0)" class="addFamilyList" data-insert-type="add">+ Tambah Keluarga</a>
                    </div>
                </div>
                <div id="add-fl">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#customer-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "300px",
            ajax: "/",
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    serverSide: true,
                    render: function (data, type, row, meta) {
                    // Menggunakan meta.row + 1 untuk nomor urut
                    return meta.row + 1;
                    },
                    className: 'align-middle text-center text-sm'
                },
                { data: 'cst_name', name: 'aktual', className: 'align-middle text-center text-sm' },
                { data: 'cst_dob', name: 'peramalan', className: 'align-middle text-center text-sm' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'align-middle text-center text-sm'
                },
            ]
        })
    })

    let deleted_fl_id = [];

    $('body').on('click', '.viewCustomer', function() {
        let id = $(this).data('id');

        $('#view-fl').empty();

        $.ajax({
            type: "GET",
            url: "/api/customers/" + id,
            success: function(response) {
                let data = response.data;

                $('#view-name').val(data.cst_name);
                $('#view-dob').val(data.cst_dob);
                $('#view-phone').val(data.cst_phoneNum);
                $('#view-email').val(data.cst_email);
                $('#view-nat').val(data.cst_nat);

                if (
                    data &&
                    data.cst_fl &&
                    data.cst_fl.length > 0
                    ) {
                        for (let list of data.cst_fl) {
                            $('#view-fl').append(`
                                <div class="row" id="fl-${list.fl_id}">
                                    <div class="mb-3 col">
                                        <label for="view-name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="view-name-${list.fl_id}" value="${list.fl_name}" disabled>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="view-dob" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="view-dob-${list.fl_id}" value="${list.fl_dob}" disabled>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="view-relations" class="form-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="view-relations-${list.fl_id}" value="${list.fl_relation}" disabled>
                                    </div>
                                </div>`)
                        }
                }
            },
            error: function(err) {
                console.log(err)
            }
        })
    })

    $('body').on('click', '.editCustomer', function() {
        let id = $(this).data('id');
        $('.editSubmit').data('id', id);

        deleted_fl_id = [];

        $('#edit-fl').empty();

        $.ajax({
            type: "GET",
            url: "/api/customers/" + id,
            success: function(response) {
                let data = response.data;

                $('#edit-name').val(data.cst_name);
                $('#edit-dob').val(data.cst_dob);
                $('#edit-phone').val(data.cst_phoneNum);
                $('#edit-email').val(data.cst_email);
                $('#edit-nat').val(data.nationality_id).trigger('change');

                if (
                    data &&
                    data.cst_fl &&
                    data.cst_fl.length > 0
                    ) {
                        for (let list of data.cst_fl) {
                            $('#edit-fl').append(`
                                <div class="row" id="fl-${list.fl_id}">
                                    <input type="hidden" class="id-fl" id="fl_id-${list.fl_id}" value="${list.fl_id}">
                                    <div class="mb-3 col">
                                        <label for="edit-name" class="form-label">Nama</label>
                                        <input type="text" class="form-control edit-name-fl" id="edit-name-${list.fl_id}" value="${list.fl_name}">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="edit-dob" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control edit-dob-fl" id="edit-dob-${list.fl_id}" value="${list.fl_dob}">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="edit-relation" class="form-label">Relasi</label>
                                        <input type="text" class="form-control edit-relation-fl" id="edit-relation-${list.fl_id}" value="${list.fl_relation}">
                                    </div>
                                    <div class="d-flex flex-column col">
                                        <button type="button" class="btn btn-danger btn-sm mt-4 fl-del" data-id="${list.fl_id}">HAPUS</button>
                                    </div>
                                </div>`)
                        }
                }
            },
            error: function(err) {
                console.log(err)
            }
        })
    })

    $('body').on('click', '.addFamilyList', function() {
        let types = {
            edit: 'edit-fl',
            add: 'add-fl',
        };

        let selectedType = $(this).data('insert-type');
        let id = Date.now()

        $(`#${types[selectedType]}`).append(`
            <div class="row" id="fl-${id}">
                <div class="mb-3 col">
                    <label for="${selectedType}-name" class="form-label">Nama</label>
                    <input type="text" class="form-control ${selectedType}-name-fl" id="${selectedType}-name-${id}">
                </div>
                <div class="mb-3 col">
                    <label for="${selectedType}-dob" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control ${selectedType}-dob-fl" id="${selectedType}-dob-${id}">
                </div>
                <div class="mb-3 col">
                    <label for="${selectedType}-relation" class="form-label">Relasi</label>
                    <input type="text" class="form-control ${selectedType}-relation-fl" id="${selectedType}-relation-${id}">
                </div>
                <div class="d-flex flex-column col">
                    <button type="button" class="btn btn-danger btn-sm mt-4 fl-del" data-id="${id}">HAPUS</button>
                </div>
            </div>
        `)
    })

    $('body').on('click', '.fl-del', function() {
        let id = $(this).data('id');
        let fl_id = $(`#fl_id-${id}`).val();

        if (fl_id) {
            deleted_fl_id.push(fl_id);
        }

        $(`#fl-${id}`).remove();
    })

    $('body').on('click', '.editSubmit', function() {
        let id = $(this).data('id');

        let fl = []

        let fl_names = $('.edit-name-fl');
        let fl_dobs = $('.edit-dob-fl');
        let fl_relations = $('.edit-relation-fl');
        let fl_ids = $('.id-fl');

        for(let i = 0; i < fl_names.length; i++) {
            let fl_data = {
                fl_name: fl_names[i].value,
                fl_dob: fl_dobs[i].value,
                fl_relation: fl_relations[i].value,
            }

            if (fl_ids[i]) {
                fl_data['fl_id'] = fl_ids[i].value;
            }

            fl.push(fl_data)
        }

        let data = {
            cst_name: $('#edit-name').val(),
            cst_dob: $('#edit-dob').val(),
            cst_phoneNum: $('#edit-phone').val(),
            cst_email: $('#edit-email').val(),
            nationality_id: $('#edit-nat').val(),
            deleted_fl_id,
            family_list: fl
        }

        $.ajax({
            url: '/api/customers/' + id,
            method: 'PUT',
            data,
            success: function(response) {
                $('#editModal .btn-close').click();
                toastr.success('Data Updated Successfully', 'Success');
                $('#customer-table').DataTable().ajax.reload();
            },
            error: function(error) {
                toastr.error('Check your data or Contact your administrator', 'Aww :(');
            }
        });
    })

    $('body').on('click', '.deleteCustomer', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');

        Swal.fire({
            title: `Do you want to delete: ${name} ?`,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/customers/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire('Deleted!', 'Data Deleted Successfully', 'success');
                        $('#customer-table').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        Swal.fire('Snap!', 'Contact your administrator', 'error');
                    }
                });
            }
        })
    })

    $('body').on('click', '.addSubmit', function() {
        let id = $(this).data('id');

        let fl = []

        let fl_names = $('.add-name-fl');
        let fl_dobs = $('.add-dob-fl');
        let fl_relations = $('.add-relation-fl');
        let fl_ids = $('.id-fl');

        for(let i = 0; i < fl_names.length; i++) {
            let fl_data = {
                fl_name: fl_names[i].value,
                fl_dob: fl_dobs[i].value,
                fl_relation: fl_relations[i].value,
            }

            if (fl_ids[i]) {
                fl_data['fl_id'] = fl_ids[i].value;
            }

            fl.push(fl_data)
        }

        let data = {
            cst_name: $('#add-name').val(),
            cst_dob: $('#add-dob').val(),
            cst_phoneNum: $('#add-phone').val(),
            cst_email: $('#add-email').val(),
            nationality_id: $('#add-nat').val(),
            family_list: fl
        }

        $.ajax({
            url: '/api/customers/',
            method: 'POST',
            data,
            success: function(response) {
                $('#addModal .btn-close').click();
                toastr.success('Data Updated Successfully', 'Success');
                $('#add-name').val("")
                $('#add-dob').val("")
                $('#add-phone').val("")
                $('#add-email').val("")
                $('#add-nat').val("").trigger('change')
                $('#add-fl').empty();
                $('#customer-table').DataTable().ajax.reload();
            },
            error: function(error) {
                toastr.error('Check your data or Contact your administrator', 'Aww :(');
            }
        });
    })
</script>
@endpush
