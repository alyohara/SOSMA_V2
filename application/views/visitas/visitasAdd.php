
<?php //echo $error;?>




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
				<h4 class="page-title">Visitas</h4>
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
						<!-- New User Message -->
						<!-- ============================================================== -->
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
						<?php if ($this->session->flashdata('error_msg')) {
							?>
							<div class="card-body" id="card-body">
								<!-- Comment Row -->
								<div class="d-flex flex-row comment-row m-t-0 ">
									<div class="btn btn-danger btn-sm" style="width: 100%"><?php
										//										echo $this->session->flashdata('error_msg');
										var_dump($this->session->flashdata('error_msg')); ?>
									</div>
								</div>
								<!-- Comment Row -->
							</div>
							<?php
						} ?>
						<!-- ============================================================== -->
						<!-- New User Form Validator -->
						<!-- ============================================================== -->
						<?php if (validation_errors()) {
							?>
							<div id="alert-danger">

							</div>
							<?php
						} ?>

						<!-- ============================================================== -->
						<!-- New Company Form -->
						<!-- ============================================================== -->
						<!-- Form -->
						<?php echo form_open('visitas/visitasAddVisit');?>
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Carga Nueva Visita</h5>
								<div class="form-group row">
									<label class="col-md-2 m-t-15">Tienda</label>
									<div class="col-md-10">
										<?php echo form_dropdown($id_stores['name'], $id_stores['options'], $id_stores['selected'], $id_stores['extra']); ?>
									</div>


								</div>
								<div class="invalid-feedback">

								</div>
								<div class="form-group row">
									<label class="col-md-2 m-t-15">Usuario Responsable</label>
									<div class="col-md-10">
										<?php echo form_dropdown($id_user['name'], $id_user['options'], $id_user['selected'], $id_user['extra']); ?>
									</div>


								</div>
								<div class="invalid-feedback">

								</div>
								<div class="input-group row">
									<label class="col-md-2 m-t-15">Fecha</label>
									<input id="datepicker-autoclose" name="date_scheduled" type="text" class="form-control mydatepicker" placeholder="yyyy-mm-dd">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-calendar"></i></span>
									</div>
								</div>


								</div>


								<div class="invalid-feedback">




							</div>


						</div>











						<div class="row border-top border-secondary">
							<div class="col-3">
								<!-- Button back -->
								<div class="form-group">
									<div class="p-t-20">
										<a href="<?php echo base_url() ?>/visitas/">
											<button type="button" class="btn btn-cyan">
												Volver
											</button>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6">
							</div>
							<div class="col-3">
								<div class="form-group">
									<div class="p-t-20">
										<button class="btn btn-success float-right" type="submit">
											Confirmar
										</button>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
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



