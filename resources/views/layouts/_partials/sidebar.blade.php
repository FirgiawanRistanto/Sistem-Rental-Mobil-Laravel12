        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <div class="d-flex sidebar-profile">
              <div class="sidebar-profile-image">
                <img src="{{ Auth::user()->foto ? asset('images/' . Auth::user()->foto) : url('assets/images/faces/face29.png') }}" alt="image">
                <span class="sidebar-status-indicator"></span>
              </div>
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                  {{ Auth::user()->name }}
                </p>
                <p class="sidebar-designation">
                  Welcome
                </p>
              </div>
            </div>
            <div class="nav-search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                <div class="input-group-append">
                  <span class="input-group-text" id="search">
                    <i class="typcn typcn-zoom"></i>
                  </span>
                </div>
              </div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
          </li>
          <li class="nav-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users') }}">
              <i class="typcn typcn-group menu-icon"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/penjualan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.penjualan') }}">
              <i class="typcn typcn-chart-area menu-icon"></i>
              <span class="menu-title">Penjualan</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/products*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.products.index') }}">
              <i class="typcn typcn-shopping-bag menu-icon"></i>
              <span class="menu-title">Produk</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
              <i class="typcn typcn-th-list menu-icon"></i>
              <span class="menu-title">Kategori</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
              <i class="typcn typcn-clipboard menu-icon"></i>
              <span class="menu-title">Pesanan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-briefcase menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="typcn typcn-chevron-right menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
