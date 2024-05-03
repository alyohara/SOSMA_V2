
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url()?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>

	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();
	// ==============================================================
	// Login and Recover Password
	// ==============================================================
	$('#to-recover').on("click", function() {
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){

		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
</script>
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
