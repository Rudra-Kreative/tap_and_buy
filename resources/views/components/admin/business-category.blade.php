<table id="category_table" class="display" data-target="{{ url('/administrator/category') }}">
    <thead>
        <tr>
            <th>Name</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="category_body" >
        @foreach ($categories as $category)
            <tr>
                <td class="details-control">{{ $category->name }}</td>
                <td>{{ Str::ucfirst($category->created_by) }}</td>
                <td>{{$category->created_at}}</td>
                <td data-categoryId="{{ $category->id }}">
                    <i class="fa fa-trash deleteCategory" title="Delete"   style="margin-right: 20px;cursor: pointer;" aria-hidden="true"></i>
                    <i class="fa fa-edit editCategory" title="Edit" style="cursor: pointer;margin-right: 20px" aria-hidden="true"></i>
                    <i class="fa fa-ban" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>