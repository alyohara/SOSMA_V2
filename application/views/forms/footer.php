

<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
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
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo base_url()?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url()?>dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url()?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url()?>dist/js/custom.min.js"></script>
<!-- this page js -->
<script src="<?php echo base_url()?>assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?php echo base_url()?>assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?php echo base_url()?>assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url()?>dist/js/pages/mask/mask.init.js"></script>
<script src="<?php echo base_url()?>assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?php echo base_url()?>assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/quill/dist/quill.min.js"></script>
<script>
/****************************************
 *       Basic Table                   *
 ****************************************/
$('#zero_config').DataTable();
</script>
<script src="<?php echo base_url()?>assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/libs/select2/dist/js/select2.min.js"></script>
<script> $(".select2").select2();</script>
<script>function readURL(input) {
		if (input.files && input.files[0]) {

			var reader = new FileReader();

			reader.onload = function(e) {
				$('.image-upload-wrap').hide();

				$('.file-upload-image').attr('src', e.target.result);
				$('.file-upload-content').show();

				$('.image-title').html(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);

		} else {
			removeUpload();
		}
	}

	function removeUpload() {
		$('.file-upload-input').replaceWith($('.file-upload-input').clone());
		$('.file-upload-content').hide();
		$('.image-upload-wrap').show();
	}
	$('.image-upload-wrap').bind('dragover', function () {
		$('.image-upload-wrap').addClass('image-dropping');
	});
	$('.image-upload-wrap').bind('dragleave', function () {
		$('.image-upload-wrap').removeClass('image-dropping');
	});</script>
</body>




</html>
