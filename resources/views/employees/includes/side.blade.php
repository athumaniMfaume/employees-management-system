<div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>


                        <li class="nav-item">
                                        <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce"> Complaints
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{route('complain.create')}}" class="nav-link" data-key="t-products"> Add </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('single.employee.complain.view')}}" class="nav-link" data-key="t-product-Details"> View </a>
                                                </li>
                                              
                                            </ul>
                                        </div>
                                    </li>


                                    <li class="nav-item">
                                        <a href="#sidebarProjects" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects" data-key="t-projects">Leaves
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarProjects">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{route('leaves.create')}}" class="nav-link" data-key="t-list"> Add </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('single.employee.leaves.view')}}" class="nav-link" data-key="t-overview"> View </a>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="nav-item nav-link">
                                        

                                               <a class="dropdown-item" href="{{ route('employees.profile') }}"> <span class="align-middle">Profile</span></a>


                                       
                                                                          </li>

                                    <li class="nav-item nav-link">
                                        

                                               <a class="dropdown-item" href="{{ route('change_password') }}"> <span class="align-middle">Change Password</span></a>


                                       
                                                                          </li>


                                    <li class="nav-item nav-link">
                                        

                                              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf

                    <button type="submit" class="dropdown-item "> </i>Logout</button>
                </form>

                                       
                                                                          </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
   