@props(['owners'=>$owners])
<table id="business_owner_table" class="display" data-target="{{ url('/administrator/category') }}">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>occupation</th>
            <th>Total Business</th>
            <th>Selling Products</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="business_owner_body" >
       @foreach ($owners as $owner)
       
           <tr>
            <td>{{ $owner->name }}</td>
            <td>{{ $owner->email }}</td>
            <td>{{ $owner->phone }}</td>
            <td>{{ $owner->location }}</td>
            <td>{{ $owner->occupation }}</td>
            <td>{{ $owner->businesses_count }}</td>
            <td>{{ $owner->products_count }}</td>
            <td data-ownerId="{{ $owner->id }}">
                <i class="fa fa-trash fa-xs deleteCategory" title="Delete"   style="margin-right: 5px;cursor: pointer;" aria-hidden="true"></i>
                <i class="fa fa-edit fa-xs editCategory" title="Edit" style="cursor: pointer;margin-right: 5px" aria-hidden="true"></i>
                <i class="fa fa-ban fa-xs" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>
            </td>
           </tr>
       @endforeach
    </tbody>
</table>