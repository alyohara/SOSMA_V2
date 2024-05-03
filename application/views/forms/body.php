
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
					<?php if ($this->session->userdata('role') < 4){
						?>
						<!-- Button trigger modal -->
						<a href="<?php base_url()?>formAdd/">
							<button type="button" class="btn btn-success margin-5" >
								Alta Nuevo Formulario
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
								<th>Formulario</th>
								<th>QR</th>
								<th>Categoría</th>
								<th>Fecha de completado</th>
								<th>Tienda</th>
								<th>Responsable</th>

								<th>Acciones</th>
								<?php if ($this->session->userdata('role')<=2){
								?>
									<th>Estado</th>
								<th>Admin</th>
								<?php }
								?>
							</tr>
							</thead>
							<tbody>

							<?php foreach ($forms as $form):?>


									<td><?php echo $form->file_name;?></td>
									<td>

										<form action="<?php echo base_url();?>Qrcontroller/generar_qr" method="post">
											<input type="hidden" name="qrcode_text" value="<?php echo base_url().'assets/formsUploaded/'.$form->url;?>">
											<button>Generar</button>
										</form>
									</td>
								<td><?php

									echo($this->formsAux->getFormTypeById($form->form_type_id)['form_name']);
									?></td>
									<td><?php echo $form->date_completed;?></td>
									<td><?php
										$resp = "";
										$resp = $resp . "<a href=" . base_url() . "/storesABM/store/" . $form->id_sms . ">";

										$resp =$resp . "<i>Tienda: <b>";
										$resp =$resp .  $this->stores->getStoreById($form->id_sms)->name;
										$resp =$resp .  "</b> ";
											$resp = $resp . "</a>";




										echo $resp;
										?></td>
									<td><?php
										$resp = "";
										if ($this->session->userdata('role')<=2) {
											$resp = $resp . "<a href=" . base_url() . "/usersABM/user/" . $form->id_user_creator . ">";
										}
										$resp =$resp . "<i>Usuario: <b>";
										$resp =$resp .  $this->users->getUserById($form->id_user_creator)->username;
										$resp =$resp .  "</b> -- Nombre y Apellido: <b>";
										$resp =$resp .  $this->users->getUserById($form->id_user_creator)->name_first.' '.$this->users->getUserById($form->id_user_creator)->name_middle.' '.$this->users->getUserById($form->id_user_creator)->name_last.' </b></i>';
										if ($this->session->userdata('role')<=2) {
											$resp = $resp . "</a>";
										}



										echo $resp;
										?>
									</td>

									<td><a href="<?php echo base_url().'assets/formsUploaded/'.$form->url;?>"><button type="button" class="btn btn-cyan btn-sm"  style="width: 100%;">Ver / Descargar</button>
									</td>
									<?php if ($this->session->userdata('role')<=2){
									?>
										<td><?php echo $form->state;?></td>

									<td>


											<a href="<?php echo base_url().'forms/formChangeState/'.$form->id;?>"><button type="button" class="btn btn-success btn-sm" style="width: 100%;">Habilitar / Deshabilitar</button></a>

									</td>
									<?php }
									?>
								</tr>

							<?php endforeach;?>



							</tbody>
							<tfoot>
							<tr>
								<th>Formulario</th>
								<th>QR</th>
								<th>Categoría</th>
								<th>Fecha de completado</th>
								<th>Tienda</th>
								<th>Responsable</th>
								<th>Acciones</th>
								<?php if ($this->session->userdata('role')<=2){
									?>
									<th>Estado</th>
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

