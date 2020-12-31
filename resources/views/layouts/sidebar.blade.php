<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">DataMaster</span></li>

                @role('penjual')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('makam.index') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Makam</span>
                    </a>
                </li>
                @endrole

                @role('pembeli')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('marketplace.index') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Marketplace</span>
                    </a>
                </li>
                @endrole
                
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="javascript:void(0)" aria-expanded="false"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
