<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/" class="brand-link text-center">
        <h4 class="brand-text font-weight-light">{{ config('app.name') }}</h4>
    </a>

    <div class="sidebar">
        <div class="user-panel my-3">
            <div class="info text-white">
                <h5 class="text-center">{{ auth()->user()->name }}</h5>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @admin
                <li class="nav-item">
                    <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->is('admin/teachers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Teachers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('courses.index') }}" class="nav-link {{ request()->is('admin/courses*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Courses
                        </p>
                    </a>
                </li>
                @endadmin

                @student
                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('students.courses.index') }}" class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            My Courses
                        </p>
                    </a>
                </li>
                @endstudent

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>

        </nav>

    </div>

</aside>