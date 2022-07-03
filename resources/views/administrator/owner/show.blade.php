<x-administrator-app-layout>
    <x-slot name="addOnCss">

    </x-slot>
    <x-slot name='header'>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Business Owner</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Business Owner</li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-primary btn-lg mt-4" id="business_owner_create"
                    style="width: 100px">Register</button>


                    <div id="business_owner_form_div" style="{{ $errors->any() ? 'display: block' : 'display:none' }}">
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
                                
    
                            </div>
                            <!-- /.card-body -->
    
                            <div class="card-footer" style="background-color: none">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
            </div><!-- /.col -->
            

        </div><!-- /.row -->
    </x-slot>
    <x-admin.user-business-owner  :owners="$owners"/>

    <x-slot name="addOnJs">
        
    </x-slot>
</x-administrator-app-layout>
