<div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
      <li class="sidebar-toggler-wrapper hide">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler"> </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
      </li>
      <li class="sidebar-search-wrapper">
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
          <a href="javascript:;" class="remove">
            <i class="icon-close"></i>
          </a>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <a href="javascript:;" class="btn submit">
                <i class="icon-magnifier"></i>
              </a>
            </span>
          </div>
        </form>
        <!-- END RESPONSIVE QUICK SEARCH FORM -->
      </li>
      <li class="nav-item start active open">
        <a href="{{ url('/meli/admin') }}" class="nav-link nav-toggle">
          <i class="icon-home"></i>
          <span class="title">Dashboard</span>
          <span class="selected"></span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/meli/admin/orders') }}" class="nav-link ">
          <i class="icon-basket"></i><span class="title">Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/meli/admin/products') }}" class="nav-link ">
          <i class="icon-graph"></i><span class="title">Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/meli/admin/questions') }}" class="nav-link nav-toggle">
          <i class="fa fa-comments"></i><span class="title">Questions</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/meli/admin/stores') }}" class="nav-link nav-toggle">
          <i class="fa fa-university"></i><span class="title">Stores</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-rocket"></i><span class="title">Task</span>
        </a>
      </li>
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
  </div>
  <!-- END SIDEBAR -->
</div>