<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Adji | 1705551004</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('startbootstrap/css/styles.css')}}" rel="stylesheet" />
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">
                <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="..." />
                <span class="brand-text font-weight-light" style="color: white;">Adji | 1705551004</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        @if (Auth::guest())
                        <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
                        @else
                        <li class="nav-item"><a href="/home" class="nav-link">Beranda</a></li>
                        <li class="nav-item">
                          <a href="#" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Selamat Datang!</div>
                <div class="masthead-heading text-uppercase">ayo belajar bersama</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#about">Daftar Sekarang</a>
            </div>
        </header>

        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Ayo Bergabung</h2>
                    <h3 class="section-subheading text-muted">Solusi belajar online terlengkap untuk SD, SMP, dan SMA sederajat.</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                          <span class="fa-stack fa-4x">
                            <i class="fas fa-school fa-stack-1x fa-inverse"></i>
                          </span>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Instansi Pendidikan</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Kamu bisa mendaftarkan sekolah atau lembaga pendidikan lainnya disini loh, termasuk dengan kelas atau program pendidikan lain yang dimiliki. Kamu juga bisa menambahkan guru lain agar kegiatan belajar mengajar menjadi bervariasi. Caranya mudah, <a href="/instansi/register"><strong> Ayo daftar sekarang!</strong></a></p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                          <span class="fa-stack fa-4x">
                              <i class="fas fa-user-tie fa-stack-1x fa-inverse"></i>
                          </span>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Guru</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Kamu seorang guru ingin membagikan soal sesuai dengan spesialisasimu ke lebih banyak siswa? Melalui platform ini, kamu bisa melakukannya. Segera unggah bank soal sesuai dengan spesialisasi yang dimiliki. <a href="/guru/register"> <strong>Ayo daftar sekarang!</strong></a></p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                          <span class="fa-stack fa-4x">
                              <i class="fas fa-user-graduate fa-stack-1x fa-inverse"></i>
                          </span>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Siswa</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Kamu ingin menambah pengetahuan sebagai seorang pelajar? Kamu bisa bergabung dengan sekolahmu atau mendaftar ke instansi pendidikan sesuai dengan kebutuhuan. Jadi tunggu apa lagi?<a href="/siswa/register"> <strong>Ayo daftar sekarang!</strong></a></p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Bergabung
                                <br />
                                Bersama
                                <br />
                                Kami!
                            </h4>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Ayo Bergabung!</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Buat kamu yang sudah mendaftar, bisa <a href="/login"> <strong>Login sekarang juga!</strong></a></p></div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Services-->
        <section class="page-section bg-light" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Fitur</h2>
                    <h3 class="section-subheading text-muted">Wali siswa akan mendapatkan pemberitahuan terkait perkembangan siswa.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x mb-4">
                          <img class="rounded-circle img-fluid fa-stack-1x" src="{{asset('startbootstrap/assets/img/about/4.jpg')}}" />
                        </span>
                        <h4 class="my-3">Instansi Pendidikan</h4>
                        <p class="text-muted">Kamu penasaran sekolah atau lembaga pendidikan apa yang terdaftar?<a href="{{route('home.instansi')}}"> <strong>Yuk cek disini!</strong></a></p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x mb-4">
                          <img class="rounded-circle img-fluid fa-stack-1x" src="{{asset('startbootstrap/assets/img/about/3.jpg')}}" />
                        </span>
                        <h4 class="my-3">Kelas/Program</h4>
                        <p class="text-muted">Apa kamu ingin tau kelas atau program kursus yang bisa diikuti?<a href="{{route('home.kelas.program')}}"> <strong>Yuk cek disini!</strong></a></p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x mb-4">
                          <img class="rounded-circle img-fluid fa-stack-1x" src="{{asset('startbootstrap/assets/img/about/1.jpg')}}" />
                        </span>
                        <h4 class="my-3">Mata Pelajaran</h4>
                        <p class="text-muted">Kamu ingin melihat mata pelajaran beserta materi yang tersedia?<a href="{{route('home.mapel')}}"> <strong>Yuk cek disini!</strong></a></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team-->
        <section class="page-section" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Guru Terbaik</h2>
                    <h3 class="section-subheading text-muted">Belajar bersama Master Teacher terbaik di mana saja</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('startbootstrap/assets/img/team/1.jpg')}}" alt="..." />
                            <h4>Parveen Anand</h4>
                            <p class="text-muted">Guru Matematika</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('startbootstrap/assets/img/team/2.jpg')}}" alt="..." />
                            <h4>Diana Petersen</h4>
                            <p class="text-muted">Guru Bahasa Indonesia</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('startbootstrap/assets/img/team/3.jpg')}}" alt="..." />
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Guru Sejarah</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        '
        <!-- Footer-->
        <footer class="footer py-4 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2021</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('startbootstrap/js/scripts.js')}}"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script>
          $("#example3").DataTable({
            "paging": true,
            "responsive": true, 
            "autoWidth": false,
            "pageLength": 3,
            "scrollCollapse": true
          }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        </script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
