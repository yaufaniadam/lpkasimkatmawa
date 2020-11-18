<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion toggled" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center toggledd" href="<?= base_url("mahasiswa/surat"); ?>">
		<div class="sidebar-brand-icon">
			<img src="<?= base_url() ?>public/dist/img/logo.png" width="40px" height="" />
		</div>
		<div class="sidebar-brand-text mx-3">SIMKATMAWA</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard
	<li class="nav-item" id="menu_dashboard">
		<a class="nav-link" href="<?= base_url("admin/dashboard"); ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li> -->

	<li class="nav-item" id="menu_surat">
		<a class="nav-link" href="<?= base_url("mahasiswa/surat"); ?>">
			<i class="fas fa-fw fa-envelope"></i>
			<span>Surat Saya</span></a>
	</li>

	<!-- Heading 
	<div class="sidebar-heading">
		Administrator
	</div>
-->



	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->