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
							<a href="<?php base_url() ?>visitasAdd/">
								<button type="button" class="btn btn-success margin-5">
									Alta Nueva Visita
								</button>
							</a>
						<?php } ?>


					</div>
				</div>
				<div class="card">

					<div class="card-body">
						<h5 class="card-title"></h5>
						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Visita</th>
									<th>Fecha Visita</th>
									<th>Fecha último movimiento</th>

									<?php if ($this->session->userdata('role') <= 2) {
										?>
										<th>Admin</th>
									<?php }
									?>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($visitas as $visit): ?>

									<tr>
										<td>
											<div class="d-flex no-block align-items-center m-t-25">
												<span><?php echo $visit->state ?></span>
												<div class="ml-auto">
													<span><?php
														$resp = "";
														if ($this->session->userdata('role') <= 2) {
															$resp = $resp . "<a href=" . base_url() . "/usersABM/user/" . $visit->id_user_creator . ">";
														}

														$resp = $resp . "</b>Asignada a: <b>";
														$resp = $resp . $this->users->getUserById($visit->id_user_creator)->name_first . ' ' . $this->users->getUserById($visit->id_user_creator)->name_middle . ' ' . $this->users->getUserById($visit->id_user_creator)->name_last . ' </b></i>';
														if ($this->session->userdata('role') <= 2) {
															$resp = $resp . "</a>";
														}
														echo $resp;
														?>
														</span>
												</div>
											</div>
											<div class="progress">
												<div class="progress-bar progress-bar-striped bg-success"
													 role="progressbar" style="width: <?php echo $visit->percentage ?>%"
													 aria-valuenow="25"
													 aria-valuemin="0" aria-valuemax="100"></div>
											</div>


										</td>
										<td><?php
											echo $visit->date_scheduled; ?></td>
										<td><?php
											echo $visit->date_last_move; ?></td>

										<?php if ($this->session->userdata('role') <= 2) {
											?>

											<td>
												<?php if (($visit->percentage > 10) &&($visit->percentage <= 100)){ ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/prev'; ?>"
												   style="margin: 2px; margin-left: 0px; padding: 2px; padding-left: 0px">
													<button type="button" class="btn btn-cyan btn-sm"
															style="width: 35px;">-
													</button>
												</a>
												<?php } ?>
												<?php if (($visit->percentage > 0) &&($visit->percentage < 100)){ ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/next'; ?>"
												   style="margin: 2px; padding: 2px">
													<button type="button" class="btn btn-success btn-sm"
															style="width: 35px;">+
													</button>
												</a>
												<?php } ?>
												<?php if ($visit->percentage != 0){ ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/del'; ?>"
												   style="margin: 2px; padding: 2px">
													<button type="button" class="btn btn-danger btn-sm"
													>Cancelar
													</button>
												</a>
												<?php } ?>
												<?php if ($visit->percentage == 0){ ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/act'; ?>"
												   style="margin: 2px; padding: 2px">
													<button type="button" class="btn btn-danger btn-sm"
													>Activar
													</button>
												</a>
												<?php } ?>
											</td>
											<?php
										}
										?>
									</tr>

								<?php endforeach; ?>


								</tbody>
								<tfoot>
								<tr>
									<th>Visita</th>
									<th>Fecha Visita</th>
									<th>Fecha último movimiento</th>

									<?php if ($this->session->userdata('role') <= 2) {
										?>
										<th>Admin</th>
									<?php }
									?>
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

