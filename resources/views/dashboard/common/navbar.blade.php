<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard::index') }}">
    <div class="sidebar-brand-text mx-3"><img src="/img/logo.png" alt="logo" class="img-thumbnail"></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{route('dashboard::index')}}">
      <i class="fas fa-home"></i>
      <span>Inicio</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <!-- Nav Item - Utilities Collapse Menu -->



  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-users"></i>
      <span>Control de acceso</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('dashboard::users.index') }}">Colaboradores</a>
        <a class="collapse-item" href="{{ route('dashboard::roles.index') }}">Roles</a>
        <a class="collapse-item" href="{{ route('dashboard::permissions.index') }}">Permisos</a>
      </div>
    </div>
  </li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities3">
      <i class="fas fa-chart-line"></i>
      <span>Gráficos Historicos</span>
    </a>
    <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphics_view') }}">Humedad Ambiente</a>
        <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicshumedads_view') }}">Humedad Suelo</a>
        <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicstemperatura_view')}}">Temperatura Ambiente</a>
        <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicslitros_view')}}">Consumo litros</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities4">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Monitoreo tiempo real</span>
    </a>
    <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicsrealha_view') }}">Humedad Ambiente</a>
      <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicsrealhs_view') }}">Humedad suelo</a>
      <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicsrealte_view') }}">Temperatura</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities5" aria-expanded="true" aria-controls="collapseUtilities5">
      <i class="fas fa-tint"></i>
      <span>Riego Manual</span>
    </a>
    <div id="collapseUtilities5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('dashboard::graphics.consultagraphicsrealonoff_view') }}">Encender/Apagar Riego</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities6" aria-expanded="true" aria-controls="collapseUtilities6">
      <i class="fas fa-map-marked-alt"></i>
      <span>Maps</span>
    </a>
    <div id="collapseUtilities6" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('dashboard::maps.maps_view') }}">Ver zona</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
      <i class="fas fa-file-pdf"></i>
      <span>Exportaciones PDF</span>
    </a>
    <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('dashboard::pdfs.index') }}">Exportaciones a pdf</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
