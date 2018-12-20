<!-- Fixed navbar -->
<style type="text/css">
  .navbar-brand.navbar-brand-primary:after, .navbar-brand.navbar-brand-primary:hover:after {
    content: " ";
    display: block;
    position: absolute;
    bottom: -1px;
    height: 1px;
    left: 0;
    right: 0;
    background: #4caf50;
}
</style>

<div class="navbar navbar-size-large navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="#sidebar-menu" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand navbar-brand-primary navbar-brand-logo navbar-nav-padding-left" style="background-color: #4caf50;">
        <a style="font-size: 17px;" href="{{route('user.dashboard')}}">
          Banten Information Product
        </a>
      </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="main-nav">
      <ul class="nav navbar-nav navbar-nav-bordered navbar-right">
        <!-- notifications -->
        {{-- <li class="dropdown notifications updates">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            @if(isset($noticeAdmin))
              @if($noticeAdmin->count()>0) 
              <span class="badge badge-primary">{{$data->count()}}</span>
              @endif
            @endif
          </a>
          <ul class="dropdown-menu" role="notification">
            <li class="dropdown-header">Notifications</li>
            @if(isset($noticeAdmin))
            @foreach($noticeAdmin as $dataNotice)
            <li class="media">
              <div class="media-body">
                <h5>{{$dataNotice->data['subject']}}</h5>
                <a href="#" data-href="{{$dataNotice->data['action']}}" uid="{{$dataNotice->data['uid']}}" id="{{$dataNotice->id}}" class="link-text-color" onclick="markAsRead(this)">{!!str_limit(strip_tags($dataNotice->data['pesan']), 70)!!}</a>
                <br/>
                <span class="text-caption text-muted">{{$dataNotice->created_at->diffForHumans()}}</span>
              </div>
            </li>
            @endforeach
            @endif
             <li><a href="{{route('admin.notice')}}" style="text-align: center;">See all</a></li>
          </ul>
        </li> --}}
        <!-- // END notifications -->
        <!-- user -->
        <li class="dropdown user">
          <a href="#" class="logout"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
        <!-- // END user -->
      </ul>
    </div>
    <!-- /.navbar-collapse -->

  </div>
</div>