@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row m-3 d-flex text-end">
            <div>
                <form action="{{ route('admins.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <h3>Branch History</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="historyTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Branch Name</th>
                                <th>Action</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#historyTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('branch-histories.index') }}",
                order: [6, 'desc'],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.name',
                    },
                    {
                        data: 'branch.name',
                    },
                    {
                        data: 'action',
                    },
                    {
                        data: 'created_at',
                    },

                ],
            })

        });
    </script>
@endsection
