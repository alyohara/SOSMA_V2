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
				<h4 class="page-title">Formularios</h4>
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
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<!-- ============================================================== -->
						<!-- New Company Message -->
						<!-- ============================================================== -->
						<?php if ($this->session->flashdata('msg')) {
							?>
							<div class="card-body" id="card-body">
								<!-- Comment Row -->
								<div class="d-flex flex-row comment-row m-t-0 ">
									<div class="btn btn-success btn-sm" style="width: 100%"><?php
										echo $this->session->flashdata('msg'); ?></div>
								</div>
								<!-- Comment Row -->
							</div>
							<?php
						} ?>
						<?php if ($this->session->flashdata('success_msg')) {
							?>
							<div class="card-body" id="card-body">
								<!-- Comment Row -->
								<div class="d-flex flex-row comment-row m-t-0 ">
									<div class="btn btn-success btn-sm" style="width: 100%"><?php
										echo $this->session->flashdata('success_msg'); ?></div>
								</div>
								<!-- Comment Row -->
							</div>
							<?php
						} ?>
						<?php if ($this->session->userdata('role') < 4) {
							?>
							<!-- Button trigger modal -->
							<a href="<?php base_url() ?>formAdd/">
								<button type="button" class="btn btn-success margin-5">
									Alta Nuevo Formulario
								</button>
							</a>
						<?php } ?>


					</div>
				</div>
				<div class="row">
					<?php
					if ( sizeof($stores)  == '0') {
					?>
					<div class="col-12">
						<div class="card">
							<div class="card-body">
									<div class="box bg-danger text-center">
										<h1 class="font-light text-white">Esta compañia no tiene tiendas asociadas</h1>
									</div>
							</div>
						</div>
					</div>
					<?php }?>

					<?php foreach ($stores as $store): ?>

						<div class="col-md-6 col-lg-2 col-xlg-3">
							<div class="card card-hover">
								<div class="box bg-white text-center">
									<a href="<?php base_url() ?>../store/<?php echo $store->id ?>/<?php echo $company_id ?>">
										<img src="../../assets/icons/folderIconSMS.png" width="120px">
										<h1 class="font-light text-white"><i></i></h1>
										<h6 class="text-black-50"><?php echo $store->name ?></h6>
									</a>
								</div>
							</div>
						</div>


					<?php endforeach; ?>


					<!-- Column -->




				</div>


		</div>

			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<a href="<?php base_url() ?>../	">
							<button type="button" class="btn btn-default margin-5">
								Volver
							</button>
						</a>
					</div>
				</div>
			</div>
		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!-- ============================================================== -->
		<!-- .right-sidebar -->
		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->

