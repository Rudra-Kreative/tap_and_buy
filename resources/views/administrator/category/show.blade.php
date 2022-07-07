<x-administrator-app-layout>
    <x-slot name="addOnCss">

    </x-slot>
    <x-slot name='header'>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-primary btn-lg mt-4" id="category_create"
                    style="width: 100px">Create</button>

                <div id="category_form_div" style="{{ $errors->any() ? 'display: block' : 'display:none' }}">
                    <form action="{{ route('administrator.category.store') }}" method="POST">
                        @csrf
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" required id="name"
                                    placeholder="Enter category name">
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"
                                    placeholder="Enter unique slug">
                                @error('slug')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div style="padding: .75rem 1.25rem;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </x-slot>
    <x-admin.business-category :categories="$categories"/>

    <x-slot name="addOnJs">
        <script src="{{ asset('admin/dist/js/pages/category.js') }}"></script>
    </x-slot>
</x-administrator-app-layout>
