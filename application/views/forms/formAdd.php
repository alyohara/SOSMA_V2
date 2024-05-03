
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
						<?php echo form_open_multipart('upload/do_upload');?>
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Carga Nuevo Formulario</h5>
								<div class="form-group row">
									<label class="col-md-2 m-t-15">Tienda</label>
									<div class="col-md-10">
										<?php echo form_dropdown($id_stores['name'], $id_stores['options'], $id_stores['selected'], $id_stores['extra']); ?>
									</div>


								</div>
								<div class="form-group row">
									<label class="col-md-2 m-t-15">Categoría Formulario</label>
									<div class="col-md-10">
										<?php echo form_dropdown($id_forms_types['name'], $id_forms_types['options'], $id_forms_types['selected'], $id_forms_types['extra']); ?>
									</div>


								</div>
								<div class="invalid-feedback">
									<?php echo form_error('id_referral'); ?>
								</div>
								<div class="form-group row">
									<label class="col-md-2 m-t-15">Nombre del Formulario</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="file_name" id="file_name" required="" style="width: 100%;">

									</div>


								</div>
								<div class="invalid-feedback">

								</div>
								<div class="file-upload">
									<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Elija un Formulario</button>

									<div class="image-upload-wrap">
										<input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="userfile"  required/>
										<div class="drag-text">
											<h3>Arrastre y suelte un formulario o elija uno de su equipo.</h3>
										</div>
									</div>
									<div class="file-upload-content">
										<img class="file-upload-image" src="#" alt="your image" />
										<div class="image-title-wrap">
											<button type="button" onclick="removeUpload()" class="remove-image">Elimine <span class="image-title">Uploaded Image</span></button>
										</div>
									</div>
								</div>


							</div>

						</div>











						<div class="row border-top border-secondary">
							<div class="col-3">
								<!-- Button back -->
								<div class="form-group">
									<div class="p-t-20">
										<a href="<?php echo base_url() ?>/forms/">
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



