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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Sub Category</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </x-slot>
    
    <x-admin.business-sub-category/>
    <x-slot name="addOnJs">
        
    </x-slot>
</x-administrator-app-layout>