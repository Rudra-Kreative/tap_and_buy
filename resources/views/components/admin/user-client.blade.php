@props(['clients'=>$clients])
<table id="business_owner_table" class="display" data-target="{{ url('/administrator/category') }}">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>occupation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="business_owner_body" >
       @foreach ($clients as $client)
       
           <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->location }}</td>
            <td>{{ $client->occupation }}</td>
            <td data-ownerId="{{ $client->id }}">
                <i class="fa fa-trash fa-xs deleteCategory" title="Delete"   style="margin-right: 5px;cursor: pointer;" aria-hidden="true"></i>
                <i class="fa fa-edit fa-xs editCategory" title="Edit" style="cursor: pointer;margin-right: 5px" aria-hidden="true"></i>
                <i class="fa fa-ban fa-xs" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>
            </td>
           </tr>
       @endforeach
    </tbody>
</table>