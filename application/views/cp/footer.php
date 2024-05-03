
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<button id="install-button" style="display: none; /* Hide the button by default */
      background-color: rgba(76,175,80,0.54);
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 10px;
	  position: absolute;
      top: 50px;
      right: 20px;
      ">Instalar</button>
<footer class="footer text-center">
	All Rights Reserved by SOSMA. Designed and Developed by <a href="https://www.sosma.com.ar">SOSMA</a>.
</footer>

<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url()?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url()?>dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url()?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url()?>dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="<?php echo base_url()?>assets/libs/flot/excanvas.js"></script>
<script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.js"></script>
<script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="<?php echo base_url()?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url()?>dist/js/pages/chart/chart-page-init.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
		$('#card-body').delay(3000).fadeOut();
	});
</script>
<script>
	let deferredPrompt;

	window.addEventListener('beforeinstallprompt', (event) => {
		// Prevent the default browser prompt
		event.preventDefault();
		// Stash the event so it can be triggered later
		deferredPrompt = event;
		// Optionally, display your own custom install button or alert
		// For example, display a button to trigger the installation
		showInstallButton();
	});

	function showInstallButton() {
		// Display a button or alert to prompt the user to install the app
		// For example:
		const installButton = document.getElementById('install-button');
		installButton.style.display = 'block';
		installButton.addEventListener('click', () => {
			// Trigger the installation prompt
			deferredPrompt.prompt();
			// Wait for the user to respond to the prompt
			deferredPrompt.userChoice.then((choiceResult) => {
				if (choiceResult.outcome === 'accepted') {
					console.log('User accepted the install prompt');
					// Optionally, track the installation
				} else {
					console.log('User dismissed the install prompt');
					// Optionally, handle the user's rejection
				}
				// Clear the deferredPrompt variable
				deferredPrompt = null;
			});
		});
	}

	if ('serviceWorker' in navigator) {
		window.addEventListener('load', () => {
			navigator.serviceWorker.register('assets/service-worker.js')
				.then(registration => {
					console.log('Service Worker registered:', registration);
				})
				.catch(error => {
					console.log('Service Worker registration failed:', error);
				});
		});
	}
</script>
</body>

</html>
