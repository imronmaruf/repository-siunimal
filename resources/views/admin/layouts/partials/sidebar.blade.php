<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Dashboard</span>
                </li>

                <li class="active">
                    <a href="holiday.html"><i class="feather-grid"></i> <span>Dashboard</span></a>
                </li>

                <li class="menu-title">
                    <span>Data Master</span>
                </li>

                @can('admin-only')
                    <li>
                        <a href="holiday.html"><i class="fas fa-graduation-cap"></i> <span>Mahasiswa</span></a>
                    </li>

                    <li>
                        <a href="holiday.html"><i class="fas fa-chalkboard-teacher"></i> <span>Dosen</span></a>
                    </li>
                @endcan

                <li class="submenu">
                    <a href="#"><i class="fa fa-database"></i> <span> Repository</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="teachers.html">Kerja Praktek</a></li>
                        <li><a href="teacher-details.html">Tugas Akhir</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Menu User</span>
                </li>

                @can('admin-only')
                    <li>
                        <a href="{{ route('data-user.index') }}"><i class="fas fa-user"></i> <span>Data User</span></a>
                    </li>
                @endcan

                <li>
                    <a href="holiday.html"><i class="fas fa-cogs"></i> <span>Profil dan
                            Akun</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>
