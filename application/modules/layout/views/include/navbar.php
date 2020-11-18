<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <h1 class="h4 ml-2 mb-0 text-gray-800"><?= (isset($title)) ? $title : ''; ?></h1>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- notif di sini -->
    <?php // tampil_notif(); 
    ?>

    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Nav Item - User Information -->
    <li class="nav-item ">
      <a class="nav-link">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('fullname'); ?></span>
        <?= ($this->session->userdata('role') == 3) ? profPic($this->session->userdata('studentid'), 30) : ''; ?>
      </a>

    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" title="Log keluar" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- End of Topbar -->