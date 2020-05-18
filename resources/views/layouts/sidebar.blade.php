<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/img/'. auth()->user()->image) }}" class="img-circle">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <h6 class="text-capitalize"></i>{{auth()->user()->role}}</h6>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Pencarian...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview active menu-open">
            <a href="#">
                <i class="glyphicon glyphicon-inbox"></i> <span>Manajemen Gudang</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> 
            </a>
            <ul class="treeview-menu">
                <li class="{{ (request()->is('berandagudang')) ? 'active' : '' }}"><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
                <li class="{{ (request()->is('stok')) ? 'active' : '' }}"><a href="{{ route('stok.index') }}"><i class="fa fa-database"></i> <span>Stok Barang</span></a></li>
                <li class="{{ (request()->is('stokmasuk')) ? 'active' : '' }}"><a href="{{ route('stokmasuk.index') }}"><i class="fa fa-sign-in"></i> <span>Stok Masuk</span></a></li>
                <li class="{{ (request()->is('stokkeluar')) ? 'active' : '' }}"><a href="{{ route('stokkeluar.index') }}"><i class="fa fa-sign-out"></i> <span>Stok Keluar</span></a></li>
                <li class="treeview {{ (request()->is('gudang','barang','pindah','kategori','merek','penyuplai','pembeli')) ? 'menu-open' : '' }}">
                    <a href="#"><i class="fa fa-files-o"></i> Data Master
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="{{ (request()->is('gudang','barang','pindah','kategori','merek','penyuplai','pembeli')) ? 'display: block;' : '' }}">
                        <li class="{{ (request()->is('gudang')) ? 'active' : '' }}"><a href="{{ route('gudang.index') }}"><i class="fa fa-truck"></i> <span>Gudang</span></a></li>
                        <li class="{{ (request()->is('barang')) ? 'active' : '' }}"><a href="{{ route('barang.index') }}"><i class="fa fa-cubes"></i> <span>Barang</span></a></li>
                        <li class="{{ (request()->is('pindah')) ? 'active' : '' }}"><a href="{{ route('pindah.index') }}"><i class="fa fa-exchange"></i> <span>Pindah Barang</span></a></li>
                        <li class="{{ (request()->is('kategori')) ? 'active' : '' }}"><a href="{{ route('kategori.index') }}"><i class="fa fa-tags"></i> <span>Kategori Barang</span></a></li>
                        <li class="{{ (request()->is('merek')) ? 'active' : '' }}"><a href="{{ route('merek.index') }}"><i class="fa fa-flag"></i> <span>Merek Barang</span></a></li>
                        <li class="{{ (request()->is('penyuplai')) ? 'active' : '' }}"><a href="{{ route('penyuplai.index') }}"><i class="fa fa-user-plus"></i> <span>Penyuplai</span></a></li>
                        <li class="{{ (request()->is('pembeli')) ? 'active' : '' }}"><a href="{{ route('pembeli.index') }}"><i class="fa fa-user-secret"></i> <span>Pembeli</span></a></li>
                    </ul>
                </li>
            </ul>
        </li>
            
            <li class="treeview active menu-open">
                <a href="#">
                    <i class="fa fa-dollar"></i> <span>Manajemen Rental</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> 
                </a>
                    <ul class="treeview-menu">
                        <li class="{{ (request()->is('berandarental')) ? 'active' : '' }}"><a href="{{ url('berandarental') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
                        <li class="{{ (request()->is('rentalstok')) ? 'active' : '' }}"><a href="{{ route('rentalstok.index') }}"><i class="fa fa-database"></i> <span>Stok Barang</span></a></li>
                        <li class="{{ (request()->is('rentalstokmasuk')) ? 'active' : '' }}"><a href="{{ route('rentalstokmasuk.index') }}"><i class="fa fa-download"></i> <span>Stok Masuk</span></a></li>
                        <li class="{{ (request()->is('rentalstokkeluar')) ? 'active' : '' }}"><a href="{{ route('rentalstokkeluar.index') }}"><i class="fa fa-upload"></i> <span>Stok Keluar</span></a></li>
                        
                        <li class="treeview {{ (request()->is('rentalbarang','rentalpindah','rentalkategori','rentalmerek','penyewa','tagihan')) ? 'menu-open' : '' }}">
                            <a href="#"><i class="fa fa-files-o"></i> Data Master
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu" style="{{ (request()->is('rentalbarang','rentalpindah','rentalkategori','rentalmerek','penyewa','tagihan')) ? 'display: block;' : '' }}">
                                <li class="{{ (request()->is('rentalbarang')) ? 'active' : '' }}"><a href="{{ route('rentalbarang.index') }}"><i class="fa fa-cubes"></i> <span>Barang</span></a></li>
                                <li class="{{ (request()->is('rentalpindah')) ? 'active' : '' }}"><a href="{{ route('rentalpindah.index') }}"><i class="fa fa-exchange"></i> <span>Pindah Barang</span></a></li>
                                <li class="{{ (request()->is('rentalkategori')) ? 'active' : '' }}"><a href="{{ route('rentalkategori.index') }}"><i class="fa fa-tags"></i> <span>Kategori Barang</span></a></li>
                                <li class="{{ (request()->is('rentalmerek')) ? 'active' : '' }}"><a href="{{ route('rentalmerek.index') }}"><i class="fa fa-flag"></i> <span>Merek Barang</span></a></li>
                                <li class="{{ (request()->is('penyewa')) ? 'active' : '' }}"><a href="{{ route('penyewa.index') }}"><i class="fa fa-street-view"></i> <span>Penyewa</span></a></li>
                                <li class="{{ (request()->is('tagihan')) ? 'active' : '' }}"><a href="{{ route('tagihan.index') }}"><i class="fa fa-money"></i> <span>Tagihan</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
            
            </ul>

        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Scripts -->
<!-- <script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>
<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{  asset('assets/documentation/docs.js"></script>
<script>
        $.sidebarMenu = function(menu) {
  var animationSpeed = 300;
  
  $(menu).on('click', 'li a', function(e) {
    var $this = $(this);
    var checkElement = $this.next();

    if (checkElement.is('.treeview-menu') && checkElement.is(':visible')) {
      checkElement.slideUp(animationSpeed, function() {
        checkElement.removeClass('menu-open');
      });
      checkElement.parent("li").removeClass("active");
    }

    //If the menu is not visible
    else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
      //Get the parent menu
      var parent = $this.parents('ul').first();
      //Close all open menus within the parent
      var ul = parent.find('ul:visible').slideUp(animationSpeed);
      //Remove the menu-open class from the parent
      ul.removeClass('menu-open');
      //Get the parent li
      var parent_li = $this.parent("li");

      //Open the target menu and add the menu-open class
      checkElement.slideDown(animationSpeed, function() {
        //Add the class active to the parent li
        checkElement.addClass('menu-open');
        parent.find('li.active').removeClass('active');
        parent_li.addClass('active');
      });
    }
    //if this isn't a link, prevent the page from being redirected
    if (checkElement.is('.treeview-menu')) {
      e.preventDefault();
    }
  });
}

$.sidebarMenu($('.sidebar-menu'))
</script> -->