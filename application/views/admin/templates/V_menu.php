<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets/dist/img/img.jpg') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Bale Kode</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="<?= site_url('admin/home') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Data Master</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="<?= $sub_judul == 'Suplier' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/suplier') ?>"><i class="fa fa-circle-o"></i> Suplier</a></li>
                    <li class="<?= $sub_judul == 'Customer' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/customer') ?>"><i class="fa fa-circle-o"></i> Customer</a>
                    </li>
                    <li class="<?= $sub_judul == 'Akun' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/rekening') ?>"><i class="fa fa-circle-o"></i> Data Akun /
                            COA</a></li>
                    <li class="<?= $sub_judul == 'Saldo' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/saldo') ?>"><i class="fa fa-circle-o"></i> Saldo Awal</a></li>
                    <li class="<?= $sub_judul == 'Barang' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/barang') ?>"><i class="fa fa-circle-o"></i> Item Barang</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Transaksi</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="<?= $sub_judul == 'Penjualan' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/penjualan') ?>"><i class="fa fa-circle-o"></i> Penjualan</a>
                    </li>
                    <li class="<?= $sub_judul == 'Pembelian' ? 'active' : '' ?>">
                        <a href="<?= site_url('admin/pembelian') ?>"><i class="fa fa-circle-o"></i> Pembelian</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>System</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Akun
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?= $sub_judul == 'System Akun' ? 'active' : '' ?>"><a href="<?= site_url('admin/system/akun') ?>"><i class="fa fa-circle-o"></i> Klasifikasi & Jenis Akun</a></li>
                           <!--  <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul> -->
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
