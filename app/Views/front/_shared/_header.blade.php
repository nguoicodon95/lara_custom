<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <span>{{ $CMSSettings['site_title'] or '' }}</span>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {!! $CMSMenuHtml or '' !!}
            <ul class="nav navbar-nav navbar-right">
                @if(isset($loggedInUser))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">{{ $loggedInUser->getUserName() }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Welcome to our site</li>
                            <li><a href="/user/my-account">My account</a></li>
                            <li><a href="/user/password">Change password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/auth/logout }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/auth/login">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>