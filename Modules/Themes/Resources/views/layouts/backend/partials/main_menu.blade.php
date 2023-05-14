    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('modules/themes/backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                @php
                $menu = getMenuList();
                @endphp
                @if(!empty($menu))            
                @foreach($menu as $module)
                    @if(!empty($menu))
                        @foreach($module as $key=>$menu)
                            @if(!empty($menu))
                                @if(array_key_exists('sub-menu',$menu))
                                   <!-- implemntation start -->
                                    @php
                                        $submenu_flag = false;
                                        $submenu_active = false;
                                    @endphp
                                    @if($menu['sub-menu'])
                                        @foreach($menu['sub-menu'] as $sub_menu)
                                            @if(array_key_exists('sub-menu',$sub_menu))
                                               @if($sub_menu['sub-menu'])
                                                    @foreach($sub_menu['sub-menu'] as $sub_sub_menu)
                                                        @can($sub_sub_menu['middleware']) 
                                                            @php 
                                                                $submenu_flag=true; 
                                                            @endphp
                                                            @if($sub_sub_menu['href'] == URL::current())
                                                                @php 
                                                                    $submenu_active=true; 
                                                                @endphp
                                                            @endif
                                                        @endcan
                                                    @endforeach
                                                @endif
                                            @else
                                                @can($sub_menu['middleware']) 
                                                    @php 
                                                        $submenu_flag=true; 
                                                    @endphp
                                                    @if($sub_menu['href'] == URL::current())
                                                        @php 
                                                            $submenu_active=true; 
                                                        @endphp
                                                    @endif
                                                @endcan
                                            @endif
                                        @endforeach
                                    @endif
                                    @if($submenu_flag)
                                    <li class="nav-item {{($submenu_active)?'menu-open':''}}">
                                        <a href="#" class="nav-link  {{($submenu_active)?'active':''}}">
                                            <i class="nav-icon {{$menu['icon']}}"></i>
                                            <p>
                                                {{$menu['title']}}
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @if($menu['sub-menu'])
                                                @foreach($menu['sub-menu'] as $sub_menu)
                                                    @if(array_key_exists('sub-menu',$sub_menu))
                                                        @if($sub_menu['sub-menu'])
                                                                @php
                                                                    $sub_submenu_flag =false;
                                                                    $sub_submenu_active =false;
                                                                @endphp
                                                            @foreach($sub_menu['sub-menu'] as $sub_sub_menu)
                                                               @can($sub_sub_menu['middleware'])
                                                                    @php 
                                                                        $sub_submenu_flag = true; 
                                                                    @endphp
                                                                    @if($sub_sub_menu['href'] == URL::current())
                                                                        @php 
                                                                            $sub_submenu_active=true; 
                                                                        @endphp
                                                                    @endif
                                                                @endcan 
                                                            @endforeach
                                                        @endif
                                                        @if($sub_submenu_flag)
                                                        <li class="nav-item {{($sub_submenu_active)?'menu-open':''}}">
                                                            <a href="#" class="nav-link {{($sub_submenu_active)?'active':''}}">
                                                                <i class="nav-icon {{$sub_menu['icon']}}"></i>
                                                                <p>
                                                                    {{$sub_menu['title']}}
                                                                    <i class="right fas fa-angle-left"></i>
                                                                </p>
                                                            </a>
                                                            <ul class="nav nav-treeview">
                                                                @if($sub_menu['sub-menu'])
                                                                    @foreach($sub_menu['sub-menu'] as $sub_sub_menu)
                                                                        @can($sub_sub_menu['middleware']) 
                                                                            <li class="nav-item">
                                                                                <a href="{{$sub_sub_menu['href']}}" class="nav-link {{ ($sub_sub_menu['href'] == URL::current())?'active':''}}">
                                                                                    <i class="{{$sub_sub_menu['icon']}}"></i>
                                                                                    <p>{{$sub_sub_menu['title']}}</p>
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                    @endforeach
                                                                @endif
                                                            </ul>   
                                                        </li> 
                                                    @endif
                                                @else
                                                    @can($sub_menu['middleware']) 
                                                    <li class="nav-item">
                                                        <a href="{{$sub_menu['href']}}" class="nav-link {{ ($sub_menu['href'] == URL::current())?'active':''}}">
                                                            <i class="{{$sub_menu['icon']}}"></i>
                                                            <p>{{$sub_menu['title']}}</p>
                                                        </a>
                                                    </li>
                                                    @endcan 
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>   
                                </li> 
                                @endif
                                    <!-- implementation stop -->
                                @else
                                    @if(isset($menu['middleware']))
                                        @can($menu['middleware'])
                                            <li class="nav-item">
                                                <a href="{{$menu['href']}}" style="{{ ($menu['href'] == URL::current())?'pointer-events: none; cursor: default;':''}}" class="nav-link {{ ($menu['href'] == URL::current())?'active':''}}" >
                                                    <i class="{{$menu['icon']}}"></i>
                                                    <p>{{$menu['title']}}</p>
                                                </a>
                                            </li>
                                        @endcan
                                    @else
                                        <li class="nav-item">
                                            <a href="{{$menu['href']}}" style="{{ ($menu['href'] == URL::current())?'pointer-events: none; cursor: default;':''}}" class="nav-link {{ ($menu['href'] == URL::current())?'active':''}}" >
                                                <i class="{{$menu['icon']}}"></i>
                                                <p>{{$menu['title']}}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endif 
                @endforeach
            @endif
        </nav>
    @if(!auth()->user()->hasRole(config('core.super-admin')))
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h6>
                        <b>
                            Your Balance 
                        </b>
                    </h6>
                </div>
                <div class="card-text">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3>
                                <b class="current_balance">
                                    __.__
                                </b>
                            </h3>
                        </div>
                        <div class="col-sm-2">
                            <i class="fa fa-refresh pull-right" onclick=" getCurrentBalance();" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
    