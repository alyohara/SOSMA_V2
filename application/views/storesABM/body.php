
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
				<h4 class="page-title">Tiendas</h4>
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
									<div class="btn btn-danger btn-sm" style="width: 100%"><?php
										echo $this->session->flashdata('success_msg'); ?></div>
								</div>
								<!-- Comment Row -->
							</div>
							<?php
						} ?>
						<?php if ($this->session->userdata('role') < 4){
						?>
						<!-- Button trigger modal -->
						<a href="<?php base_url()?>storesAdd/">
							<button type="button" class="btn btn-success margin-5" >
								Alta Nueva Tienda
							</button>
						</a>
<?php }?>


					</div>
				</div>
				<div class="card">

					<div class="card-body">
						<h5 class="card-title"></h5>
						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Nombre</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>email</th>
									<th>Acciones</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($stores as $store):?>
									<tr>

										<td><?php echo $store->name;?></td>
										<td><?php echo $store->address;?></td>
										<td><?php echo $store->phone;?></td>
										<td><?php echo $store->email;?></td>
										<td>
											<a href="<?php echo base_url().'storesABM/store/'.$store->id;?>"><button type="button" class="btn btn-cyan btn-sm">Ver</button>
											</a>
											<?php if ($this->session->userdata('role')<4){
											?>
											<a href="<?php echo base_url().'storesABM/storeMod/'.$store->id;?>"><button type="button" class="btn btn-success btn-sm">Modificar</button></a>
											<?php }
											?>
										</td>
									</tr>

								<?php endforeach;?>



								</tbody>
								<tfoot>
								<tr>
									<th>Nombre</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>email</th>
									<th>Acciones</th>
								</tr>
								</tfoot>
							</table>
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

