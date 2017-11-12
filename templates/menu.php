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
      <li><a href="index.php?page=clientes"><i class="fa fa-link"></i> <span>Clientes</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Viajes</span></a></li>
      <li <?php echo ( Helper::isPage('vehiculos') ) ? 'class="active"' : '' ?>><a href="index.php?page=vehiculos"><i class="fa fa-link"></i> <span>Vehiculos</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Mantenimiento de Vehiculos</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
