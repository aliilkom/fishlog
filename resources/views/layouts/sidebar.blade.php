<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/img/'. auth()->user()->image) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <h6 class="text-capitalize"></i>{{auth()->user()->role}}</h6>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Pencarian...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview active menu-open">
            <a href="#">
                <i class="glyphicon glyphicon-inbox"></i> <span>Manajemen Gudang</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> 
            </a>
            <ul class="treeview-menu">
                <li class=""><a href="{{ url('beranda1') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
                <li class=""><a href="{{ route('gudang.index') }}"><i class="fa fa-truck"></i> <span>Data Gudang</span></a></li>
                <li class=""><a href="{{ route('barang.index') }}"><i class="fa fa-cubes"></i> <span>Data Barang</span></a></li>
                <li class=""><a href="{{ route('barang.index') }}"><i class="fa fa-exchange"></i> <span>Pindah Barang</span></a></li>
                <li class=""><a href="{{ route('kategori.index') }}"><i class="fa fa-tags"></i> <span>Kategori Barang</span></a></li>
                <li class=""><a href="{{ route('merek.index') }}"><i class="fa fa-flag"></i> <span>Merek Barang</span></a></li>
                <li class=""><a href="{{ route('stokmasuk.index') }}"><i class="fa fa-sign-in"></i> <span>Stok Masuk</span></a></li>
                <li class=""><a href="{{ route('penyuplai.index') }}"><i class="fa fa-user-plus"></i> <span>Data Penyuplai</span></a></li>
                <li class=""><a href="{{ route('stokkeluar.index') }}"><i class="fa fa-sign-out"></i> <span>Stok Keluar</span></a></li>
                <li class=""><a href="{{ route('pembeli.index') }}"><i class="fa fa-user-secret"></i> <span>Data Pembeli</span></a></li>
            </ul>
            </li>
            
            <li class="treeview active menu-open">
            <a href="#">
                <i class="fa fa-dollar"></i> <span>Manajemen Rental</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> 
            </a>
                    <ul class="treeview-menu">
                        <li class=""><a href="{{ url('beranda2') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
                        <li class=""><a href="{{ route('rental.index') }}"><i class="fa fa-puzzle-piece"></i> <span>Rental Gudang</span></a></li>
                        <li class=""><a href="{{ route('stokrentalmasuk.index') }}"><i class="fa fa-download"></i> <span>Stok Masuk</span></a></li>
                        <li class=""><a href="{{ route('stokrentalkeluar.index') }}"><i class="fa fa-upload"></i> <span>Stok Keluar</span></a></li>
                        <li class=""><a href="{{ route('penyewa.index') }}"><i class="fa fa-street-view"></i> <span>Data Penyewa</span></a></li>
                        <li class=""><a href="{{ route('penyewa.index') }}"><i class="fa fa-money"></i> <span>Tagihan</span></a></li>
                    </ul>
            </li>
            
        </ul>
        
        

        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
