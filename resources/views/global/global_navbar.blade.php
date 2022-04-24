<div class="container">
    <header class="py-3 border-bottom">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="link-secondary" href="#">Home</a>
            </div>
            <div class="col-4 text-center">
                <a class="header-title">家用货架管理系统</a>
            </div>
            <div class="col-4 d-flex justity-content-end align-items-center">
                <ul class="navbar-nav ml-auto">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle user link-secondary" href="#" id="navbardroplogin" data-toggle="dropdown" user-id="{{$global_data['user_id']}}">
                            {{$global_data['user_name']}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item link-secondary" href="#">个人中心</a>
                            <a class="dropdown-item link-secondary" href="#">设置</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item link-secondary" href="/logout">退出</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </header>
    <div class="nav-scroller py-1 mb-2">

    </div>
</div>