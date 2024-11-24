<!-- Menu -->
        
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bold ms-2">DoIndie</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
            </a>
          </div>
          
          <div class="menu-inner-shadow"></div>
          
          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item <?php if ($view == 'admin/adminDashBoardView') echo 'active' ?>">
              <a href="<?php echo BASEURL; ?>admin" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
                <!-- <span class="badge rounded-pill bg-danger ms-auto">5</span> -->
              </a>
            </li>

            <!-- USERS -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Users</span>
            </li>
            <li class="menu-item <?php if ($view == 'admin/adminUsersListView') echo 'active' ?>">
              <a href="<?php echo BASEURL; ?>admin/users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Basic">Users</div>
              </a>
            </li>
            <li class="menu-item <?php if ($view == 'admin/adminArtistsListView') echo 'active' ?>">
              <a href="<?php echo BASEURL; ?>admin/artists" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div class="text-truncate" data-i18n="Basic">Artists</div>
              </a>
            </li>
            <li class="menu-item <?php if ($view == 'admin/adminAdminsListView') echo 'active' ?>">
              <a href="<?php echo BASEURL; ?>admin/admins" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div class="text-truncate" data-i18n="Basic">Admins</div>
              </a>
            </li>

            <!-- PRODUCTS -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Products</span>
            </li>
            <li class="menu-item <?php if ($view == 'admin/adminProductsListView') echo 'active' ?>">
              <a href="<?php echo BASEURL; ?>admin/products" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div class="text-truncate" data-i18n="Basic">Products</div>
              </a>
            </li>
            
            <!-- TRANSACTIONS -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Transactions</span>
            </li>
            <li class="menu-item <?php if ($view == 'admin/adminTransactionsListView') echo 'active' ?>">
              <a href="<?php echo BASEURL; ?>admin/transactions" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div class="text-truncate" data-i18n="Basic">Orders</div>
              </a>
            </li>
            <!-- <li class="menu-item">
              <a href="<?php echo BASEURL; ?>admin/receipts" class="menu-link">
                <i class="menu-icon tf-icons bx bx-receipt"></i>
                <div class="text-truncate" data-i18n="Basic">Receipts</div>
              </a>
            </li> -->
            
            <!-- Support and Helpdesk -->
            <!-- <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Support and Helpdesk</span>
            </li>
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-dots"></i>
                <div class="text-truncate" data-i18n="Basic">Concerns</div>
              </a>
            </li> -->
            
            <!-- Settings -->
            <!-- <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Sitewide Settings</span>
            </li>
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="text-truncate" data-i18n="Basic">Settings</div>
              </a>
            </li> -->
            
          
          </ul>
        </aside>
        <!-- / Menu -->