<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <div class="col-4 pt-1">
                <a class="link-secondary" href="#">Home</a>
            </div>
            <div class="col-4 text-center">
                <a class="text-dark header-title">家用货架管理系统</a>
            </div>
            <div class="col-4 d-flex justity-content-end align-items-center">
                <ul class="navbar-nav ml-auto">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle user link-secondary" href="#" id="navbardroplogin" data-toggle="dropdown" user-id="{{$global_data['user_id']}}">
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
        </div>
    </div>
</header>