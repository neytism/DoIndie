<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
  data-assets-path="<?php echo BASEURL; ?>assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>DoIndie Admin</title>

  <meta name="description" content="" />


  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/vendor/css/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?php echo BASEURL; ?>assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?php echo BASEURL; ?>assets/js/admin/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <?php include 'app/views/admin/navigationPanelView.php'; ?>

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
              <i class="bx bx-menu bx-md"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search bx-md"></i>
                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..."
                  aria-label="Search..." />
              </div>
            </div>
            <!-- /Search -->

            <?php include 'app/views/admin/adminIconView.php'; ?>
            
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Hoverable Table rows -->
            <div class="card">
              <h5 class="card-header">All Admins</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php if (count($data['artist_categories']) <= 0): ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($data['artist_categories'] as $cetegory): ?>
                        <tr>
                          <td><?= $cetegory["artist_category_id"] ?></td>
                          <td id="label-row-<?= $cetegory["artist_category_id"] ?>" style="width: 100%; display: table-cell;"><?= $cetegory["artist_category_name"] ?></td>
                          <td id="input-row-<?= $cetegory["artist_category_id"] ?>" style="width: 100%; display: none;">
                              <input type="text" id="input-<?= $cetegory["artist_category_id"] ?>" placeholder="Enter category name" value="<?= $cetegory["artist_category_name"] ?>" class="form-control"> </td>
                          <td id="kebab-buttons-row-<?= $cetegory["artist_category_id"] ?>">
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="editButtonClicked('label-row-<?= $cetegory['artist_category_id'] ?>','input-row-<?= $cetegory['artist_category_id'] ?>'); editButtonClicked('kebab-buttons-row-<?= $cetegory['artist_category_id'] ?>','edit-buttons-row-<?= $cetegory['artist_category_id'] ?>')"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                              </div>
                            </div>
                          </td>
                          <td id="edit-buttons-row-<?= $cetegory["artist_category_id"] ?>" style="width: 100%; display: none;">
                              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" onclick="updateArtistCategoryName(event, '<?= BASEURL; ?>', 'input-<?= $cetegory['artist_category_id'] ?>', '<?= $cetegory['artist_category_id'] ?>', '<?= $cetegory['artist_category_name'] ?>'); cancelEditButtonClicked('label-row-<?= $cetegory['artist_category_id'] ?>','input-row-<?= $cetegory['artist_category_id'] ?>'); cancelEditButtonClicked('kebab-buttons-row-<?= $cetegory['artist_category_id'] ?>','edit-buttons-row-<?= $cetegory['artist_category_id'] ?>')">
                                save
                              </button>
                              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" onclick="cancelEditButtonClicked('label-row-<?= $cetegory['artist_category_id'] ?>','input-row-<?= $cetegory['artist_category_id'] ?>'); cancelEditButtonClicked('kebab-buttons-row-<?= $cetegory['artist_category_id'] ?>','edit-buttons-row-<?= $cetegory['artist_category_id'] ?>')">
                                cancel
                              </button>
                          </td>
                          
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                      <tr id="add-category-row" style="display: none;">
                          <td></td>
                          <td style="width: 100%;">
                              <input type="text" id="new-category-name" placeholder="Enter category name" class="form-control">
                          </td>
                          <td >
                              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" onclick="addNewArtistCategory(event, '<?= BASEURL; ?>', 'new-category-name'); addButtonClicked('add-category-row', 'add-category-button' )">
                                save
                              </button>
                              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" onclick="addButtonClicked('add-category-row', 'add-category-button' )">
                                cancel
                              </button>
                          </td>
                      </tr>
                      <tr id="add-category-button">
                          <td colspan="3">
                              <button onclick="addButtonClicked('add-category-button', 'add-category-row' )" type="button" class="btn" id="add-category-btn" style="width: 100%;">Add Category +</button>
                          </td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->

          </div>
          <!-- / Content -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

  <script src="<?php echo BASEURL; ?>assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?php echo BASEURL; ?>assets/vendor/libs/popper/popper.js"></script>
  <script src="<?php echo BASEURL; ?>assets/vendor/js/bootstrap.js"></script>
  <script src="<?php echo BASEURL; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?php echo BASEURL; ?>assets/vendor/js/menu.js"></script>

    
  <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/admin/admin.js"></script>
  
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?php echo BASEURL; ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="<?php echo BASEURL; ?>assets/js/admin/main.js"></script>

  <!-- Page JS -->
  <script src="<?php echo BASEURL; ?>assets/js/admin/dashboards-analytics.js"></script>

  <!-- Place this tag before closing body tag for github widget button. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>