 <!-- Sidebar -->
 <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
             <img src="{{ asset(auth()->user()->image_path) }}" class="img-circle elevation-2"
                 style="height: 50px;width: 50px" alt="User Image">
         </div>
         <div class="info">
             <a href="{{ route('administrator.dashboard') }}"
                 class="d-block">{{ Auth::guard('administrator')->user()->name }}</a>
         </div>
     </div>

     <!-- SidebarSearch Form -->
     <div class="form-inline">
         <div class="input-group" data-widget="sidebar-search">
             <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
             <div class="input-group-append">
                 <button class="btn btn-sidebar">
                     <i class="fas fa-search fa-fw"></i>
                 </button>
             </div>
         </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

             <li class="nav-item ">
                 <a href="{{ route('administrator.dashboard') }}" class="nav-link active">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                         Dashboard

                     </p>
                 </a>
             </li>
             <li class="nav-item ">
                 <a href="#" class="nav-link ">
                     <i class="fas fa-list-alt"></i>
                     <p>
                         Categories
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('administrator.category.view') }}" class="nav-link">
                             <i class="fas fa-eye nav-icon"></i>
                             <p>Show</p>
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="nav-item ">
                 <a href="#" class="nav-link ">
                     <i class="nav-icon fas fa-list"></i>
                     <p>
                         Sub-Category
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('administrator.sub-category.view') }}" class="nav-link">
                             <i class="fas fa-eye nav-icon"></i>
                             <p>Show</p>
                         </a>
                     </li>
                 </ul>
             </li>

             {{-- Business Routes --}}
             <li class="nav-item ">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-briefcase"></i>
                     <p> Business <i class="right fas fa-angle-left"></i> </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('administrator.businesses_add') }}" class="nav-link">
                             <i class="fas fa-plus nav-icon"></i>
                             <p>Create</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('administrator.business_list') }}" class="nav-link">
                             <i class="fas fa-eye nav-icon"></i>
                             <p>Show</p>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>
     </nav>
     <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
