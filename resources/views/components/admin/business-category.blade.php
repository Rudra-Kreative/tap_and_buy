
<ul class="nav nav-treeview">
    <li class="nav-item">
        <a href="./index.html" class="nav-link">
          <i class="fas fa-plus nav-icon"></i>
          <p>Create</p>
        </a>
      </li>
    @foreach ($categories as $category)
    <li class="nav-item">
        <a href="{{ route('administrator.category.show',[$category->slug]) }}" class="nav-link">
          {{-- <i class="fas fa-circle nav-icon"></i> --}}
          <p>{{ $category->name }}</p>
        </a>
      </li>
    @endforeach
    
  </ul>