<!DOCTYPE html>
<html>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>智者派官方网站</title>
        <link href="{{URL::asset('/css/front/index.css') }}" rel="stylesheet" type="text/css"  />

        <link href="{{URL::asset('/css/front/proclamtion.css')}}" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="{{URL::asset('/js/front/jquery-core.min.js')}}"></script>

        <!-- baidu stat -->
        <!--内容代码 -->
        <link href="{{URL::asset('/css/front/mainCss.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/front/swiper.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/front/animation.min.css')}}" />
        <!--内容代码-->
    </head>

    <!--内容代码-->
</head>

<body>
{{-- 包含页头 --}}

<div id="big_head">
<div id="tou">

    <div class="logo"><img src="{{URL::asset('/images/front/logo.png')}}"></div>

    <div class="xinxi white">
        <ul>
            <li> <a href="/">首页</a> </li>
            <li> <a href="/front/proclamation">最新公告</a> </li>
            <li> <a href="/front/stock_grow">连续下跌</a> </li>
            <li> <a href="/front/get_down_up">反弹股票</a> </li>
            <li> <a href="/front/up_stock">连续上涨</a> </li>
            <li> <a href="/front/bonus_herald/1">分红预测</a> </li>

        </ul>

    </div>

    <div class="denglu">
        @if( Session::has('user_name') )
        <a href="###"> {{ Session::get('user_name') }}</a>
            <a href="/front/login_out">退出</a>
        @else
        <a href="/front/login">登录 </a><a href="/front/register">注册</a>
        @endif
    </div>
</div>
</div>
<div id="search" >
    <div id="search_block" >
       搜索股票：  <input id="search_stock" type="text" value="请输入股票代码 或 股票名称"
               onfocus="javascript:if(this.value=='请输入股票代码 或 股票名称')this.value='';"
               onblur="javascript:if(this.value=='')this.value='请输入股票代码 或 股票名称';"
        >
    </div>
    </div>
<script>
    $('#search_stock').bind('keypress',function(event){

        if(event.keyCode == "13")
        {
            window.open( '/front/search_stock/' + $('#search_stock').val());
        }

    });
</script>

{{-- 继承后插入的内容 --}}
@yield('content')

{{-- 包含页脚 --}}
@include('front/public/footer')

</body>