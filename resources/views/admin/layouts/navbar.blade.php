<nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                    
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                
                                <img src="img/profile-img.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">{{ Auth::user()->name }}</a>
                                
                                <form action="/logout" method="post">
                                @csrf 
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-in-right"></i> Logout
                                </button>
                            </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>