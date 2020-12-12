<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{strpos(Route::current()->getName(), 'home' ) !== false ? "active" : ""}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <!-- <span class="right badge badge-danger">New</span> -->
                </p>
            </a>
        </li>

        <li class="nav-item ">
            <a href="{{ route('employees') }}" class="nav-link {{strpos(Route::current()->getName(), 'employees' ) !== false ? "active" : ""}}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Zaposleni
                    <!-- <span class="right badge badge-danger">New</span> -->
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('documents') }}" class="nav-link {{strpos(Route::current()->getName(), 'documents' ) !== false ? "active" : ""}}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Dokumenta
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('structure') }}" class="nav-link {{strpos(Route::current()->getName(), 'structure' ) !== false ? "active" : ""}}">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                    Organizaciona struktura
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('statistics') }}" class="nav-link {{strpos(Route::current()->getName(), 'statistics' ) !== false ? "active" : ""}}">
                <i class="nav-icon fas fa-chart-pie "></i>
                <p>
                    Statistika
                </p>
            </a>
        </li>
        
        

        <li class="nav-item">
            <form action="/logout" method="POST" id="logout">
                @csrf
            <a href="javascript:{}" onclick="document.getElementById('logout').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </form>
        </li>



    </ul>
</nav>
