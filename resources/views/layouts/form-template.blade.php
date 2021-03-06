<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html"/>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="{{url('css/index.css')}}"/>
        <link rel="stylesheet" href="{{url('css/forms.css')}}"/>
        <link rel="stylesheet" href="{{url('css/pages.css')}}"/>
        <link rel="icon" href="{{url('imgs/pub/favicon.png')}}"/>
        <link rel="stylesheet" href="{{url('fonts/line-awesome/css/line-awesome-font-awesome.min.css')}}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    @yield('head')
    </head>
    <body>
    <header id="header" class="">
        <div class="logo">
            <a href="{{url('/')}}">
                <img class="img-logo" width="77" height="64" src="{{URL::to('img/logo.png')}}" alt="">
            </a>
        </div><!--  
     --><nav class="collection">
        <ul>
            <li> <a href="{{url('/news')}}">News</a> </li><!--  
         --><li> <a href="{{url('/about')}}">About</a> </li><!--  
         --><li> <a href="{{url('/projects')}}">Projects</a> </li><!--  
         --><li> <a href="{{url('/contact')}}">Contact</a> </li><!--  
         --><li> <a href="{{url('/join')}}">Join</a> </li>
        </ul>
        </nav>
    </header>
    <section class="content-wrapper">
        @yield('body')

    </section>
    @include('layouts.footer')        
       
    </body>
</html>

