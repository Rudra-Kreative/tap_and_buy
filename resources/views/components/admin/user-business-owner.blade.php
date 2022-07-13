@props(['ownerLists'=>$ownerLists])

<table id="business_owner_table" class="display" data-target="{{ url('/administrator/owner') }}">
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
       @foreach ($ownerLists as $ownerList)
       
           <tr>
            <td style="text-align: center">
                
                <img class="rounded-circle" style="width: 50px;height: 50px;" src="{{$ownerList->image_path ? asset($ownerList->image_path) : 'https://i.pravatar.cc/50?u='.$ownerList->id }}" alt="">
                
                <p>{{ $ownerList->name }}</p>
            </td>
            <td>{{ $ownerList->email }}</td>
            <td>{{ $ownerList->phone }}</td>
            <td>{{ $ownerList->location }}</td>
            <td>{{ $ownerList->occupation }}</td>
            <td>{{ $ownerList->businesses_count }}</td>
            <td>{{ $ownerList->products_count }}</td>
            <td data-ownerId="{{ $ownerList->id }}">
                <i class="fa fa-trash fa-xs deleteOwner" title="Delete"   style="margin-right: 5px;cursor: pointer;" aria-hidden="true"></i>
                <i class="fa fa-edit fa-xs editOwner" title="Edit" style="cursor: pointer;margin-right: 5px" aria-hidden="true"></i>
                <i class="fa fa-ban fa-xs" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>
            </td>
           </tr>
       @endforeach
    </tbody>
</table>