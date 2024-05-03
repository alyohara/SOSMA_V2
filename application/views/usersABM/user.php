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
				<h4 class="page-title"></h4>
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

		<!-- ============================================================== -->
		<!-- User Data -->
		<!-- ============================================================== -->

		<div class="row">
			<!-- column -->
			<div class="col-lg-6">
				<?php if ($this->session->flashdata('msg')) {
					?>
					<div class="card">
						<div class="card-body" id="card-body">
							<!-- Comment Row -->
							<div class="d-flex flex-row comment-row m-t-0 ">
								<div class="btn btn-cyan btn-sm" style="width: 100%"><?php
									echo $this->session->flashdata('msg'); ?></div>
							</div>
							<!-- Comment Row -->
						</div>
					</div>
					<?php
				} ?>
				<?php if ($this->session->flashdata('success_msg')) {
					?>
					<div class="card">
						<div class="card-body" id="card-body">
							<!-- Comment Row -->
							<div class="d-flex flex-row comment-row m-t-0 ">
								<div class="btn btn-cyan btn-sm" style="width: 100%"><?php
									echo $this->session->flashdata('success_msg'); ?></div>
							</div>
							<!-- Comment Row -->
						</div>
					</div>
					<?php
				} ?>


				<div class="card">
					<div class="card-body">
						<span class="font-18"> <strong>Datos del Usuario:</strong></span>
						<span class="text-muted float-right"><?php $datestring = 'Año: %Y Mes: %m Día: %d - %h:%i %a';
							$time = now('America/Argentina/Buenos_Aires');
							echo mdate($datestring, $time); ?></span>
					</div>
					<div class="comment-widgets scrollable">
						<!-- Comment Row -->
						<div class="d-flex flex-row m-t-0 border-top">
							<div class="comment-text w-100">
								<h6 class="font-medium"><strong>Nombre de Usuario:</strong></h6>
								<span class="m-b-15 d-block "><?php echo $user->username ?></span>
							</div>
						</div>
						<!-- Comment Row -->
						<div class="d-flex flex-row  m-t-0 border-top">
							<div class="comment-text w-100">
								<h6 class="font-medium "><strong>Nombre y Apellido:</strong></h6>
								<span
										class="m-b-15 d-block"><?php echo($user->name_title . ' ' . $user->name_first . ' ' . $user->name_middle . ' ' . $user->name_last) ?> </span>
							</div>
						</div>
						<!-- Comment Row -->
						<div class="d-flex flex-row  m-t-0 border-top">
							<div class="comment-text w-100">
								<h6 class="font-medium"><strong>Correo Electrónico:</strong></h6>
								<span class="m-b-15 d-block"><?php echo $user->email ?></span>
							</div>
						</div>
						<!-- Comment Row -->
						<div class="d-flex flex-row  m-t-0 border-top">
							<div class="comment-text w-100">
								<h6 class="font-medium"><strong>Rol del Usuario:</strong></h6>
								<span class="m-b-15 d-block"><?php
									switch ($user->id_user_roles) {
										case '1' :
											echo 'Superadmin';
											break;
										case '2' :
											echo 'Admin';
											break;
										case '3' :
											echo 'Supervisor';
											break;
										case '4' :
											echo 'Técnico';
											break;
										case '5' :
											echo 'Cliente';
											break;
										case '6' :
											echo 'Full';
											break;
										default:
											echo 'No tiene Rol asigando';
									}

									?></span>

							</div>
						</div>
						<!-- Comment Row -->
						<div class="d-flex flex-row  m-t-0 border-top">
							<div class="comment-text w-100">
								<h6 class="font-medium"><strong>Status del Usuario:</strong></h6>
								<span class="m-b-15 d-block"><?php
									switch ($user->id_user_status) {
										case '1' :
											echo 'Nuevo';
											break;
										case '2' :
											echo 'Registrado';
											break;
										case '3' :

											echo 'Activo';
											break;
										case '4' :
											echo 'Suspendido';
											break;
										case '5' :
											echo 'Desactivado';
											break;
										case '6' :
											echo 'Eliminado';
											break;
										default:
											echo 'No tiene Status asigando';
									}
									?></span>
							</div>
						</div>
					</div>
					<!-- button -->
					<?php if ($this->session->userdata('role') <= 4) { ?>
						<div class="card" style="margin-bottom: -20px">
							<a href="<?php echo base_url() . 'usersABM/userMod/' . $user->id ?>"
							<button type="button" class="btn btn-success">
								Modificar
							</button>
							</a>
						</div>
					<?php } ?>
				</div>
				<?php if (($this->session->role == '2') || ($this->session->role == '1')) {
					?>
					<script type="text/javascript">

						function checkPass() {
							//Store the password field objects into variables ...
							var pass = document.getElementById('pass');
							var passconf = document.getElementById('passconf');
							var message = document.getElementById('confirm-message2');
							//Set the colors we will be using ...

							//Compare the values in the password field
							//and the confirmation field
							if (pass.value == passconf.value) {
								//The passwords match.
								//Set the color to the good color and inform
								//the user that they have entered the correct password
								passconf.classList.add('is-valid');
								passconf.classList.remove('is-invalid');
								message.innerHTML = ''

							} else {
								//The passwords do not match.
								//Set the color to the bad color and
								//notify the user.
								passconf.classList.add('is-invalid');
								passconf.classList.remove('is-valid');
								message.innerHTML = 'No coinciden las contraseñas';

							}
						}

						function checkOn() {
							var pass = document.getElementById('pass');
							var passconf = document.getElementById('passconf');
							if (pass.value == passconf.value) {
								return true;
							} else {
								return false;
							}

						}
					</script>

					<div class="card" style="margin-top: 40px;">
						<div class="card-body">
							<h5>Cambiar contraseña</h5>


							<form method="post" action="<?php echo base_url() ?>usersABM/userChangePass/"
								  onsubmit="return checkOn()">

								<button type="button" class="btn btn-success margin-5 text-white float-right"
										data-toggle="modal" data-target="#Modal2">
									Cambiar Contraseña
								</button>

								<!-- Modal -->
								<div class="modal fade" id="Modal2" tabindex="-1" role="dialog"
									 aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">¡Cuidado!</h5>
												<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p>Está a punto de cambiar la contraseña de
													<strong> <?php echo $user->username ?></strong>; una vez hecho esto,
													ya no se pdorá ingresar con la contraseña anterior.</p>
												<p><?php echo form_input($pass); ?></p>
												<p><?php echo form_input($passconf); ?><span id="confirm-message2"
																							 class="invalid-feedback"></span>
												</p>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-secondary"
														data-dismiss="modal">
													Cerrar
												</button>
												<input type="hidden" name="user_id_change_pass" id="user_id_change_pass"
													   value="<?php echo $user->id ?>">


												<button type="submit" class="btn btn-success float-right">
													Cambiar contraseña
												</button>
											</div>
										</div>
									</div>
								</div>


							</form>
							<p>Pueder hacer click en el siguiente botón para modificar la contraseña de usuario.</p>
						</div>
					</div>

					<?php

				} ?>
				<?php
				$i = 0;
				if ($companies) {

					?>
					<div class="card">
						<div class="card-body">
							<h4 class="card-title m-b-0">Compañías a su cargo</h4>
						</div>
						<ul class="list-style-none">

							<?php foreach ($companies as $comp):
								$i++;
							?>

								<li class="d-flex no-block card-body border-top">

									<a href="<?php echo base_url() . 'companiesABM/company/' . $comp->id ?>"
									<button type="button" class="btn btn-light" style="width: 100%">
										Ver <?php echo $comp->name ?>
									</button>
									</a>

								</li>


							<?php if ($i == 3){
								break;
							}
							endforeach; ?>


						</ul>
						<a href="<?php echo base_url() . 'companiesABM/' ?>"
						<button type="button" class="btn btn-success">
							Ver Compañias
						</button>
						</a>

					</div>
				<?php } ?>

			</div>

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

					<a href="<?php echo base_url() . 'usersABM/userHistory/' . $user->id ?>"
					<button type="button" class="btn btn-success">
						Ver Histórico
					</button>
					</a>
				</div>

				<?php if ($stores) {
					$i=0;
					?>
					<div class="card">
						<div class="card-body">
							<h4 class="card-title m-b-0">Tiendas a su cargo</h4>
						</div>
						<ul class="list-style-none">

							<?php foreach ($stores as $store):
								$i++;
							?>

								<li class="d-flex no-block card-body border-top">

									<a href="<?php echo base_url() . 'storesABM/store/' . $store->id ?>"
									<button type="button" class="btn btn-outline-primary" style="width: 100%">
										Ver Tienda <?php echo $store->name ?>
									</button>
									</a>

								</li>


							<?php
								if ($i == 3){
									break;
								}
								endforeach; ?>


						</ul>
						<a href="<?php echo base_url() . 'storesABM/' ?>"
						<button type="button" class="btn btn-success">
							Ver Tiendas
						</button>
						</a>


					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<!-- column -->
			<div class="col-12">
				<div class="card" style="padding-left: 10px; padding-right: 10px; margin-top: 10px">
					<!-- Button back -->
					<div class="form-group">
						<div class="p-t-20">
							<form method="post" action="<?php echo base_url() ?>usersABM/userDel/">
								<?php if ($this->session->userdata('role') > 4){
								?> <a href="<?php echo base_url() ?>">
									<?php }else { ?>
									<a href="<?php echo base_url() ?>usersABM/">

										<?php } ?>
										<button type="button" class="btn btn-cyan">
											Volver
										</button>
									</a>
									<?php if ($this->session->userdata('role') <= 4){
									if ($user->id_user_status != '6') {

										?>
										<button type="button" class="btn btn-danger margin-5 text-white float-right"
												data-toggle="modal" data-target="#Modal2">
											Eliminar al usuario
										</button>

										<!-- Modal -->
										<div class="modal fade" id="Modal2" tabindex="-1" role="dialog"
											 aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">¡Cuidado!</h5>
														<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														Está a punto de eliminar a un usuario, esto hará que no pueda
														ingresar y
														todo lo asociado a él quedará cerrado.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
																data-dismiss="modal">
															Cerrar
														</button>
														<input type="hidden" name="user_id_del" id="user_id_del"
															   value="<?php echo $user->id ?>">

														<button type="submit" class="btn btn-danger float-right">
															Eliminar al
															Usuario
														</button>
													</div>
												</div>
											</div>
										</div>

										<?php
									} else {
									?>
									<button type="button" class="btn btn-success margin-5 text-white float-right"
											data-toggle="modal" data-target="#Modal2">
										Reactivar al usuario
									</button>
							</form>
							<form method="post" action="<?php echo base_url() ?>usersABM/userAct/">
								<!-- Modal -->
								<div class="modal fade" id="Modal2" tabindex="-1" role="dialog"
									 aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">¡Cuidado!</h5>
												<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Está a punto de reactivar a un usuario. ¿Está seguro?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary"
														data-dismiss="modal">
													Cerrar
												</button>
												<input type="hidden" name="user_id_ac" id="user_id_ac"
													   value="<?php echo $user->id ?>">

												<button type="submit" class="btn btn-success float-right">
													Reactivar al
													Usuario
												</button>
											</div>
										</div>
									</div>
								</div>

								<?php

								}
								} ?>
							</form>


						</div>
					</div>

				</div>

			</div>
		</div>
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

