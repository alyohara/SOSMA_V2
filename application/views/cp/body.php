
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Dashboard</h4>
				<div class="ml-auto text-right">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $breadCrum ?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Sales Cards  -->
		<!-- ============================================================== -->
		<div class="row">
			<!-- Column -->
			<?php if ($this->session->role < 4) {
			?>
			<div class="col-md-12 col-lg-3 col-xlg-4">
				<div class="card card-hover">
					<a href="<?php echo base_url()?>usersABM/">
					<div class="box bg-white text-center">
						<h1 class="font-light text-cyan"><i class="mdi mdi-account"></i></h1>
						<h6 class="text-cyan">Usuarios</h6>
                        <h1 class="mb-0 " style="text-color: #98a39a"><?php echo $users?></h1>
					</div>
					</a>
				</div>
			</div>
			<?php }
			?>
			<!-- Column -->
			<div class="col-md-12 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<a href="<?php echo base_url()?>companiesABM/">
					<div class="box bg-white text-center">
						<h1 class="font-light text-success"><i class="mdi mdi-city"></i></h1>
						<h6 class="text-success">Compañías</h6>
                        <h1 class="mb-0 " style="text-color: #98a39a"><?php echo $companies?></h1>
					</div>
					</a>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-12 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<a href="<?php echo base_url()?>storesABM/">
						<div class="box bg-white text-center">
							<h1 class="font-light text-orange"><i class="mdi mdi-store"></i></h1>
							<h6 class="text-orange">Tiendas</h6>
                            <h1 class="mb-0 " style="text-color: #98a39a"><?php echo $stores?></h1>
						</div>
					</a>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-12 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<a href="<?php echo base_url()?>forms/">
					<div class="box bg-white text-center">
						<h1 class="font-light text-info"><i class="mdi mdi-receipt"></i></h1>
						<h6 class="text-info">Formularios</h6>
                        <h1 class="mb-0 " style="text-color: #98a39a"><?php echo $forms?></h1>
					</div>
					</a>
				</div>
			</div>
			<div class="col-md-12 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<a href="<?php echo base_url()?>visitas/">
						<div class="box bg-white text-center">
							<h1 class="font-light text-purple"><i class="mdi mdi-car"></i></h1>
							<h6 class="text-purple">Visitas</h6>
                            <h1 class="mb-0 " style="text-color: #98a39a"><?php echo $visitas?></h1>
						</div>
					</a>
				</div>
			</div>
			
		</div>

	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->
