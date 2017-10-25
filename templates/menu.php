<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Optionally, you can add icons to the links -->
      <li><a href="#"><i class="fa fa-link"></i> <span>Viajes</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Empleados</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Clientes</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Vehiculos</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Usuarios</span></a></li>
      <li <?php echo ($_GET['page'] == 'roles') ? 'class="active"' : '' ?> ><a href="index.php?page=roles"><i class="fa fa-link"></i> <span>Roles</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Mantenimiento de Vehiculos</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
