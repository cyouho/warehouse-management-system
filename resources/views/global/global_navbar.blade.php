<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle user" href="#" id="navbardroplogin" data-toggle="dropdown" user-id="{{$global_data['user_id']}}">
                    {{$global_data['user_name']}}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">个人主页</a>
                    <a class="dropdown-item" href="#">旅行详情</a>
                    <a class="dropdown-item" href="#">设置</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">退出</a>
                </div>
            </div>
        </ul>
    </div>
</nav>