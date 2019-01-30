@php $sessionUser     = Auth::user() @endphp
<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
<div class="sidebar left sidebar-size-3 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
  <div data-scrollable>

    <div class="sidebar-block">
      <div class="profile">
        <a href="#">
          {{-- <img src="{{$sessionUser->profile->foto ? URL::asset($sessionUser->profile->foto) : ''}}" alt="people" class="img-circle width-80" /> --}}
        </a>
        <h4 class="text-display-1 margin-none">{{$sessionUser->name}}</h4>
      </div>
    </div>

    <ul class="sidebar-menu">
      <li ><a href="{{route('admin.dashboard')}}"><i class="fa fa-bar-chart-o"></i><span>Dashboard</span></a></li>
      <li class="{{ Request::is([
            'admin/ikm', 'admin/ikm*'
            ]) ? 'active':''}}">
            <a href="{{route('admin.ikm')}}"><i class="fa fa-institution"></i>
              <span>IKM</span>
            </a>
      </li>
      <li ><a href="{{route('admin.pasar-tradisional')}}"><i class="fa fa-home"></i><span>Pasar Tradisional</span></a></li>
      <li ><a href="{{route('admin.pasar-modern')}}"><i class="fa fa-shopping-cart"></i><span>Pasar Modern</span></a></li>
      <li ><a href="{{route('admin.sentra')}}"><i class="fa fa-building"></i><span>Sentra</span></a></li>
      <li ><a href="{{route('importir.index')}}"><i class="fa fa-flag"></i><span>Importir</span></a></li>
      <li ><a href="{{route('eksportir.index')}}"><i class="fa fa-flag"></i><span>Eksportir</span></a></li>
      
      <li class="hasSubmenu">
        <a href="#produk"><i class="fa fa-dropbox"></i><span>Produk</span></a>
        <ul id="produk" class="{{ Request::is([
            'admin/produk', 'admin/produk/*'
          ]) ? 'in':''}}">
          <li class="{{ Request::is([
              'admin/produk/kategori-produk', 'admin/produk/kategori-produk/*'
            ]) ? 'active':''}}">
            <a href="{{route('admin.produk.kategori-produk')}}"><span>Kategori Produk</span></a>
          </li>
          <li class="{{ Request::is([
              'admin/produk/list', 'admin/produk/list/*'
            ]) ? 'active':''}}">
            <a href="{{route('admin.produk.list')}}"><span>Produk</span></a>
          </li>
        </ul>
      </li>   

      <li class="hasSubmenu">
        <a href="#sertifikasi"><i class="fa fa-folder"></i><span>Sertifikasi</span></a>
        <ul id="sertifikasi" class="{{ Request::is([
            'admin/sertifikasi', 'admin/sertifikasi/*'

          ]) ? 'in':''}}">
          <li class="{{ Request::is([
              'admin/sertifikasi/kategori-sertifikasi', 'admin/sertifikasi/kategori-sertifikasi/*'
            
            ]) ? 'active':''}}">
            <a href="{{route('admin.sertifikasi.kategori-sertifikasi')}}"><span>Kategori Sertifikasi</span></a>
          </li>
          <li class="{{ Request::is([
              'admin/sertifikasi/list', 'admin/sertifikasi/list/*'
            
            ]) ? 'active':''}}">
            <a href="{{route('admin.sertifikasi.list')}}"><span>Sertifikasi</span></a>
          </li>
        </ul>
      </li>  

      <li class="{{ Request::is([
              'admin/event/', 'admin/event/*'  
            ]) ? 'active':''}}">
          <a href="{{route('admin.event.index')}}"><i class="fa fa-calendar"></i><span>Event</span></a>
      </li> 
      <li class="{{ Request::is([
              'admin/kehadiran-event/', 'admin/kehadiran-event/*'  
            ]) ? 'active':''}}">
          <a href="{{route('kehadiran-event.index')}}"><i class="fa fa-calendar"></i><span>Kehadiran Event</span></a>
      </li> 

      <li class="hasSubmenu">
        <a href="#pengguna"><i class="fa fa-users"></i><span>Pengguna</span></a>
        <ul id="pengguna" class="{{ Request::is([
            'admin/pengguna/kategori-pengguna', 'admin/pengguna/kategori-pengguna/*'
          ]) ? 'in':''}}">
          <li class="{{ Request::is([
            'admin/pengguna/kategori-pengguna', 'admin/pengguna/kategori-pengguna/*'
            ]) ? 'active':''}}">
            <a href="{{route('admin.pengguna.kategori-pengguna')}}"><span>Kategori Pengguna</span></a>
          </li>
          <li class="{{ Request::is([
            'admin/pengguna/list', 'admin/pengguna/list/*'
            ]) ? 'active':''}}">
            <a href="{{route('admin.pengguna.list')}}"><span>Pengguna</span></a>
          </li>
        </ul>
      </li>         
      
    </ul>
  </div>
</div>