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

        <li class="nav-item {{ ((request()->is('documents')) || (request()->is('tag*')) || (request()->is('directory*')) ) ? "menu-open" : " "}}">
            <a href="#" class="nav-link {{ ((request()->is('documents')) || (request()->is('tag*')) || (request()->is('directory*')) ) ? "active" : " "}}">
                <i class="nav-icon fas fa-database"></i>

                <p>
                    Fajl sistem
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ ((request()->is('documents')) || (request()->is('tag*')) || (request()->is('directory*')) ) ? "block" : "none"}};">

                <li class="nav-item">
                    <div class=" input-group">
                        <input class="form-control" type="search" placeholder="Pretraga" id="keyword">
                        <span class="input-group-append mr-1">
                        <button class="btn btn-outline-secondary border-left-0 border " id="search" type="button">
                                <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                </li>

                <li class="nav-item mt-1">
                    <a href="{{ route('documents') }}" class="nav-link {{strpos(Route::current()->getName(), 'documents' ) !== false ? "active" : ""}}">
                        <i class="fas fa-database"></i>
                        <p>Prikazi sve</p>
                    </a>
                </li>
                
                <li class="nav-item {{ ((request()->is('directory*')) ) ? "menu-open" : " "}}">
                    <a href="#" class="nav-link {{ ((request()->is('directory*')) ) ? "active" : " "}}">
                        <i class="{{ ((request()->is('directory*')) ) ? "fas fa-folder-open" : "fas fa-folder"}}"></i>
                        <p>
                            Folderi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ ((request()->is('directory*')) ) ? "block" : "none"}};" id="target-dir">
                
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-folder"></i>
                        <p>
                            Dokumenta
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:none" id="target-file">
                
                    </ul>
                </li>


                <li class="nav-item {{ ((request()->is('tag*')) ) ? "menu-open" : " "}}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tag"></i>
                        <p>
                            Tagovi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:{{ ((request()->is('tag*')) ) ? "block" : "none"}}">
                        <li class="nav-item {{ ((request()->is('tag/sector*')) ) ? "menu-open" : " "}}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Sektori
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display:{{ ((request()->is('tag/sector*')) ) ? "block" : "none"}}" id="target-sector">
                            
                            </ul>
                        </li>

                        <li class="nav-item {{ ((request()->is('tag/type*')) ) ? "menu-open" : " "}}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file"></i>
                                <p>
                                    Tip
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display:{{ ((request()->is('tag/type*')) ) ? "block" : "none"}}" id="target-type">
                            
                            </ul>
                        </li>


                    </ul>
                </li>


            </ul>
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

