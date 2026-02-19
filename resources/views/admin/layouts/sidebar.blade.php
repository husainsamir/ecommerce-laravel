@php
    $product = \App\Models\Product::latest()->first();
@endphp

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('adminLTE-master/dist/assets/img/AdminLTELogo.png') }}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                 <li class="nav-item">
               <a href="{{ route('category.index') }}" class="nav-link">
               <i class="nav-icon bi bi-folder-plus"></i>
              <p> Categories</p>
            </a>
          </li>

                  <li class="nav-item">
                     <a href="{{ route('product.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Products</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Orders</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('coupons.index')}}" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Offers</p>
                </a>
              </li>
              <li class="nav-item">
                     <a href="" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Products Images</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./widgets/info-box.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>info Box</p>
                    </a>
                  </li>
                  <li class="nav-item">
                   <a href="./widgets/cards.html" class="nav-link">
                       <i class="nav-icon bi bi-circle"></i>
                      <p>Cards</p>
                    </a>
                  </li>

                   <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Logout</p>
                    </a>
                  </li>
                </ul>
              </li>
             
             <li class="nav-item">
        
            <!--end::Sidebar Menu-->
                
           </nav>
        </div>
        <!--end::Sidebar Wrapper-->
        </aside>