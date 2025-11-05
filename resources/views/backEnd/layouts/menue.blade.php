@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset($layout_setting->logo_image??'back-end-assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Admin Panel</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		<li>
			<a href="{{route('admin.dashboard')}}">
				<div class="parent-icon"><i class='bx bx-home-alt'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.service')}}">
				<div class="parent-icon"><i class='bx bx-cube'></i>
				</div>
				<div class="menu-title">Service</div>
			</a>
		</li>


		<li>
			<a href="{{route('admin.slider')}}">
				<div class="parent-icon"><i class='bx bx-images'></i>
				</div>
				<div class="menu-title"> Slider</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.notification')}}">
				<div class="parent-icon"><i class='bx bx-bell'></i>
				</div>
				<div class="menu-title"> Achievement & Career</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.gallery')}}">
				<div class="parent-icon"><i class='bx bx-image'></i>
				</div>
				<div class="menu-title">Gallery</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.contact.all')}}">
				<div class="parent-icon"><i class='bx bx-message'></i>
				</div>
				<div class="menu-title"> Contact Question</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.client')}}">
				<div class="parent-icon"><i class='bx bx-user'></i>
				</div>
				<div class="menu-title"> Clients & Partners</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.project')}}">
				<div class="parent-icon"><i class='bx bx-box'></i>
				</div>
				<div class="menu-title"> Projects</div>
			</a>
		</li>

		<li class="menu-label">People</li>
		{{--
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='bx bx-group'></i>
				</div>
				<div class="menu-title">Student</div>
			</a>
			<ul>
				<li> <a href="{{route('admin.student.all')}}"><i class='bx bx-radio-circle'></i>All Students</a>
		</li>
		<li> <a href="{{route('admin.student.create')}}"><i class='bx bx-radio-circle'></i>Create Student</a>
		</li>
	</ul>
	</li>
	--}}
	<li>
		<a href="{{route('admin.team')}}">
			<div class="parent-icon"><i class='bx bx-user'></i>
			</div>
			<div class="menu-title">Team & Management</div>
		</a>
	</li>
	{{--  
	<li class="menu-label">Activities</li>
	<li>
		<a href="{{ route('admin.category') }}">
			<div class="parent-icon"><i class='bx bx-list-ul'></i></div>
			<div class="menu-title">Activities Category</div>
		</a>
	</li>
		<li class="menu-label">Order</li>
		<li>
			<a href="{{route('admin.order')}}">
	<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
	</div>
	<div class="menu-title">Order</div>
	</a>
	</li>
	--}}
	<li class="menu-label">Setting</li>
	<li>
		<a href="{{route('admin.landing_page')}}">
			<div class="parent-icon"><i class='bx bx-cog'></i>
			</div>
			<div class="menu-title">Home Layout</div>
		</a>
	</li>
	<li>
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}"
				onclick="event.preventDefault();
					this.closest('form').submit();">
				<div class="parent-icon"><i class="bx bx-log-out-circle fs-5"></i></div>
				<div class="menu-title">Logout</div>
			</a>
		</form>
	</li>

	</ul>
	<!--end navigation-->
</div>
<!--end sidebar wrapper -->
<!--start header -->
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand gap-3">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center gap-1">
					<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
						<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
						</a>
					</li>

					<li class="nav-item dark-mode d-none d-sm-flex">
						<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
						</a>
					</li>
					<!-- Hiddne  -->
					<div style="display:none">
						<li class="nav-item dropdown dropdown-app">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><i class='bx bx-grid-alt'></i></a>
							<div class="dropdown-menu dropdown-menu-end p-0">
								<div class="app-container p-2 my-2">
									<!--end row-->

								</div>
							</div>
						</li>
						<li class="nav-item dropdown dropdown-large">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
								<i class='bx bx-bell'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a href="javascript:;">
									<div class="msg-header">
										<p class="msg-header-title">Notifications</p>
										<p class="msg-header-badge">8 New</p>
									</div>
								</a>
								<div class="header-notifications-list">

								</div>
								<a href="javascript:;">
									<div class="text-center msg-footer">
										<button class="btn btn-primary w-100">View All Notifications</button>
									</div>
								</a>
							</div>
						</li>
						<li class="nav-item dropdown dropdown-large">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
								<i class='bx bx-shopping-bag'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a href="javascript:;">
									<div class="msg-header">
										<p class="msg-header-title">My Cart</p>
										<p class="msg-header-badge">10 Items</p>
									</div>
								</a>
								<div class="header-message-list">

								</div>
								<a href="javascript:;">
									<div class="text-center msg-footer">
										<div class="d-flex align-items-center justify-content-between mb-3">
											<h5 class="mb-0">Total</h5>
											<h5 class="mb-0 ms-auto">$489.00</h5>
										</div>
										<button class="btn btn-primary w-100">Checkout</button>
									</div>
								</a>
							</div>
						</li>

					</div>


				</ul>
			</div>
			<div class="user-box dropdown px-3">
				<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<div class="user-info">
						<p class="user-name mb-0">{{Auth::user()->name}}</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					{{--
					<li><a class="dropdown-item d-flex align-items-center" href="{{route('member.dashboard')}}"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
					</li>
					--}}
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li>
					<li>
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}"
								onclick="event.preventDefault();
					this.closest('form').submit();">
								<i class="bx bx-log-out-circle fs-5"></i><span>Logout</span>
							</a>
						</form>
					</li>


				</ul>
			</div>
		</nav>
	</div>
</header>
<!--end header -->