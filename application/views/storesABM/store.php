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
			<?php if ($this->session->role < 4) {
			?>
			<div class="col-lg-6">
				<?php } else{
				?>
				<div class="col-lg-12">
					<?php
					} ?>

					<!-- ============================================================== -->
					<!-- Messages -->
					<!-- ============================================================== -->
					<?php if ($this->session->flashdata('success_msg')) {
						?>
						<div class="card">
							<div class="card-body" id="card-body">
								<!-- Comment Row -->
								<div class="d-flex flex-row comment-row m-t-0 ">
									<div class="btn btn-success btn-sm" style="width: 100%"><?php
										echo $this->session->flashdata('success_msg'); ?></div>
								</div>
								<!-- Comment Row -->
							</div>
						</div>
						<?php
					} ?>
					<?php if ($this->session->flashdata('msg')) {
						?>
						<div class="card">
							<div class="card-body" id="card-body">
								<!-- Comment Row -->
								<div class="d-flex flex-row comment-row m-t-0 ">
									<div class="btn btn-cyan btn-sm" style="width: 100%">
										<?php echo $this->session->flashdata('success_msg'); ?>
									</div>
								</div>
								<!-- Comment Row -->
							</div>
						</div>
						<?php
					} ?>

					<!-- ============================================================== -->
					<!--  Company Data -->
					<!-- ============================================================== -->
					<div class="card">
						<div class="card-body">
							<span class="font-18"> <strong>Datos de la Tienda:</strong></span>
							<span class="text-muted float-right"><?php $datestring = 'Año: %Y Mes: %m Día: %d - %h:%i %a';
								$time = now('America/Argentina/Buenos_Aires');
								echo mdate($datestring, $time); ?></span>
						</div>
						<div class="comment-widgets scrollable">
							<!-- Comment Row -->
							<div class="d-flex flex-row m-t-0 border-top">
								<div class="comment-text w-100">
									<h6 class="font-medium"><strong>Nombre de la Tienda:</strong></h6>
									<span class="m-b-15 d-block "><?php echo $store->name ?></span>
								</div>
							</div>
							<!-- Comment Row -->
							<div class="d-flex flex-row  m-t-0 border-top">
								<div class="comment-text w-100">
									<h6 class="font-medium "><strong>Dirección:</strong></h6>
									<span
											class="m-b-15 d-block"><?php echo $store->address ?> </span>
								</div>
							</div>
							<!-- Comment Row -->
							<div class="d-flex flex-row  m-t-0 border-top">
								<div class="comment-text w-100">
									<h6 class="font-medium"><strong>Teléfono:</strong></h6>
									<span class="m-b-15 d-block"><?php echo $store->phone ?></span>
								</div>
							</div>
							<!-- Comment Row -->
							<div class="d-flex flex-row  m-t-0 border-top">
								<div class="comment-text w-100">
									<h6 class="font-medium"><strong>Email:</strong></h6>
									<span class="m-b-15 d-block"><?php echo $store->email ?></span>
								</div>
							</div>
							<!-- Comment Row -->
							<div class="d-flex flex-row  m-t-0 border-top">
								<div class="comment-text w-100">
									<h6 class="font-medium"><strong>Responsable:</strong></h6>
									<a href="<?php echo base_url() ?>/usersABM/user/<?php echo($attendant->id) ?>">
										<span class="m-b-15 d-block"><b><?php echo($attendant->username) ?>: </b><?php echo($attendant->name_first . ' ' . $attendant->name_last) ?></span>
									</a>
								</div>
							</div>
							<!-- Comment Row -->
							<div class="d-flex flex-row  m-t-0 border-top">
								<div class="comment-text w-100">
									<h6 class="font-medium"><strong>Compañía:</strong></h6>
									<a href="<?php echo base_url() ?>/companiesABM/company/<?php echo($company->id) ?>">
										<span class="m-b-15 d-block"><b><?php echo($company->name) ?></b></span>
									</a>
								</div>
							</div>
						</div>
						<!-- button -->
						<?php if ($this->session->userdata('role') < 4) {
							?>
							<div class="card" style="margin-bottom: -20px">
								<a href="<?php echo base_url() . 'storesABM/storeMod/' . $store->id ?>"
								<button type="button" class="btn btn-success">
									Modificar
								</button>
								</a>
							</div>
						<?php }
						?>
					</div>
				</div>

				<?php if ($this->session->role < 4) {
					?>


					<!-- column -->
					<div class="col-lg-6">
						<!-- Card -->
						<div class="card">
							<div class="card-body">
								<h4 class="card-title m-b-0">Histórico</h4>
							</div>
							<ul class="list-style-none">

								<?php foreach ($history as $case): ?>

									<li class="d-flex no-block card-body border-top">
										<i class="fa fa-clock w-30px m-t-5"></i>
										<div>
											<a class="m-b-0 font-medium p-0"><?php echo $case->data; ?></a>
											<?php if ($case->by_user_id == $this->session->user_id) {
												?>
												<span class="text-muted">por usted, <strong><?php echo $this->session->username; ?></strong>
									</span>

											<?php } else { ?>
												<span class="text-muted">por el usuario:
										<strong><?php $op = $this->users->getUserById($case->by_user_id);
											echo $op->username; ?></strong>
									</span>
											<?php } ?>


										</div>
										<div class="ml-auto">
											<div class="tetx-right" style="padding-left: 5px">
												<h5 class="text-muted m-b-0"><?php echo date('d/m/Y', strtotime($case->date)); ?></h5>
												<span
														class="text-muted font-16"><?php echo date('H:m', strtotime($case->date)); ?></span>
											</div>
										</div>
									</li>


								<?php endforeach; ?>


							</ul>

							<a href="<?php echo base_url() . 'storesABM/storeHistory/' . $store->id ?>"
							<button type="button" class="btn btn-success">
								Ver Histórico
							</button>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="row" style="margin-top: 10px">
				<div class="col-lg-12">
					<!-- Card -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title m-b-0">Visitas</h4>
						</div>
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

							<?php foreach ($visitas as $visit):

								?>

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
											<?php if (($visit->percentage > 10) && ($visit->percentage <= 100)) { ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/prev'; ?>"
												   style="margin: 2px; margin-left: 0px; padding: 2px; padding-left: 0px">
													<button type="button" class="btn btn-cyan btn-sm"
															style="width: 35px;">-
													</button>
												</a>
											<?php } ?>
											<?php if (($visit->percentage > 0) && ($visit->percentage < 100)) { ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/next'; ?>"
												   style="margin: 2px; padding: 2px">
													<button type="button" class="btn btn-success btn-sm"
															style="width: 35px;">+
													</button>
												</a>
											<?php } ?>
											<?php if ($visit->percentage != 0) { ?>
												<a href="<?php echo base_url() . 'visitas/visitChangeState/' . $visit->id . '/del'; ?>"
												   style="margin: 2px; padding: 2px">
													<button type="button" class="btn btn-danger btn-sm"
													>Cancelar
													</button>
												</a>
											<?php } ?>
											<?php if ($visit->percentage == 0) { ?>
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

							<?php

							endforeach; ?>


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

						<a href="<?php echo base_url() . 'visitas/' ?>"
						<button type="button" class="btn btn-success">
							Ver Visitas
						</button>
						</a>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px">
				<div class="col-lg-12">
					<!-- Card -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title m-b-0">Formularios</h4>
						</div>
						<ul class="list-style-none">
							<?php if (empty($forms)) { ?>
								<li class="d-flex no-block card-body border-top">
									<i class="m-r-10 mdi mdi-store"></i><h6>ESTA COMPAÑÍA NO TIENE FORMULARIOS
										ASOCIADOS</h6>

								</li>
							<?php } ?>
							<div class="table-responsive	">
								<table id="zeroA_config" class="table table-striped table-bordered">
									<thead>
									<tr>
										<th>Formulario</th>
										<th>Fecha de completado</th>
										<th>Tienda</th>
										<th>Responsable</th>

										<th>Acciones</th>
										<?php if ($this->session->userdata('role') <= 2) {
											?>
											<th>Estado</th>
											<th>Admin</th>
										<?php }
										?>
									</tr>
									</thead>
									<tbody>

									<?php foreach ($forms as $form): ?>

										<tr>
											<td><?php echo $form->file_name; ?></td>
											<td><?php echo $form->date_completed; ?></td>
											<td><?php
												$resp = "";
												$resp = $resp . "<a href=" . base_url() . "/storesABM/store/" . $form->id_sms . ">";

												$resp = $resp . "<i>Tienda: <b>";
												$resp = $resp . $this->stores->getStoreById($form->id_sms)->name;
												$resp = $resp . "</b> ";
												$resp = $resp . "</a>";


												echo $resp;
												?></td>
											<td><?php
												$resp = "";
												if ($this->session->userdata('role') <= 2) {
													$resp = $resp . "<a href=" . base_url() . "/usersABM/user/" . $form->id_user_creator . ">";
												}
												$resp = $resp . "<i>Usuario: <b>";
												$resp = $resp . $this->users->getUserById($form->id_user_creator)->username;
												$resp = $resp . "</b> -- Nombre y Apellido: <b>";
												$resp = $resp . $this->users->getUserById($form->id_user_creator)->name_first . ' ' . $this->users->getUserById($form->id_user_creator)->name_middle . ' ' . $this->users->getUserById($form->id_user_creator)->name_last . ' </b></i>';
												if ($this->session->userdata('role') <= 2) {
													$resp = $resp . "</a>";
												}


												echo $resp;
												?>
											</td>

											<td>
												<a href="<?php echo base_url() . 'assets/formsUploaded/' . $form->url; ?>">
													<button type="button" class="btn btn-cyan btn-sm"
															style="width: 100%;">Ver / Descargar
													</button>
											</td>
											<?php if ($this->session->userdata('role') <= 2) {
												?>
												<td><?php echo $form->state; ?></td>

												<td>


													<a href="<?php echo base_url() . 'forms/formChangeState/' . $form->id; ?>">
														<button type="button" class="btn btn-success btn-sm"
																style="width: 100%;">Habilitar / Deshabilitar
														</button>
													</a>

												</td>
											<?php }
											?>
										</tr>

									<?php endforeach; ?>


									</tbody>
									<tfoot>
									<tr>
										<th>Formulario</th>
										<th>Fecha de completado</th>
										<th>Tienda</th>
										<th>Responsable</th>
										<th>Acciones</th>
										<?php if ($this->session->userdata('role') <= 2) {
											?>
											<th>Estado</th>
											<th>Admin</th>
										<?php }
										?>
									</tr>
									</tfoot>
								</table>
							</div>


						</ul>

						<a href="<?php echo base_url() . 'forms/' ?>"
						<button type="button" class="btn btn-success">
							Ver Formularios
						</button>
						</a>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-12">
					<!-- Button back -->
					<div class="card">
						<div class="card-body">
							<a href="<?php echo base_url() ?>/stores	ABM/">
								<button type="button" class="btn btn-cyan">
									Volver
								</button>
							</a>
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



