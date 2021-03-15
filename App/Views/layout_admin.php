<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->view->title ?> - Admin Agendou</title>
    <!-- FullCalendar -->
    <link href='css/fullcalendar/main.css' rel='stylesheet' />
    <script src='js/fullcalendar/main.js'></script>
    <script src='locales/fullcalendar/pt-br.js'></script>
     <!-- FullCalendar -->

    <!-- Custom fonts for this template-->
    <link href="<?= $this->view->previous ?>vendor/admin/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $this->view->previous ?>css/admin/sb-admin-2.min.css" rel="stylesheet">
    

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- JS custom -->
    <script src="js/ajax-custom.js"></script> 
    <script src="js/logica-custom.js"></script> 
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - LOGO -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-0">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - Calendário -->
            <li class="nav-item">
                <a class="nav-link" href="/calendar">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Calendário</span>
                </a>
            </li>

            <!-- Nav Item - Compromissos -->
            <li class="nav-item">
                <a class="nav-link" href="/commitments">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Compromissos</span></a>
            </li>

            <!-- Nav Item - Serviços -->
            <li class="nav-item">
                <a class="nav-link" href="/services">
                    <i class="fas fa-fw fa-cut"></i>
                    <span>Serviços</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Search -->
                    <a href="/admin">Admin </a>
                    <a href="/agendamento">Agendamento online</a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter"></span><!-- Counter - Alerts -->
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Centro de Notificações
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Date actual</div>
                                        Nenhuma notificação encontrada!
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="">Mostrar todos as notificações</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
    
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->view->getInfoUser['name'] .' '. $this->view->getInfoUser['surname'] ?></span>
                                <img class="img-profile rounded-circle" src="<?= $this->view->previous ?>img/admin/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- - CONTAINER Begin Page Content -->
                <div class="container-fluid">
                      <?= $this->content() ?>
                </div><!-- / CONTAINER .container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Agendou 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= $this->view->previous ?>vendor/admin/jquery/jquery.min.js"></script>
<script src="<?= $this->view->previous ?>vendor/admin/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= $this->view->previous ?>vendor/admin/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= $this->view->previous ?>js/admin/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= $this->view->previous ?>vendor/admin/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= $this->view->previous ?>js/admin/demo/chart-area-demo.js"></script>
<script src="<?= $this->view->previous ?>js/admin/demo/chart-pie-demo.js"></script>

<!-- Booststrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>


<!-- JS - Personalizados -->
<script src="js/datepicker-personalizado.js"></script> 
<script src="js/validate-form.js"></script> 

</body>

</html>