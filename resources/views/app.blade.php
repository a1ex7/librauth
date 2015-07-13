<!DOCTYPE html>
<html>
    <head>
        <title>@yield('tittle')</title>
        {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
    </head>

    <body>
        <div class="container">

            <!-- Navigation Menu -->
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">Binary Library</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="{{ URL::to('users') }}">All Users</a></li>
                        <li><a href="{{ URL::to('users/create') }}">Create a User</a></li>
                        <li><a href="{{ URL::to('books') }}">My Books</a></li>
                        <li><a href="{{ URL::to('books/create') }}">Create a Book</a></li>
                    </ul>
                    <div class="nav navbar-nav pull-right">
                        @if (Auth::check())
                            <span class="label label-success">Welcome, {!! Auth::user()->firstname !!}</span>
                            <a href="{{ URL::to('auth/logout') }}" class="btn btn-primary navbar-btn">Logout</a>
                        @else
                            <a href="{{ URL::to('auth/login') }}" class="btn btn-primary navbar-btn">Login</a>
                            <a href="{{ URL::to('auth/register') }}" class="btn btn-primary navbar-btn">Register</a>
                        @endif
                    </div>
                </div>
            </nav>

            <h2> @yield('tittle') </h2>

            <!-- Message Block -->
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <!-- Main Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>