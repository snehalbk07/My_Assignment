  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
     

      <!-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> -->
      <li class="nav-item dropdown" style="margin-right:10px">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <span class="caret">{{ Auth::user()->name }}</span>
        </a>
       
      </li>
       
        </a>
        <form id="logout-form" action="" method="POST" class="d-none">
          @csrf
        </form>
      <!-- </div> -->
    </li>
    
  </ul>
</nav>
<!-- /.navbar -->
