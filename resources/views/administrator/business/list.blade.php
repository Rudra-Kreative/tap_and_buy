@extends('administrator.layouts.admin', ['title' => 'list Business'])

@section('admin_css')
    <style>
        #table_id_wrapper {
            padding: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">List Business</h3>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>About</th>
                                <th>Website</th>
                                <th>Service form</th>
                                <th>Service to</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($business as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->about }}</td>
                                    <td>{{ $item->website }}</td>
                                    <td>{{ $item->service_form }}</td>
                                    <td>{{ $item->service_to }}</td>
                                    <td>{{ $item->category_id }}</td>
                                    <td>{{ $item->user_id }}</td>
                                    <td>
                                        <a href="{{ route('administrator.business_delete', $item->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endsection

    @section('admin_js')
        <!-- Page level plugins -->
        <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/dist/js/admin.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {

                @if (Session::has('success'))
                    Swal.fire(
                        'Good job!',
                        "{{ Session::get('success') }}",
                        'success'
                    )
                @endif

                $('#table_id').DataTable();
            });
        </script>
    @endsection
