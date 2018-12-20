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
      <li ><a href="{{route('user.dashboard')}}"><i class="fa fa-bar-chart-o"></i><span>Dashboard</span></a></li>
      <li class="{{ Request::is([
            'user/ikm', 'user/ikm*'
            ]) ? 'active':''}}">
            <a href="{{route('user.ikm')}}"><i class="fa fa-institution"></i>
              <span>IKM</span>
            </a>
      </li>
      <li ><a href="{{route('user.pasar-tradisional')}}"><i class="fa fa-home"></i><span>Pasar Tradisional</span></a></li>
      <li ><a href="{{route('user.pasar-modern')}}"><i class="fa fa-shopping-cart"></i><span>Pasar Modern</span></a></li>
      <li ><a href="{{route('user.sentra')}}"><i class="fa fa-building"></i><span>Sentra</span></a></li>
     {{--  <li class="hasSubmenu">
        <a href="#member-menu"><i class="fa fa-users"></i><span>Member</span></a>
        <ul id="member-menu" class="{{ Request::is('admin/member/*') ? 'in':''}}">
          <li class="hasSubmenu ">
            <a href="#instructor-menu"><i class="fa fa-user-plus"></i><span>Instructor</span></a>
            <ul id="instructor-menu" class="{{ Request::is('admin/member/instructor/*') ? 'in':''}}">
              <li class="{{ Request::is('admin/member/instructor/reguler') ? 'active':''}}"><a href="{{route('instructor.reguler')}}"><span>Regular</span></a></li>
              <li class="{{ Request::is('admin/member/instructor/master') ? 'active':''}}"><a href="{{route('instructor.master')}}"><span>Master</span></a></li>
            </ul>
          </li>
          <li class="{{ Request::is('admin/member/student') ? 'active':''}}"><a href="{{route('student')}}"><i class="fa fa-user"></i><span>Student</span></a></li>
        </ul>
      </li> --}}
      
    
      <li class="hasSubmenu">
        <a href="#pengguna"><i class="fa fa-users"></i><span>Pengguna</span></a>
        <ul id="pengguna" class="{{ Request::is([
            'user/pengguna/kategori-pengguna', 'user/pengguna/kategori-pengguna/*'
          ]) ? 'in':''}}">
          <li class="{{ Request::is([
            'user/pengguna/kategori-pengguna', 'user/pengguna/kategori-pengguna/*'
            ]) ? 'active':''}}">
            <a href="{{route('user.pengguna.kategori-pengguna')}}"><span>Kategori Pengguna</span></a>
          </li>
        </ul>
      </li>         

      <li class="hasSubmenu">
        <a href="#produk"><i class="fa fa-dropbox"></i><span>Produk</span></a>
        <ul id="produk" class="{{ Request::is([
            'user/produk', 'user/produk/*'
          ]) ? 'in':''}}">
          <li class="{{ Request::is([
              'user/produk/kategori-produk', 'user/produk/kategori-produk/*'
            ]) ? 'active':''}}">
            <a href="{{route('user.produk.kategori-produk')}}"><span>Kategori Produk</span></a>
          </li>
        </ul>
      </li>   

      <li class="hasSubmenu">
        <a href="#sertifikasi"><i class="fa fa-folder"></i><span>Sertifikasi</span></a>
        <ul id="sertifikasi" class="{{ Request::is([
            'user/sertifikasi', 'user/sertifikasi/*'

          ]) ? 'in':''}}">
          <li class="{{ Request::is([
              'user/sertifikasi/kategori-sertifikasi', 'user/sertifikasi/kategori-sertifikasi/*'
            
            ]) ? 'active':''}}">
            <a href="{{route('user.sertifikasi.kategori-sertifikasi')}}"><span>Kategori Sertifikasi</span></a>
          </li>
        </ul>
      </li>         
      
    </ul>
  </div>
</div>