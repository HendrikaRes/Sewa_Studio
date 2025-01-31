<header class="header-section clearfix">
    <a href="index.html" class="site-logo">
        <img src="img/logo.png" alt="">
    </a>
    <div class="header-right">
        <div class="user-panel">
            @auth
                <!-- Jika sudah login, tampilkan nama pengguna dan tombol logout di sampingnya -->
                <span>Welcome, {{ Auth::user()->name }}</span>
				<span>|</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-form">
				@csrf
				<button type="button" class="logout-btn" onclick="confirmLogout()">
					<i class="bi bi-box-arrow-in-right"></i> Logout
				</button>
			</form>
            @else
                <!-- Jika belum login, tampilkan link login dan register -->
                <a href="/login" class="login">Login</a>
                <span>|</span>
                <a href="/register" class="register">Create an account</a>
            @endauth
        </div>
    </div>

    <ul class="main-menu">
        <li><a href="/">Home</a></li>
        @if (Request::is('/')) 
        <li><a href="#about">About</a></li>
    @endif
        <li><a href="#">Pages</a>
            <ul class="sub-menu">
			@if(Auth::user() && Auth::user()->role === 'admin')
            <li><a href="/dashboard">Dashboard</a></li>
        @endif
                <li><a href="/studios">Studio</a></li>
                <li><a href="/bookings">Boking</a></li>
            </ul>
        </li>
		<li><a href="#contact">Contact</a>
    </ul>
</header>

<script>
    function confirmLogout() {
        if (confirm('Apakah Anda yakin ingin logout?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
