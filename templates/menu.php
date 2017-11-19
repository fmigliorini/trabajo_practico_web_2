<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Optionally, you can add icons to the links -->
      <li <?php echo ( Helper::isPage('roles') ) ? 'class="active"' : '' ?> ><a href="index.php?page=roles"><i class="fa fa-link"></i> <span>Roles</span></a></li>
      <li <?php echo ( Helper::isPage('usuario') ) ? 'class="active"' : '' ?>><a href="index.php?page=usuario"><i class="fa fa-link"></i> <span>Usuarios</span></a></li>
      <li><a href="index.php?page=empleado"><i class="fa fa-link"></i> <span>Empleados</span></a></li>
      <li <?php echo ( Helper::isPage('clientes') ) ? 'class="active"' : '' ?>><a href="index.php?page=clientes"><i class="fa fa-link"></i> <span>Clientes</span></a></li>
      <li <?php echo ( Helper::isPage('viajes') ) ? 'class="active"' : '' ?>><a href="index.php?page=viajes"><i class="fa fa-link"></i> <span>Viajes</span></a></li>
      <li <?php echo ( Helper::isPage('vehiculos') ) ? 'class="active"' : '' ?>><a href="index.php?page=vehiculos"><i class="fa fa-link"></i> <span>Vehiculos</span></a></li>
      <li <?php echo ( Helper::isPage('mantenimiento') ) ? 'class="active"' : '' ?>><a href="index.php?page=mantenimiento"><i class="fa fa-link"></i> <span>Mantenimiento de vehiculos</span></a></li>
      <li <?php echo ( Helper::isPage('permisos') ) ? 'class="active"' : '' ?>><a href="index.php?page=permisos"><i class="fa fa-link"></i> <span>Permisos</span></a></li>
      <li <?php echo ( Helper::isPage('reportes') ) ? 'class="active"' : '' ?>><a href="index.php?page=reportes"><i class="fa fa-link"></i> <span>Reportes</span></a></li>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
