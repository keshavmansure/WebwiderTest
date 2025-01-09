@extends('layouts.app')

@section('body')


<div class="container">
    <div class="row m-3 d-flex text-end">
        <div>
            <form action="{{route('users.logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <div>
                    <button class="btn btn-primary" onclick="branchModal()">Create</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table " id="branchesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>latitude</th>
                                <th>longitute</th>
                                <th>created at</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBranchModalLabel">Create Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createBranchForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter branch name" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Enter branch address" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                placeholder="Enter latitude" required>
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                placeholder="Enter longitude" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBranchModal" tabindex="-1" aria-labelledby="editBranchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBranchModalLabel">Create Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBranchForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter branch name" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" id="address" name="address" placeholder="Enter branch address"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                placeholder="Enter latitude" required>
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                placeholder="Enter longitude" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let branchId = null;

        $(document).ready(function() {
            $("#branchesTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('branches.index') }}",
                order: [6, 'desc'],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'address',
                    },
                    {
                        data: 'latitude',
                    },
                    {
                        data: 'longitude',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'action',
                    },
                ],
            })

        });

        function branchModal() {
            $("#createBranchModal").modal('show');
        }
        $("#createBranchForm").on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: "{{ route('branches.store') }}",
                data: formData,
                success: function(data) {
                    $("#branchesTable").DataTable().ajax.reload();
                    $("#createBranchModal").modal('hide');
                    $("#createBranchForm")[0].reset();
                },
                error: function(data) {
                    console.log(data);
                }
            });

        });

        function editBranch(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('branches.show', '') }}/" + id,
                data: {
                    id: id
                },
                success: function(data) {
                    branchId = data.id;
                    $("#editBranchModal").modal('show');
                    $("#editBranchForm").find("input[name='name']").val(data.name);
                    $("#editBranchForm").find("input[name='address']").val(data.address);
                    $("#editBranchForm").find("input[name='latitude']").val(data.latitude);
                    $("#editBranchForm").find("input[name='longitude']").val(data.longitude);
                    $("#editBranchForm").find("input[name='created_at']").val(data.created_at);
                    $("#editBranchForm").find("input[name='action']").val(data.action);
                },
                error: function(data) {
                    console.log(data);
                }

            });
        }

        $("#editBranchForm").on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serializeArray();
            $.ajax({
                type: 'PUT',
                url: "{{ route('branches.update', '') }}/" + branchId,
                data: formData,
                success: function(data) {
                    $("#branchesTable").DataTable().ajax.reload();
                    $("#editBranchModal").modal('hide');
                    $("#editBranchForm")[0].reset();
                },
                error: function(data) {
                    console.log(data);
                }

            });
        });

        function deleteBranch(id) {
            if (confirm("Are you sure to delete this branch ?") == false) {
                return;
            }
            $.ajax({
                type: 'DELETE',
                url: "{{ route('branches.destroy', '') }}/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $("#branchesTable").DataTable().ajax.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }
    </script>
@endsection
