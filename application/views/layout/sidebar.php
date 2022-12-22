
<div class="site-menubar __sidebar">
	<div class="site-menubar-body">
		<div>
			<div>
				<ul class="site-menu" data-plugin="menu">
					<br>
					<li class="site-menu-item">
						<a class="animsition-link" href="dashboard/home">
							<i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
							<span class="site-menu-title">Dashboard</span>
						</a>
                    </li>
                    <?php if($this->session->userdata('___switch') == 'administrator' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'administrator', 'role') || has_permission(MENU, 'administrator', 'module') || has_permission(MENU, 'administrator', 'operation') || has_permission(MENU, 'administrator', 'permission') || has_permission(MENU, 'administrator', 'user') || has_permission(MENU, 'administrator', 'password') || has_permission(MENU, 'administrator', 'email') || has_permission(MENU, 'administrator', 'privilege') || has_permission(MENU, 'administrator', 'token') || has_permission(MENU, 'administrator', 'online') || has_permission(MENU, 'administrator', 'activitylog') || has_permission(MENU, 'administrator', 'backup')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-balance" aria-hidden="true"></i>
                                    <span class="site-menu-title">Administrator</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'administrator', 'role')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/role">
                                                <span class="site-menu-title">User Role</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'module')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/module">
                                                <span class="site-menu-title">Module</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'operation')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/operation">
                                                <span class="site-menu-title">Operation</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'permission')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/permission">
                                                <span class="site-menu-title">Role Permission	</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'user')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/user">
                                                <span class="site-menu-title">Manage User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'password')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/password">
                                                <span class="site-menu-title">Reset Password</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'email')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/email">
                                                <span class="site-menu-title">Reset Email</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'privilege')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/privilege">
                                                <span class="site-menu-title">Reset Permission</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'token')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/token">
                                                <span class="site-menu-title">Reset Token</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'online')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/online">
                                                <span class="site-menu-title">Online User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'activitylog')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/activitylog">
                                                <span class="site-menu-title">Activity Log</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'backup')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/backup">
                                                <span class="site-menu-title">Backup database</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'admin' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'admin', 'user')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-assignment-account" aria-hidden="true"></i>
                                    <span class="site-menu-title">Admin</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'admin', 'user')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="admin/user">
                                                <span class="site-menu-title">Manage User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'master' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'master', 'user')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-lamp" aria-hidden="true"></i>
                                    <span class="site-menu-title">Master</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'master', 'user')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="master/user">
                                                <span class="site-menu-title">Data User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'frontend' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'frontend', 'slider') || has_permission(MENU, 'frontend', 'sambutan') || has_permission(MENU, 'frontend', 'budaya') || has_permission(MENU, 'frontend', 'visimisi') || has_permission(MENU, 'frontend', 'guru') || has_permission(MENU, 'frontend', 'testimoni')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Frontend</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'frontend', 'slider')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="frontend/slider">
                                                <span class="site-menu-title">Slider</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'frontend', 'sambutan')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="frontend/sambutan">
                                                <span class="site-menu-title">Sambutan Kepala</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'frontend', 'budaya')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="frontend/budaya">
                                                <span class="site-menu-title">Budaya Sekolah</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'frontend', 'visimisi')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="frontend/visimisi">
                                                <span class="site-menu-title">Visi dan Misi</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'frontend', 'guru')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="frontend/guru">
                                                <span class="site-menu-title">Guru dan Tenaga Pendidik</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'frontend', 'testimoni')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="frontend/testimoni">
                                                <span class="site-menu-title">Testimoni</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'kesiswaan' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'kesiswaan', 'ekstrakurukuler') || has_permission(MENU, 'kesiswaan', 'organiasi') || has_permission(MENU, 'kesiswaan', 'komite') || has_permission(MENU, 'kesiswaan', 'upt') || has_permission(MENU, 'kesiswaan', 'alumni') || has_permission(MENU, 'kesiswaan', 'agenda') || has_permission(MENU, 'kesiswaan', 'berita') || has_permission(MENU, 'kesiswaan', 'galeri')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Kesiswaan</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'kesiswaan', 'ekstrakurukuler')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/ekstrakurukuler">
                                                <span class="site-menu-title">Program Ekstrakurikuler</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'organiasi')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/organiasi">
                                                <span class="site-menu-title"> Struktur Organisasi</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'komite')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/komite">
                                                <span class="site-menu-title"> Komite Sekolah</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'upt')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/upt">
                                                <span class="site-menu-title">UPT Sekolah</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'alumni')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/alumni">
                                                <span class="site-menu-title">Alumni</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'agenda')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/agenda">
                                                <span class="site-menu-title">Agenda</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'berita')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/berita">
                                                <span class="site-menu-title">Berita</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'kesiswaan', 'galeri')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="kesiswaan/galeri">
                                                <span class="site-menu-title">Galeri</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'program_sekolah' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'program_sekolah', 'ungulan') || has_permission(MENU, 'program_sekolah', 'kurikulum') || has_permission(MENU, 'program_sekolah', 'keislaman') || has_permission(MENU, 'program_sekolah', 'humas') || has_permission(MENU, 'program_sekolah', 'sarana')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Program Sekolah</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'program_sekolah', 'ungulan')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="program_sekolah/ungulan">
                                                <span class="site-menu-title">Program Ungulan</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'program_sekolah', 'kurikulum')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="program_sekolah/kurikulum">
                                                <span class="site-menu-title">Program Kurikulum</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'program_sekolah', 'keislaman')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="program_sekolah/keislaman">
                                                <span class="site-menu-title">Program Keislaman</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'program_sekolah', 'humas')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="program_sekolah/humas">
                                                <span class="site-menu-title">Program Humas</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'program_sekolah', 'sarana')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="program_sekolah/sarana">
                                                <span class="site-menu-title">Bidang Sarana dan Prasarana</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'elibrary' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'elibrary', 'ebook') || has_permission(MENU, 'elibrary', 'video') || has_permission(MENU, 'elibrary', 'mp')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">E-Library</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'elibrary', 'ebook')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elibrary/ebook">
                                                <span class="site-menu-title">Ebook</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'elibrary', 'video')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elibrary/video">
                                                <span class="site-menu-title">Video </span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'elibrary', 'mp')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elibrary/mp">
                                                <span class="site-menu-title">Mp3</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'aplikasi' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'aplikasi', 'penjadwalan') || has_permission(MENU, 'aplikasi', 'absensiguru') || has_permission(MENU, 'aplikasi', 'absensisiswa') || has_permission(MENU, 'aplikasi', 'report') || has_permission(MENU, 'aplikasi', 'registrasiulang') || has_permission(MENU, 'aplikasi', 'kenaikankelas') || has_permission(MENU, 'aplikasi', 'alumnisiswa') || has_permission(MENU, 'aplikasi', 'siswapindah') || has_permission(MENU, 'aplikasi', 'cetakkartupelajar') || has_permission(MENU, 'aplikasi', 'cetakkartuujian') || has_permission(MENU, 'aplikasi', 'transkripnilai')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Aplikasi Sekolah</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'aplikasi', 'penjadwalan')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/penjadwalan">
                                                <span class="site-menu-title">Penjadwalan</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'absensiguru')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/absensiguru">
                                                <span class="site-menu-title">Absensi Guru</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'absensisiswa')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/absensisiswa">
                                                <span class="site-menu-title">Absensi Siswa</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'report')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/report">
                                                <span class="site-menu-title">Report</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'registrasiulang')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/registrasiulang">
                                                <span class="site-menu-title">Registrasi Ulang</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'kenaikankelas')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/kenaikankelas">
                                                <span class="site-menu-title">Kenaikan Kelas</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'alumnisiswa')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/alumnisiswa">
                                                <span class="site-menu-title">Alumni Siswa</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'siswapindah')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/siswapindah">
                                                <span class="site-menu-title">Siswa Pindah</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'cetakkartupelajar')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/cetakkartupelajar">
                                                <span class="site-menu-title">Cetak Kartu Pelajar</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'cetakkartuujian')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/cetakkartuujian">
                                                <span class="site-menu-title">Cetak Kartu Ujian</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'aplikasi', 'transkripnilai')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="aplikasi/transkripnilai">
                                                <span class="site-menu-title">Transkrip Nilai</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'elearning' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'elearning', 'banksoal') || has_permission(MENU, 'elearning', 'materipelajaran') || has_permission(MENU, 'elearning', 'dataujian') || has_permission(MENU, 'elearning', 'cbt')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">E-Learning</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'elearning', 'banksoal')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elearning/banksoal">
                                                <span class="site-menu-title">Bank Soal</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'elearning', 'materipelajaran')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elearning/materipelajaran">
                                                <span class="site-menu-title">Materi Pelajaran</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'elearning', 'dataujian')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elearning/dataujian">
                                                <span class="site-menu-title">Data Ujian</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'elearning', 'cbt')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="elearning/cbt">
                                                <span class="site-menu-title">Computer Based Test</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'bank' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'bank', 'akun') || has_permission(MENU, 'bank', 'jurnalumum') || has_permission(MENU, 'bank', 'neraca') || has_permission(MENU, 'bank', 'labarugi') || has_permission(MENU, 'bank', 'spp') || has_permission(MENU, 'bank', 'uangbuku') || has_permission(MENU, 'bank', 'hartatetap') || has_permission(MENU, 'bank', 'bukubesar') || has_permission(MENU, 'bank', 'bukukas') || has_permission(MENU, 'bank', 'slipgaji')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Mini Bank</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'bank', 'akun')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/akun">
                                                <span class="site-menu-title">Akun</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'jurnalumum')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/jurnalumum">
                                                <span class="site-menu-title">Jurnal Umum</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'neraca')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/neraca">
                                                <span class="site-menu-title">Neraca</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'labarugi')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/labarugi">
                                                <span class="site-menu-title">Laba Rugi</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'spp')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/spp">
                                                <span class="site-menu-title">Pembayaran SPP</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'uangbuku')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/uangbuku">
                                                <span class="site-menu-title">Pembayaran Uang Buku</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'hartatetap')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/hartatetap">
                                                <span class="site-menu-title">Harta Tetap</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'bukubesar')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/bukubesar">
                                                <span class="site-menu-title">Buku Besar</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'bukukas')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/bukukas">
                                                <span class="site-menu-title">Buku Kas</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'bank', 'slipgaji')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="bank/slipgaji">
                                                <span class="site-menu-title">Slip Gaji</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'siswa' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'siswa', 'nilai') || has_permission(MENU, 'siswa', 'daftarmepl') || has_permission(MENU, 'siswa', 'daftarkeuangan') || has_permission(MENU, 'siswa', 'pengumuman') || has_permission(MENU, 'siswa', 'saldo')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Siswa</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'siswa', 'nilai')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="siswa/nilai">
                                                <span class="site-menu-title">Daftar Nilai</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'siswa', 'daftarmepl')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="siswa/daftarmepl">
                                                <span class="site-menu-title">Daftar Mata Pelajaran</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'siswa', 'daftarkeuangan')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="siswa/daftarkeuangan">
                                                <span class="site-menu-title">Daftar Keuangan</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'siswa', 'pengumuman')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="siswa/pengumuman">
                                                <span class="site-menu-title">Pengumuman</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'siswa', 'saldo')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="siswa/saldo">
                                                <span class="site-menu-title">Saldo</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'orangtua' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'orangtua', 'nilai') || has_permission(MENU, 'orangtua', 'daftarmepl') || has_permission(MENU, 'orangtua', 'daftarkeuangan') || has_permission(MENU, 'orangtua', 'pengumuman') || has_permission(MENU, 'orangtua', 'saldo')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                                    <span class="site-menu-title">Orang Tua Wali</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'orangtua', 'nilai')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="orangtua/nilai">
                                                <span class="site-menu-title">Daftar Nilai</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'orangtua', 'daftarmepl')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="orangtua/daftarmepl">
                                                <span class="site-menu-title">Daftar Mata Pelajaran</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'orangtua', 'daftarkeuangan')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="orangtua/daftarkeuangan">
                                                <span class="site-menu-title">Daftar Keuangan</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'orangtua', 'pengumuman')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="orangtua/pengumuman">
                                                <span class="site-menu-title">Pengumuman</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'orangtua', 'saldo')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="orangtua/saldo">
                                                <span class="site-menu-title">Saldo</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
					</li>
				</ul>
            </div>
        </div>
    </div>
    <div class="site-menubar-footer">
        <a href="javascript: void(0);" id="button_edit" data-url='<?= site_url('setting/index') ?>' data-id='<?= 1 ?>' class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings">
            <span class="icon md-settings" aria-hidden="true"></span>
        </a>
        <a href="<?= site_url('lockscreen')?>" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon md-eye-off" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" id="button_logout" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon md-power" aria-hidden="true"></span>
        </a>
    </div>
</div>
<div class="site-gridmenu">
    <div>
        <div>
            <ul>
                <li class="button_menu" data-url="dashboard/switch" data-menu="administrator">
                    <a href="#">
                        <i class="icon md-balance"></i>
                        <span>Administrator</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="admin">
                    <a href="#">
                        <i class="icon md-assignment-account"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="master">
                    <a href="#">
                        <i class="icon md-lamp"></i>
                        <span>Master</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="frontend">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Frontend</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="kesiswaan">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Kesiswaan</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="program_sekolah">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Program Sekolah</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="elibrary">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>E-Library</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="aplikasi">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Aplikasi Sekolah</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="elearning">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>E-Learning</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="bank">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Mini Bank</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="siswa">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="default">
                    <a href="#">
                        <i class="icon md-apps"></i>
                        <span>Default</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
        