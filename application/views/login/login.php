<body>
<div class="main-wrapper">
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Login box.scss -->
	<!-- ============================================================== -->
	<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
		<div class="auth-box bg-dark border-top border-secondary">
			<div id="loginform">
				<?php if ($this->session->flashdata('error_msg')) {
					?>
					<div class="card-body" id="card-body">
						<!-- Comment Row -->
						<div class="d-flex flex-row comment-row m-t-0 ">
							<div class="btn btn-danger btn-sm" style="width: 100%"><?php
								echo $this->session->flashdata('error_msg'); ?></div>
						</div>
						<!-- Comment Row -->
					</div>
					<?php
				} ?>
				<div class="text-center p-t-20 p-b-20">



					<span class="db"><img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo" style:"widht: 233px" /></span>
				</div>
				<!-- Form -->
				<?php
				$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'loginform');
				echo form_open(base_url() . 'login/process/', $attributes);
				?>

				<div class="row p-b-30">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-success text-white" id="basic-addon1"><i
										class="ti-user"></i></span>
							</div>
							<?php echo form_input($username); ?>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-warning text-white" id="basic-addon2"><i
										class="ti-key"></i></span>
							</div>
							<?php echo form_input($pass); ?>
						</div>
					</div>
				</div>
				<div class="row border-top border-secondary">
					<div class="col-12">
						<div class="form-group">
							<div class="p-t-20">
								<button class="btn btn-info" id="to-recover" type="button"><i
										class="fa fa-lock m-r-5"></i> Lost password?
								</button>
								<button class="btn btn-success float-right" type="submit">Login</button>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
			<div id="recoverform">
				<div class="text-center">
					<span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
				</div>
				<div class="row m-t-20">
					<!-- Form -->
					<?php

					$attributes2 = array(
						'class' => 'col-12',
						'id' => 'recovform'
					);

					echo form_open(base_url() . 'login/recover/', $attributes2);
					?>
					<!-- email -->
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-danger text-white" id="basic-addon1"><i
									class="ti-email"></i></span>
						</div>
						<?php echo form_input($mailRecover); ?>
					</div>
					<!-- pwd -->
					<div class="row m-t-20 p-t-20 border-top border-secondary">
						<div class="col-12">
							<a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
							<button class="btn btn-info float-right" type="button" name="action">Recover</button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Login box.scss -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Page wrapper scss in scafholding.scss -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Page wrapper scss in scafholding.scss -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right Sidebar -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right Sidebar -->
	<!-- ============================================================== -->
</div>
<button id="install-button"class="buttonInstall">Instalar</button>
