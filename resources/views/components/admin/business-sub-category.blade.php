
<table id="sub_category_table" class="display">
    <thead>
        <tr>
            <th>Sub Category Name</th>
            <th> Category</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subCategories as $subCategory)
            <tr>
                <td class="details-control">{{ $subCategory->name }}</td>
                <td>{{ $subCategory->parent->name }}</td>
                <td>{{ Str::ucfirst($subCategory->created_by) }}</td>
                <td>{{$subCategory->created_at}}</td>
                <td>
                    <i class="fa fa-trash" title="Delete" style="margin-right: 20px;cursor: pointer;" aria-hidden="true"></i>
                    <i class="fa fa-edit" title="Edit" style="cursor: pointer;margin-right: 20px" aria-hidden="true"></i>
                    <i class="fa fa-ban" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>