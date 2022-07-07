@extends('administrator.layouts.admin', ['title' => 'list Business'])

@section('admin_css')
    <style>
        #table_id_wrapper {
            padding: 15px;
        }

        .modal {
            overflow-y: auto;
        }

        .modal-dialog {
            max-width: 800px;
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
                    <table class="table table-bordered" id="table_id" width="100%">
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
                                <th>Edit</th>
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
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <a href="{{ route('administrator.business_delete', $item->id) }}"
                                            class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-eid="{{ $item->id }}"
                                            class="btn btn-primary businessEdit">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- business edit model --}}
        <div class="modal" id="businessEditModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Business edit</h4>
                        <button type="button" class="modalclose close">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('administrator.businesse_create') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">

                                        {{-- Business Category --}}
                                        <div class="form-group">
                                            <label>Select category</label>
                                            <select class="form-control" id="cat" name="cat">
                                                <option value="">Select Category</option>
                                            </select>
                                            @error('cat')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business name --}}
                                        <div class="form-group">
                                            <label for="business_name">Business name</label>
                                            <input type="email" class="form-control" id="business_name"
                                                name="business_name" placeholder="Enter business name" />
                                            @error('business_name')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business about --}}
                                        <div class="form-group">
                                            <label>Business about</label>
                                            <textarea class="form-control" rows="3" id="business_about" name="business_about" placeholder="Enter business about"></textarea>
                                            @error('business_about')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business Service form --}}
                                        <div class="form-group">
                                            <label for="business_service_form">Service form</label>
                                            <input type="text" class="form-control" id="business_service_form"
                                                name="business_service_form" placeholder="Enter Service form">
                                            @error('business_service_form')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        {{-- Business Sub Category --}}
                                        <div class="form-group">
                                            <label>Select Sub Category</label>
                                            <select class="form-control" id="subcat" name="subcat">
                                            </select>
                                            @error('subcat')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business slug --}}
                                        <div class="form-group">
                                            <label for="business_slug">Business slug</label>
                                            <input type="text" class="form-control" id="business_slug"
                                                name="business_slug" placeholder="Enter business slug" />
                                            @error('business_slug')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business about --}}
                                        <div class="form-group">
                                            <label>Business website</label>
                                            <textarea class="form-control" rows="3" id="business_website" name="business_website" placeholder="Enter business site"></textarea>
                                            @error('business_website')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business Service to --}}
                                        <div class="form-group">
                                            <label for="business_service_to">Service to</label>
                                            <input type="text" class="form-control" id="business_service_to"
                                                name="business_service_to" placeholder="Enter Service to" />
                                            @error('business_service_to')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modalclose">Close</button>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    @section('admin_js')
        <!-- Page level plugins -->
        <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
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

                $('.modalclose').click(function() {
                    $("#businessEditModal").hide();
                });

                // business edit
                $('body').on('click', '.businessEdit', function(event) {
                    event.preventDefault();
                    var id = $(this).attr("data-eid");

                    $.ajax({
                        url: '{{ route('administrator.business_edit') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(resp) {
                            console.log(resp);
                            $("#businessEditModal").show();
                            $("#business_name").val(resp.name);
                            $("#business_slug").val(resp.slug);
                            $("#business_about").val(resp.about);
                            $("#business_website").val(resp.website);
                            $("#business_service_form").val(resp.service_form);
                            $("#business_service_to").val(resp.service_to);
                        }
                    });

                });

            });
        </script>
    @endsection
