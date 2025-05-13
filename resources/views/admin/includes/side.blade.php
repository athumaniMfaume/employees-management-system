<div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                               <i class="mdi mdi-account-group"></i> <span data-key="t-dashboards">Employees</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('employees.create')}}" class="nav-link" data-key="t-analytics"> Add </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('employees.view')}}" class="nav-link" data-key="t-crm"> View</a>
                                    </li>
                                  
                                 
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                                <i class="mdi mdi-office-building"></i> <span data-key="t-base-ui">Departments</span>
                            </a>
                            <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{route('departments.create')}}" class="nav-link" data-key="t-alerts">Add</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('departments.index')}}" class="nav-link" data-key="t-badges">View</a>
                                            </li>
                                         
                                          
                                        </ul>
                                    </div>
                                  
                                </div>
                            </div>
                        </li>

                                                <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarU" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarU">
                                <i class="mdi mdi-cash-multiple"></i> <span data-key="t-base-ui">Salaries</span>
                            </a>
                            <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarU">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{route('salaries.create')}}" class="nav-link" data-key="t-alerts">Add</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('salaries.index')}}" class="nav-link" data-key="t-badges">View</a>
                                            </li>
                                         
                                          
                                        </ul>
                                    </div>
                                  
                                </div>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('complain.show')}}">
                                <i class="mdi mdi-message-alert-outline"></i> <span data-key="t-widgets">Complain</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('leave.show')}}">
                                <i class="mdi mdi-calendar-check"></i></i> <span data-key="t-widgets">Leave</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('admin.profile')}}">
                                <i class="mdi mdi-account-circle"></i>
                                  <span data-key="t-widgets">Profile</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('change_password') }}">
                                <i class="mdi mdi-lock-reset"></i> <span data-key="t-widgets">Change Password</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             <i class="mdi mdi-logout"></i> <span data-key="t-widgets">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                           </form>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>