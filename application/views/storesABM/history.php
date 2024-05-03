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
				<h4 class="page-title">Historia de la Tienda: <b><?php echo $store->name ?></b></h4>
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
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Usuario Origen</th>
									<th>Tema</th>
									<th>Fecha</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($history as $case): ?>
									<tr>
										<td>
											<?php if ($case->by_user_id == $this->session->user_id) {
												?>Usted<?php
											}else{
												$op = $this->users->getUserById($case->by_user_id);
												echo $op->username;
											}?>
										</td>
										<td><?php echo $case->data; ?></td>
										<td><?php echo date('d/m/Y H:m', strtotime($case->date)); ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot>
								<tr>
									<th>Usuario Origen</th>
									<th>Tema</th>
									<th>Fecha</th>
								</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<a href="<?php echo base_url() . "storesABM/store/" . $store->id ?>"
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
