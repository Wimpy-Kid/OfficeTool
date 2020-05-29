<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
{{-- BEGIN HEAD --}}

<head>
    <meta charset="utf-8" />
    <title>{{ (isset($page_title) ? $page_title.' | ' : '') }}{{ config('app.name', '凡义咨询') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="陆上鱼的office工具" name="description" />
    <meta content="陆上鱼" name="author" />
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- BEGIN GLOBAL MANDATORY STYLES --}}
    {{-- @if (App::environment() == 'local')
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    @else
    <link href="http://fonts.useso.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    @endif --}}

    <link rel="stylesheet" href="{{ mix('/css/base_all.css') }}">


    @if (isset($extra_css))
        @if (is_array($extra_css))
            @foreach ($extra_css as $css)
                <link rel="stylesheet" href="{{$css}}">
            @endforeach
        @else
            <link rel="stylesheet" href="{{$extra_css}}">
        @endif
    @endif

    @yield('css')

    <script>
        window.tk = {!! json_encode(['csrfToken' => csrf_token()]); !!}
    </script>
    <link rel="shortcut icon" href="favicon.ico" />
</head>
{{-- END HEAD --}}

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-full-width">
<div class="page-wrapper">
    {{-- BEGIN HEADER --}}
    <div class="page-header navbar navbar-fixed-top">
        {{-- BEGIN HEADER INNER --}}
        <div class="page-header-inner ">
            {{-- BEGIN LOGO --}}
            <div class="page-logo">
                <a href="/#/home">
                    <img src="{{ asset('img/logo_main.png') }}" alt="logo" class="logo-default" /> </a>
                {{-- <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div> --}}
            </div>
            {{-- END LOGO --}}
            {{-- BEGIN MEGA MENU --}}
            {{-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background --}}
            {{-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions --}}
            <div class="hor-menu hidden-sm hidden-xs">
                <ul class="nav navbar-nav">
                    {{-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover --}}
                    @include('layouts.topnavbar')
                </ul>
            </div>
            {{-- END MEGA MENU --}}
            {{-- BEGIN RESPONSIVE MENU TOGGLER --}}
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            {{-- END RESPONSIVE MENU TOGGLER --}}
            {{-- BEGIN TOP NAVIGATION MENU --}}
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    {{-- BEGIN NOTIFICATION DROPDOWN --}}
                    {{-- END NOTIFICATION DROPDOWN --}}
                    {{-- BEGIN INBOX DROPDOWN --}}
                    {{-- END INBOX DROPDOWN --}}
                    {{-- BEGIN TODO DROPDOWN --}}
                    {{-- END TODO DROPDOWN --}}
                    {{-- BEGIN USER LOGIN DROPDOWN --}}
                    {{-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte --}}
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{ (isset($current_user) && $current_user->thumbnail_url) ? $current_user->thumbnail_url : asset('img/defava.png') }}" />
                            <span class="username username-hide-on-mobile"> {{ $current_user->name }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li class="{{ active_class(if_route('home')) }}">
                                <a href="/#/home">
                                    <i class="icon-user"></i> 我的主页 </a>
                            </li>
                            <li class="{{ active_class(if_route('my_account')) }}">
                                <a href="{{ route('my_account') }}">
                                    <i class="icon-settings"></i> 账户设置 </a>
                            </li>
                            {{--
                            <li>
                                <a href="app_calendar.html">
                                    <i class="icon-calendar"></i> My Calendar </a>
                            </li>
                            <li>
                                <a href="app_inbox.html">
                                    <i class="icon-envelope-open"></i> My Inbox
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="app_todo.html">
                                    <i class="icon-rocket"></i> My Tasks
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="page_user_lock_1.html">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li> --}}
                            <li>
                                <a href="javascript:;" onclick="localStorage.removeItem('user');localStorage.removeItem('accessToken');window.location = '{{ url('logout') }}'">
                                    <i class="icon-key"></i> 退出</a>
                            </li>
                        </ul>
                    </li>
                    {{-- END USER LOGIN DROPDOWN --}}
                    {{-- BEGIN QUICK SIDEBAR TOGGLER --}}
                    {{-- END QUICK SIDEBAR TOGGLER --}}
                </ul>
            </div>
            {{-- END TOP NAVIGATION MENU --}}
        </div>
        {{-- END HEADER INNER --}}
    </div>
    {{-- END HEADER --}}
    {{-- BEGIN HEADER & CONTENT DIVIDER --}}
    <div class="clearfix"> </div>
    {{-- END HEADER & CONTENT DIVIDER --}}
    {{-- BEGIN CONTAINER --}}
    <div class="page-container">
        {{-- BEGIN SIDEBAR --}}
        <div class="page-sidebar-wrapper">
            {{-- BEGIN SIDEBAR --}}
            {{-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --}}
            {{-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed --}}
            <div class="page-sidebar navbar-collapse collapse">
                {{-- BEGIN SIDEBAR MENU --}}
                {{-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) --}}
                {{-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode --}}
                {{-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode --}}
                {{-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --}}
                {{-- DOC: Set data-keep-expand="true" to keep the submenues expanded --}}
                {{-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed --}}
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    {{-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element --}}
                    {{-- BEGIN SIDEBAR TOGGLER BUTTON --}}
                    {{-- END SIDEBAR TOGGLER BUTTON --}}
                    @include('layouts.navbar')
                </ul>
                {{-- END SIDEBAR MENU --}}
            </div>
            {{-- END SIDEBAR --}}
        </div>
        {{-- END SIDEBAR --}}
        {{-- BEGIN CONTENT --}}
        <div class="page-content-wrapper">
            {{-- BEGIN CONTENT BODY --}}
            <div class="page-content">
                {{-- BEGIN PAGE HEADER --}}
                {{-- BEGIN PAGE BAR --}}
                @if(isset($breadcrumb))
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            @foreach($breadcrumb as $bc)
                                <li>
                                    @if(isset($bc['url']) and $bc['url'])
                                        <a href="{{ $bc['url'] }}">
                                            @else
                                                <span>
                                            @endif
                                            {{ $bc['name'] }}
                                            @if(isset($bc['url']) and $bc['url'])
                                        </a>
                                        @else
                                        </span>
                                    @endif
                                    @if (!$loop->last)
                                        <i class="fa fa-circle"></i>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @if(isset($page_toolbar))
                            <div class="page-toolbar">
                                @if($page_toolbar['type'] == 'btns')
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-circle green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> 工具
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            @foreach($page_toolbar['btns'] as $t)
                                                <li><a href="{{ $t['url'] }}">
                                                        @if(isset($t['icon']))
                                                            <i class="{{$t['icon']}}"></i>
                                                        @endif
                                                        {{$t['name']}}
                                                    </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @elseif($page_toolbar['type'] == 'text')
                                    {!! $page_toolbar['content'] !!}
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
                {{-- END PAGE BAR --}}

                {{-- BEGIN PAGE TITLE --}}
                @if(isset($page_title) && (!isset($no_page_title) || !$no_page_title))
                    <h1 class="page-title"> {{$page_title}}
                        @if(isset($page_subtitle))
                            <small>{{$page_subtitle}}</small>
                        @endif
                    </h1>
                @endif
                {{-- END PAGE TITLE --}}
                {{-- END PAGE HEADER --}}
                @yield('content')

                {{--
                @if(\App::environment('local'))
                    @include('layouts.dbdump')
                @endif
                --}}
            </div>
            {{-- END CONTENT BODY --}}
        </div>
        {{-- END CONTENT --}}
    </div>
    {{-- END CONTAINER --}}
    {{-- BEGIN FOOTER --}}
    <div class="page-footer">
        <div class="page-footer-inner"> {{ date('Y') }} &copy; {{ config('app.name') }}
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    {{-- END FOOTER --}}
</div>


<!--[if lt IE 9]>
{{-- <script src="{{ elixir('js/iefix.js') }}"></script>  --}}
<script src="{{ mix('/js/iefix.js') }}"></script>
<![endif]-->

@yield('OnPageVariables')


<script src="{{ mix('/js/core.js') }}" type="text/javascript"></script>
<script src="{{ mix('/js/global.js') }}" type="text/javascript"></script>
<script src="{{ mix('/js/layout.js') }}" type="text/javascript"></script>
@if (isset($need_datatable) && $need_datatable)
    <script src="{{ mix('/js/dt.js') }}" type="text/javascript"></script>
@endif
@if (isset($need_parsley) && $need_parsley)
    <script src="{{ mix('/js/parsley.js') }}" type="text/javascript"></script>
@endif


{{-- @if (isset($need_datatable) && $need_datatable && isset($need_parsley) && $need_parsley)
    <script src="{{ elixir('js/base_p_dt.js') }}" type="text/javascript"></script>
@elseif (isset($need_datatable) && $need_datatable)
    <script src="{{ elixir('js/base_dt.js') }}" type="text/javascript"></script>
@elseif (isset($need_parsley) && $need_parsley)
    <script src="{{ elixir('js/base_p.js') }}" type="text/javascript"></script>
@else
    <script src="{{ elixir('js/base.js') }}" type="text/javascript"></script>
@endif --}}

@if (isset($extra_js))
    @if (is_array($extra_js))
        @foreach ($extra_js as $js)
            <script src="{{$js}}" type="text/javascript"></script>
        @endforeach
    @else
        <script src="{{$extra_js}}" type="text/javascript"></script>
    @endif
@endif

@yield('onPageJS')

@if(isset($site_message))
    <script>
        $(function(){
                    @if($site_message['type'] == 'error')
            var msg_title = '错误！';
                    @elseif($site_message['type'] == 'success')
            var msg_title = '成功！';
                    @else
            var msg_title = '信息';
            @endif
            toastr.<?=$site_message['type'];?>('{!! $site_message['msg'] !!}', msg_title);
        })
    </script>
@endif
</body>

</html>