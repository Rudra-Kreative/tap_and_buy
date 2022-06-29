<x-administrator-app-layout>
    <x-slot name='header'>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard - 1</h1>
                <p>hello</p>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </x-slot>

    <x-admin.dashboard-stat-section />

    <x-slot name="extraCSS"> </x-slot>

    <x-slot name="extraFooterScript"> </x-slot>

</x-administrator-app-layout>
