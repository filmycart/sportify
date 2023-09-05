<?php
  $s_config = new Site_Config();
  if(!empty($admin->id)) {
      $s_config = $s_config->where(["admin_id" => $admin->id])->one();
  } else {
      $s_config->title = "Welcome";
      $s_config->tag_line = "A Simple Website";
      $s_config->favicon_image_name = "";
  }

  $current = basename($_SERVER["SCRIPT_FILENAME"]);
  $index = $users = $setting = $admob = $site_config = $push_notifications = $products = $categories = "";
  $payment = $attributes = $orders = $sub_categories = "";

  if($current == "index.php") $index = "active";
  else if(($current == "cms.php") ||($current == "cms-form.php")) $cms_page = "active";
  else if(($current == "categories.php") ||($current == "category-form.php")) $categories = "active";
  else if(($current == "sub-categories.php") ||($current == "sub-category-form.php")) $sub_categories = "active";
  else if(($current == "products.php") ||($current == "product-form.php")) $products = "active";
  else if(($current == "events.php") ||($current == "event-form.php")) $events = "active";
  else if(($current == "attributes.php") ||($current == "attribute-form.php")) $attributes = "active";
  else if(($current == "orders.php") || ($current == "order-detail.php") || ($current == "generate-invoice.php")) $orders = "active";
  else if($current == "payment.php") $payment = "active";
  else if($current == "users.php") $users = "active";
  else if(($current == "sliders.php") ||($current == "slider-form.php")) $sliders = "active";
  else if($current == "setting.php") $setting = "active";
  else if($current == "admob.php") $admob = "active";
  else if($current == "site-config.php") $site_config = "active";
  else if(($current == "push-notifications.php") || $current == "push-notification-form.php") $push_notifications = "active";

  $admin = Session::get_session(new Admin());
  $siteConfig = Session::get_session(new Site_Config());
?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo "uploads" . DIRECTORY_SEPARATOR . $s_config->favicon_image_name; ?>" class="brand-link">
      <img src="<?php echo "uploads" . DIRECTORY_SEPARATOR . $s_config->favicon_image_name; ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=($s_config->title)?$s_config->title:''?> - <?=($s_config->tag_line)?$s_config->tag_line:''?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo (!empty($admin->username)?ucfirst($admin->username):'') ?></a>
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
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Event
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="events.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
                <!-- <a href="event-form.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Event</p>
                </a> -->
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Booking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="bookings.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


