<x-administrator-app-layout>
    <x-slot name="addOnCss">

    </x-slot>
    <x-slot name='header'>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sub Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sub Category</li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-primary btn-lg mt-4" id="sub_category_create"
                    style="width: 100px">Create</button>

                    <div id="sub_category_form_div" style="{{ $errors->any() ? 'display: block' : 'display:none' }}">
                        <form action="{{ route('administrator.sub-category.store') }}" method="POST">
                            @csrf
                            
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group" >
                                        <label>Parent Category</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="parent" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">Select parent category</option>
                                          @foreach ($categories as $category)
                                              <option value="{{ $category->id }}" data-select2-id="{{ $category->id }}">{{ $category->name }}</option>
                                          @endforeach
                                        </select>
                                        @error('parent')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required id="name"
                                        placeholder="Enter category name" value="{{ old('name') }}">
                                    @error('name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="Enter unique slug" value="{{ old('slug') }}">
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
            </div>
        </div><!-- /.row -->
    </x-slot>
    
    <x-admin.business-sub-category :subCategories="$subCategories"/>
    
    <x-slot name="addOnJs">
        <script src="{{ asset('admin/dist/js/pages/sub-category.js') }}"></script>
    </x-slot>
</x-administrator-app-layout>