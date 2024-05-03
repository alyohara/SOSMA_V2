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
				<h4 class="page-title">Usuarios</h4>
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
						<!-- New User Form -->
						<!-- ============================================================== -->
						<h5 class="title" id="exampleModalLabel">Alta Nuevo Usuario</h5>
						<div class="">

							<!-- Form -->
							<?php
							$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'newUserForm');
							echo form_open(base_url() . 'usersABM/usersAdd/', $attributes);
							?>

							<div class="row p-b-30">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-user"></i></span>
										</div>
										<?php echo form_input($username); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('username'); ?>
									</div>
								</div>

								<div class="col-md-1"></div>

								<div class="col-md-2">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-user"></i></span>
										</div>
										<?php echo form_input($name_title); ?>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-user"></i></span>
										</div>
										<?php echo form_input($name_first); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('name_first'); ?>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-user"></i></span>
										</div>
										<?php echo form_input($name_middle); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-user"></i></span>
										</div>
										<?php echo form_input($name_last); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('name_last'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-email"></i></span>
										</div>
										<?php echo form_input($email); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('email'); ?>
									</div>
								</div>


								<div class="col-md-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-key"></i></span>
										</div>
										<?php echo form_input($pass); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('pass'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-key"></i></span>
										</div>
										<?php echo form_input($passconf); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('passconf'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="mdi mdi-phone"></i></span>
										</div>
										<?php echo form_input($phone); ?>
									</div>
									<div class="invalid-feedback">
										<?php echo form_error('phone'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-alert"></i></span>
										</div>
										<?php echo form_dropdown('Roles', $role, '', $rolesExtra); ?>
									</div>
								</div>


							</div>
						</div>
						<div class="row border-top border-secondary">
							<div class="col-3">
								<!-- Button back -->
								<div class="form-group">
									<div class="p-t-20">
										<a href="<?php echo base_url()?>/usersABM/">
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
