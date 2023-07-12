<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-brand">
            SI<span>REMINDER</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Menu</li>
            @if (auth()->user()->id_role == 1)
                <li class="nav-item {{ active_class(['kelolasuratmasuk']) }}">
                    <a href="{{ url('/kelolasuratmasuk') }}" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Kelola Surat Masuk</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['suratmasuk/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#suratmasuk" role="button"
                        aria-expanded="{{ is_active_route(['suratmasuk/*']) }}" aria-controls="suratmasuk">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Daftar Surat Masuk</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['suratmasuk/*']) }}" id="suratmasuk">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/bupati') }}"
                                    class="nav-link {{ active_class(['suratmasuk/bupati']) }}">Untuk
                                    Bupati</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/lain') }}"
                                    class="nav-link {{ active_class(['suratmasuk/lain']) }}">Kegiatan Lain</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/pending') }}"
                                    class="nav-link {{ active_class(['suratmasuk/pending']) }}">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/approved') }}"
                                    class="nav-link {{ active_class(['suratmasuk/approved']) }}">Approved</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/declined') }}"
                                    class="nav-link {{ active_class(['suratmasuk/declined']) }}">Declined</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['kelolarencanakerja']) }}">
                    <a href="{{ url('/kelolarencanakerja') }}" class="nav-link">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">Kelola Rencana Kerja</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['kelolarencanakerja/kalender']) }}">
                    <a href="{{ url('/kelolarencanakerja/kalender') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Kalender Rencana Kerja</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['daftarrencanakerja/list']) }}">
                    <a href="{{ url('/daftarrencanakerja/list') }}" class="nav-link">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Daftar Rencana Kerja</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['rencanakerja/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#rencanakerja" role="button"
                        aria-expanded="{{ is_active_route(['rencanakerja/*']) }}" aria-controls="rencanakerja">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Rencana Kerja</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['rencanakerja/*']) }}" id="rencanakerja">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('rencanakerja/ldlp') }}"
                                    class="nav-link {{ active_class(['rencanakerja/ldlp']) }}">Luar Daerah Luar
                                    Prov.</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('rencanakerja/lddp') }}"
                                    class="nav-link {{ active_class(['rencanakerja/lddp']) }}">Luar Daerah Dalam
                                    Prov.</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('rencanakerja/dddk') }}"
                                    class="nav-link {{ active_class(['rencanakerja/dddk']) }}">Dalam Daerah Dalam
                                    Kab.</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['akun']) }}">
                    <a href="{{ url('/akun') }}" class="nav-link">
                        <i class="link-icon" data-feather="user-check"></i>
                        <span class="link-title">Akun Pengguna</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['temp']) }}">
                    <a href="{{ url('/temp') }}" class="nav-link">
                        <i class="link-icon" data-feather="trash"></i>
                        <span class="link-title">Tempat Sampah</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->id_role == 2)
                <li class="nav-item {{ active_class(['suratmasuk']) }}">
                    <a href="{{ url('/suratmasuk') }}" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Surat Masuk</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pegawai']) }}">
                    <a href="{{ url('/pegawai') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Pegawai</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['jabatan']) }}">
                    <a href="{{ url('/jabatan') }}" class="nav-link">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Jabatan</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['temp']) }}">
                    <a href="{{ url('/temp') }}" class="nav-link">
                        <i class="link-icon" data-feather="trash"></i>
                        <span class="link-title">Tempat Sampah</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->id_role == 3)
                <li class="nav-item {{ active_class(['daftarsuratmasuk']) }}">
                    <a href="{{ url('/daftarsuratmasuk') }}" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Daftar Surat Masuk</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['suratmasuk/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#suratmasuk" role="button"
                        aria-expanded="{{ is_active_route(['suratmasuk/*']) }}" aria-controls="suratmasuk">
                        <i class="link-icon" data-feather="check-circle"></i>
                        <span class="link-title">Approval Surat Masuk</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['suratmasuk/*']) }}" id="suratmasuk">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/pendingBupati') }}"
                                    class="nav-link {{ active_class(['suratmasuk/pendingBupati']) }}">Status
                                    Pending</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/approvedBupati') }}"
                                    class="nav-link {{ active_class(['suratmasuk/approvedBupati']) }}">Status
                                    Approved</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('suratmasuk/declinedBupati') }}"
                                    class="nav-link {{ active_class(['suratmasuk/declinedBupati']) }}">Status
                                    Declined</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['rencanakerja/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#rencanakerja" role="button"
                        aria-expanded="{{ is_active_route(['rencanakerja/*']) }}" aria-controls="rencanakerja">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Daftar Rencana Kerja</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['rencanakerja/*']) }}" id="rencanakerja">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('rencanakerja/ldlpBupati') }}"
                                    class="nav-link {{ active_class(['rencanakerja/ldlpBupati']) }}">Luar Daerah Luar
                                    Prov.</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('rencanakerja/lddpBupati') }}"
                                    class="nav-link {{ active_class(['rencanakerja/lddpBupati']) }}">Luar Daerah Dalam
                                    Prov.</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('rencanakerja/dddkBupati') }}"
                                    class="nav-link {{ active_class(['rencanakerja/dddkBupati']) }}">Dalam Daerah
                                    Dalam
                                    Kab.</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
