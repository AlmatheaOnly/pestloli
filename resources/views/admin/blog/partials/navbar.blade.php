<ul class="navbar-nav mr-auto">
    <li class="nav-item"><a class="nav-link" href="/">首页</a></li>
    @auth
        <li @if (Request::is('admin/blog/post*')) class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="{{url('/admin/blog/post')}}">文章</a>
        </li>
        <li @if (Request::is('admin/blog/tag*')) class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="{{url('admin/blog/tag')}}">标签</a>
        </li>
        <li @if (Request::is('admin/blog/upload*')) class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/admin/blog/upload">上传</a>
        </li>
    @endauth
</ul>

<ul class="navbar-nav ml-auto">
    @guest
        <li class="nav-item"><a class="nav-link" href="{{url('admin/login')}}">登录</a></li>
    @else
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false">
                {{ Auth::guard()->user()->name }}
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="admin/logout">退出</a>
            </div>
        </li>
    @endguest
</ul>