<x-administrator-app-layout>
    <x-slot name="addOnCss">

    </x-slot>
    <x-slot name='header'>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Event</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Event</li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-primary btn-lg mt-4" id="event_create"
                    style="width: 100px">Create</button>

                <div id="event_form_div" style="{{ $errors->any() ? 'display: block' : 'display:none' }}">
                    <form action="{{ route('administrator.event.category.store') }}" method="POST">
                        @csrf
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control emoji-area" name="name" required id="name"
                                    placeholder="Enter event">
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tagline">Name</label>
                                <input type="text" class="form-control" name="tagline" required id="tagline"
                                    placeholder="Enter event tagline">
                                @error('tagline')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">Desc</label><br>
                                <textarea name="desc" id="desc" cols="65" rows="3"></textarea>
                                @error('desc')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Location/City/Address</label>
                                <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
                            </div>
                            <div class="form-group" id="latitudeArea">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="latitude"
                                    >
                                @error('latitude')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="longtitudeArea">
                                <label for="longitude">Location</label>
                                <input type="text" class="form-control" name="longitude" id="longitude"
                                   >
                                @error('longitude')
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

    <x-slot name="addOnJs">
        <script src="{{ asset('admin/dist/js/pages/event.js') }}"></script>
    </x-slot>
</x-administrator-app-layout>
