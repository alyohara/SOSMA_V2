<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item <?php if ($breadCrum == 'dashboard') {
					echo 'selected';
				}; ?>"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>cp/"
						  aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
								class="hide-menu">Dashboard</span></a></li>
				<!--				<li class="sidebar-item -->
				<?php //if ($breadCrum=='usersABM') {echo 'selected';};?><!--"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="-->
				<?php //echo base_url()?><!--usersABM/" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Usuarios</span></a></li>-->

				<?php if ($this->session->role < 4) {
					?>
					<li class="sidebar-item <?php if ($breadCrum == 'usersABM') {
						echo 'selected';
					}; ?>"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
							  aria-expanded="<?php if ($breadCrum == 'usersABM') {
								  echo 'true';
							  } else {
								  echo 'false';
							  } ?>"><i class="mdi mdi-receipt"></i><span class="<?php if ($breadCrum == 'usersABM') {
								echo 'show-menu';
							} else {
								echo 'hide-menu';
							} ?>">Usuarios </span></a>
						<ul aria-expanded="false" class="collapse  first-level <?php if ($breadCrum == 'usersABM') {
							echo 'in';
						}; ?>">
							<li class="sidebar-item <?php if (isset($breadCrum2)) {
								if ($breadCrum2 == 'usersABM') {
									echo 'active';
								}
							}; ?>"><a href="<?php echo base_url() ?>usersABM/" class="sidebar-link"><i
											class="mdi mdi-note-outline"></i><span
											class="hide-menu"> Ver Usuarios </span></a></li>
							<li class="sidebar-item <?php if (isset($breadCrum2)) {
								if ($breadCrum2 == 'usersABM/userAdd') {
									echo 'active';
								}
							}; ?>"><a href="<?php echo base_url() ?>usersABM/usersAdd" class="sidebar-link"><i
											class="mdi mdi-note-plus"></i><span
											class="hide-menu"> Agregar Usuario </span></a></li>
						</ul>
					</li>

					<?php
				} ?>

				<!--				<li class="sidebar-item -->
				<?php //if ($breadCrum=='contactsABM') {echo 'selected';};?><!--"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Contactos</span></a></li>-->

				<li class="sidebar-item <?php if ($breadCrum == 'companiesABM') {
					echo 'selected';
				}; ?>"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
						  aria-expanded="<?php if ($breadCrum == 'companiesABM') {
							  echo 'true';
						  } else {
							  echo 'false';
						  } ?>"><i class="mdi mdi-city"></i><span class="<?php if ($breadCrum == 'companiesABM') {
							echo 'show-menu';
						} else {
							echo 'hide-menu';
						} ?>">Compañías </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php if ($breadCrum == 'companiesABM') {
						echo 'in';
					}; ?>">
						<li class="sidebar-item <?php if (isset($breadCrum2)) {
							if ($breadCrum2 == 'companiesABM') {
								echo 'active';
							}
						}; ?>"><a href="<?php echo base_url() ?>companiesABM/" class="sidebar-link"><i
										class="mdi mdi-note-outline"></i><span class="hide-menu"> Ver Compañías </span></a>
						</li>
						<?php if ($this->session->role < 4) {
						?>
						<li class="sidebar-item <?php if (isset($breadCrum2)) {
							if ($breadCrum2 == 'companiesABM/companiesAdd') {
								echo 'active';
							}
						}; ?>"><a href="<?php echo base_url() ?>companiesABM/companiesAdd" class="sidebar-link"><i
										class="mdi mdi-note-plus"></i><span class="hide-menu"> Agregar Compañía </span></a>
						</li>


						<?php if ($this->session->role < 4) {
							?>
							<li class="sidebar-item <?php if (isset($breadCrum2)) {
								if ($breadCrum2 == 'companiesABM/companiesReferral') {
									echo 'active';
								}
							}; ?>"><a href="<?php echo base_url() ?>companiesABM/companiesReferral"
									  class="sidebar-link"><i
											class="mdi mdi-note-outline"></i><span
											class="hide-menu"> Agregar Asociación </span></a>
							</li>
						<?php } ?>
					</ul>
				</li>
				<li class="sidebar-item <?php if ($breadCrum == 'storesABM') {
					echo 'selected';
				}; ?>"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
						  aria-expanded="<?php if ($breadCrum == 'storesABM') {
							  echo 'true';
						  } else {
							  echo 'false';
						  } ?>"><i class="mdi mdi-store"></i><span class="<?php if ($breadCrum == 'storesABM') {
							echo 'show-menu';
						} else {
							echo 'hide-menu';
						} ?>">Tiendas </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php if ($breadCrum == 'storesABM') {
						echo 'in';
					}; ?>">
						<li class="sidebar-item <?php if (isset($breadCrum2)) {
							if ($breadCrum2 == 'storesABM') {
								echo 'active';
							}
						}; ?>"><a href="<?php echo base_url() ?>storesABM/" class="sidebar-link"><i
										class="mdi mdi-note-outline"></i><span
										class="hide-menu"> Ver Tiendas </span></a></li>
						<?php if ($this->session->role < 4) {
							?>
							<li class="sidebar-item <?php if (isset($breadCrum2)) {
								if ($breadCrum2 == 'storesABM/storesAdd') {
									echo 'active';
								}
							}; ?>"><a href="<?php echo base_url() ?>storesABM/storesAdd" class="sidebar-link"><i
											class="mdi mdi-note-plus"></i><span
											class="hide-menu"> Agregar Tienda </span></a></li>
						<?php } ?>
					</ul>
				</li>

				<li class="sidebar-item <?php if ($breadCrum == 'forms') {
					echo 'selected';
				}; ?>"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
						  aria-expanded="<?php if ($breadCrum == 'forms') {
							  echo 'true';
						  } else {
							  echo 'false';
						  } ?>"><i class="mdi mdi-receipt"></i><span class="<?php if ($breadCrum == 'forms') {
							echo 'show-menu';
						} else {
							echo 'hide-menu';
						} ?>">Formularios </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php if ($breadCrum == 'forms') {
						echo 'in';
					}; ?>">
						<li class="sidebar-item <?php if (isset($breadCrum2)) {
							if ($breadCrum2 == 'forms') {
								echo 'active';
							}
						}; ?>"><a href="<?php echo base_url() ?>forms/" class="sidebar-link"><i
										class="mdi mdi-note-outline"></i><span
										class="hide-menu"> Ver Formularios </span></a></li>
						<?php if ($this->session->role < 4) {
							?>
							<li class="sidebar-item <?php if (isset($breadCrum2)) {
								if ($breadCrum2 == 'forms/formAdd') {
									echo 'active';
								}
							}; ?>"><a href="<?php echo base_url() ?>forms/formAdd" class="sidebar-link"><i
											class="mdi mdi-note-plus"></i><span
											class="hide-menu"> Cargar Formulario </span></a></li>
						<?php } ?>
					</ul>
				</li>
				<li class="sidebar-item <?php if ($breadCrum == 'visitas') {
					echo 'selected';
				}; ?>"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
						  aria-expanded="<?php if ($breadCrum == 'visitas') {
							  echo 'true';
						  } else {
							  echo 'false';
						  } ?>"><i class="mdi mdi-car"></i><span class="<?php if ($breadCrum == 'visitas') {
							echo 'show-menu';
						} else {
							echo 'hide-menu';
						} ?>">Visitas </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php if ($breadCrum == 'visitas') {
						echo 'in';
					}; ?>">
						<li class="sidebar-item <?php if (isset($breadCrum2)) {
							if ($breadCrum2 == 'visitas') {
								echo 'active';
							}
						}; ?>"><a href="<?php echo base_url() ?>visitas/" class="sidebar-link"><i
										class="mdi mdi-note-outline"></i><span
										class="hide-menu"> Ver Visitas </span></a></li>
						<?php if ($this->session->role < 4) {
							?>
							<li class="sidebar-item <?php if (isset($breadCrum2)) {
								if ($breadCrum2 == 'visitas/visitsAdd') {
									echo 'active';
								}
							}; ?>"><a href="<?php echo base_url() ?>visitas/visitasAdd" class="sidebar-link"><i
											class="mdi mdi-note-plus"></i><span
											class="hide-menu"> Cargar Visita </span></a></li>
						<?php } ?>
					</ul>
				</li>
				<!--				<li class="sidebar-item --><?php //if ($breadCrum == 'forms') {
				//					echo 'selected';
				//				}; ?><!--"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html"-->
				<!--						  aria-expanded="false"><i class="mdi mdi-receipt"></i><span-->
				<!--								class="hide-menu">Formularios</span></a></li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts</span></a></li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Widgets</span></a></li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Tables</span></a></li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>-->

				<!--				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>-->
				<!--					<ul aria-expanded="false" class="collapse  first-level">-->
				<!--						<li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>-->
				<!--					</ul>-->
				<!--				</li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>-->
				<!--					<ul aria-expanded="false" class="collapse  first-level">-->
				<!--						<li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>-->
				<!--					</ul>-->
				<!--				</li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>-->
				<!--					<ul aria-expanded="false" class="collapse  first-level">-->
				<!--						<li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>-->
				<!--					</ul>-->
				<!--				</li>-->
				<!--				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>-->
				<!--					<ul aria-expanded="false" class="collapse  first-level">-->
				<!--						<li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>-->
				<!--						<li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>-->
				<!--					</ul>-->
				<!--				</li>-->
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->