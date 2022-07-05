@props(['subCategories'=>$subCategories])
<table id="sub_category_table" class="display" data-target="{{ url('/administrator/sub-category') }}">
    <thead>
        <tr>
            <th>Sub Category Name</th>
            <th> Category</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="sub_category_body">
        @foreach ($subCategories as $subCategory)
            <tr data-parent="{{ $subCategory->parent->id }}">
                <td class="details-control">{{ $subCategory->name }}</td>
                <td>{{ $subCategory->parent->name }}</td>
                <td>{{ Str::ucfirst($subCategory->created_by) }}</td>
                <td>{{$subCategory->created_at}}</td>
                <td data-subCategoryId="{{ $subCategory->id }}">
                    <i class="fa fa-trash deleteSubCategory" title="Delete" style="margin-right: 20px;cursor: pointer;" aria-hidden="true"></i>
                    <i class="fa fa-edit editSubCategory" title="Edit" style="cursor: pointer;margin-right: 20px" aria-hidden="true"></i>
                    <i class="fa fa-ban suspendSubCategory" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>