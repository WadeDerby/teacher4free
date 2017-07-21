<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html"/>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="{{url('css/index.css')}}"/>
        <link rel="stylesheet" href="{{url('css/forms.css')}}"/>
        <link rel="icon" href="{{url('imgs/pub/favicon.png')}}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    @yield('head')
    </head>
    <body>
    <header id="header" class="">
        <div class="logo">
            <img class="img-logo" width="77" height="64" src="{{URL::to('img/logo.png')}}" alt="">
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
    <footer id="footer">
        <p>footer here</p>
    </footer>
       
    </body>
</html>

