<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FileInvite</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{url('public/jsplugins/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ url('public/css/dashboard.css')}}">
        <link rel="stylesheet" href="{{ url('public/css/offcanvas.css')}}">
        <link rel="stylesheet" href="{{ url('public/css/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/jsplugins/sweet-alert/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ url('public/css/style.css')}}">
        <script type="text/javascript">
          window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
          window.BaseUrl = "{!! url()->current() !!}";
        </script>

    </head>
    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">FileInvite</a>
        </nav>

        <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Welcome</span>
          </h6>

          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('item')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Items</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('tool')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                GSuite Tool
              </a>
            </li>
          
          </ul>
        </div>
      </nav>

      @yield('content');
    </div>
  </div>

        <script src="{!! url('public/jsplugins/jquery-3.4.1.min.js')!!}"></script>
        <script src="{!! url('public/jsplugins/bootstrap/js/bootstrap.min.js')!!}"></script>
        <script src="{!! url('public/jsplugins/vue.js')!!}"></script>
        <script src="{!! url('public/jsplugins/vee-validate.min.js')!!}"></script>
        <script src="{!! url('public/jsplugins/vue-resource.min.js')!!}"></script>
        <script src="{!! url('public/jsplugins/sweet-alert/sweetalert.min.js')!!}"></script>
        @yield('script')
    </body>
</html>
