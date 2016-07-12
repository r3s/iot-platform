@if(Auth::user())
<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		{{-- <li class="ts-label">Search</li>
		<li>
			<input type="text" class="ts-sidebar-search" placeholder="Search here...">
		</li> --}}
		<li class="ts-label">Main</li>
		<li class="open"><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="#"><i class="fa fa-desktop"></i> My Devices</a>
			<ul>
				<li><a href="panels.html">Active Devices</a></li>
				<li><a href="buttons.html">Inactive Devices</a></li>
			</ul>
		</li>
		<li><a href="tables.html"><i class="fa fa-table"></i>Data</a></li>
		<li><a href="#"><i class="fa fa-cog"></i> Settings</a>
			<ul>
				<li><a href="blank.html">General</a></li>
				<li><a href="login.html">Account Settings</a></li>
			</ul>
		</li>

		<!-- Account from above -->
		<ul class="ts-profile-nav">
			<li><a href="#">Help</a></li>
			<li><a href="#">Settings</a></li>
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="#">My Account</a></li>
					<li><a href="#">Edit Account</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</li>
		</ul>

	</ul>
</nav>
@endif
