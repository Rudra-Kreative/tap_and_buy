@extends('administrator.layouts.admin', ['title' => 'Add Business'])

@section('admin_css')
    <style>
        span.alert-danger {
            margin: 5px 0px 0px 0px;
            padding: 0 5px;
            display: table;
        }
    </style>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Business</h3>
                </div>



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
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cat')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Business name --}}
                                <div class="form-group">
                                    <label for="business_name">Business name</label>
                                    <input type="email" class="form-control" id="business_name" name="business_name"
                                        placeholder="Enter business name" />
                                    @error('business_name')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Business about --}}
                                <div class="form-group">
                                    <label>Business about</label>
                                    <textarea class="form-control" rows="3" name="business_about" placeholder="Enter business about"></textarea>
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
                                    <input type="text" class="form-control" id="business_slug" name="business_slug"
                                        placeholder="Enter business slug" />
                                    @error('business_slug')
                                        <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Business about --}}
                                <div class="form-group">
                                    <label>Business website</label>
                                    <textarea class="form-control" rows="3" name="business_website" placeholder="Enter business site"></textarea>
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

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin_js')
<script src="{{ asset('admin/dist/js/admin.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {

            $('body').on('click', '#cat', function() {

                let cid = $(this).val();

                $.ajax({
                    url: "{{ route('administrator.fetch_subcat') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: cid
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.category !== null) {
                            $('#subcat').html(resp.category);
                        } else {
                            $('#subcat').html(resp.category);
                        }
                    }
                });
            });

            @if (Session::has('success'))
                Swal.fire(
                    'Good job!',
                    "{{ Session::get('success') }}",
                    'success'
                )
            @endif

        });
    </script>
@endsection
