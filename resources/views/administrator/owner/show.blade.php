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
                        <form action="{{ route('administrator.owner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-body">

                                <div class="form-group">
                                    <img src="https://i.pravatar.cc/150" id="file-dp-1-preview" style="height: 100px; width: 100px;" class="rounded float-right inline mb-4" alt="...">
                                    
                                    <input type="file" class="form-control" name="image" required id="image"
                                        placeholder="Enter category name" onchange="showPreview(event);">
                                    @error('image')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required id="name"
                                        placeholder="Enter business name">
                                    @error('name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                

                                {{-- <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Business Owner</option>
                                        <option value="">Client</option>
                                    </select>
                                    @error('role')
                                        <span style="color: red">{{ $role }}</span>
                                    @enderror
                                </div> --}}

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required id="email"
                                        placeholder="Enter your email address" value="{{ old('email') }}">
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" required id="phone"
                                        placeholder="Enter your phone number" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" name="location" required id="location"
                                        placeholder="Enter your location" value="{{ old('location') }}">
                                    @error('location')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" name="occupation" required id="occupation"
                                        placeholder="Enter your occupation" value="{{ old('occupation') }}">
                                    @error('occupation')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="timezone">Select timezone (optional)</label>
                                    <select name="timezone" id="timezone" class="form-control">
                                        <option value="">Select a timezone</option>
                                        @foreach ($tzs as $tz)
                                            <option value="{{ $tz }}">{{ $tz }}</option>
                                        @endforeach
                                    </select>
                                    @error('timezone')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                            
    
                            <div class="owner_form_button" style="background-color: none">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
            </div><!-- /.col -->
            

        </div><!-- /.row -->
    </x-slot>
    <x-admin.user-business-owner  :ownerLists="$ownerLists"/>

    <x-slot name="addOnJs">
        <script src="{{ asset('admin/dist/js/pages/owner.js') }}"></script>
    </x-slot>
</x-administrator-app-layout>
