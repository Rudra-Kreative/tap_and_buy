@props(['eventCategories' => $eventCategories])

<table id="event_category_table" class="display" data-target="{{ url('/administrator/event/category') }}">
    <thead>
        <tr>
            <th>Name</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="event_category_body">
        @foreach ($eventCategories as $eventCategory)
            <tr>
                <td>{{ $eventCategory->name }}</td>
                <td>{{ $eventCategory->creatable->name }}</td>
                <td>{{ $eventCategory->created_at }}</td>
                <td data-eventCategoryId="{{ $eventCategory->id }}">
                    @can('delete', $eventCategory)
                        <i class="fa fa-trash deleteEventCategory" title="Delete" style="margin-right: 20px;cursor: pointer;"
                            aria-hidden="true"></i>
                    @endcan
                    @can('update', $eventCategory)
                        <i class="fa fa-edit editEventCategory" title="Edit" style="cursor: pointer;margin-right: 20px"
                            aria-hidden="true"></i>
                    @endcan

                        @if ($eventCategory->is_active)
                        <i class="fa fa-ban suspendEventCategory" title="Suspend" style="cursor: pointer"
                        aria-hidden="true"></i>
                        @else
                        <i class="fas fa-trash-restore suspendEventCategory" style="color: green;cursor: pointer" title="Reinstate" style="cursor: pointer"
                            aria-hidden="true"></i>
                        @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
