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
				<h4 class="page-title">Tiendas de la Compañía: <b><?php echo $company->name ?></b></h4>
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
						<div class="table-responsive">
							<?php if (empty($stores)) { ?>
								<li class="d-flex no-block card-body border-top">
									<i class="m-r-10 mdi mdi-store"></i><h6>ESTA COMPAÑÍA NO TIENE TIENDAS
										ASOCIADAS</h6>

								</li>
							<?php } else { ?>
								<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Nombre</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Responsable</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($stores as $store): ?> <!--todo this for store-->
									<a href="#">
										<tr>
											<td><?php echo $store->name ?></td>
											<td><?php echo $store->address ?></td>
											<td><?php echo $store->phone ?></td>
											<td><?php echo $store->email ?></td>
											<td><?php echo $store->attendant_id ?></td>
										</tr>
									</a>
								<?php endforeach; ?>
								</tbody>
								<tfoot>
								<tr>
									<th>Nombre</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Responsable</th>
								</tr>
								</tfoot>
								</table><?php } ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<a href="<?php echo base_url() . "companiesABM/company/" . $company->id ?>"
								<button type="button" class="btn btn-cyan">
									Volver
								</button>
								</a>
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

		</div>
	</div>
</div>
