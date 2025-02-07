<div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="mdi mdi-account"></i> <span data-key="t-dashboards">Employee</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('employees.create')}}" class="nav-link" data-key="t-analytics"> Add </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('employees.show')}}" class="nav-link" data-key="t-crm"> View </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="mdi mdi-account"></i> <span data-key="t-dashboards">Department</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('departments.create')}}" class="nav-link" data-key="t-analytics"> Add </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('departments.show')}}" class="nav-link" data-key="t-crm"> View </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li><!-- end Dashboard Menu -->
                      
                       

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>