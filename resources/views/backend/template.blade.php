<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank BPR Jatim | @yield('title')</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('img/logo/logo-bpr2.png') }}" type="image/x-icon">
  <!-- Custom styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('') }}users-01_files/style.min.css">
</head>

<body>
  <div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">BPR <br> Jatim </span>
                    <span class="logo-subtitle">Dashboard</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="{{Request::segment(2) == 'dashboard' ? 'active' : ''}}" href="{{ url('administrator/dashboard') }}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a class="{{Request::segment(2) == 'user' ? 'active' : ''}}" href="{{ url('administrator/user') }}"><span class="icon user-3" aria-hidden="true"></span>User</a>
                </li>
                
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Posts
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="posts.html">All Posts</a>
                        </li>
                        <li>
                            <a href="new-post.html">Add new post</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon folder" aria-hidden="true"></span>Categories
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="categories.html">All categories</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Media
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="media-01.html">Media-01</a>
                        </li>
                        <li>
                            <a href="media-02.html">Media-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon paper" aria-hidden="true"></span>Pages
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="pages.html">All pages</a>
                        </li>
                        <li>
                            <a href="new-page.html">Add new page</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="comments.html">
                        <span class="icon message" aria-hidden="true"></span>
                        Comments
                    </a>
                    <span class="msg-counter">7</span>
                </li>
            </ul>
            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                <li>
                    <a href="appearance.html"><span class="icon edit" aria-hidden="true"></span>Appearance</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Extentions
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="extention-01.html">Extentions-01</a>
                        </li>
                        <li>
                            <a href="extention-02.html">Extentions-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>Users
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="users-01.html">Users-01</a>
                        </li>
                        <li>
                            <a href="users-02.html">Users-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="##"><span class="icon setting" aria-hidden="true"></span>Settings</a>
                </li>
            </ul>
        </div>
    </div>
    {{-- <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture><source srcset="{{ asset('') }}img/avatar/avatar-illustrated-01.webp" type="image/webp"><img src="{{ asset('') }}img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">Nafisa Sh.</span>
                <span class="sidebar-user__subtitle">Support manager</span>
            </div>
        </a>
    </div> --}}
  </aside>
  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
      <div class="container main-nav">
        <div class="main-nav-start">
        </div>
        <div class="main-nav-end">
          <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
            <span class="sr-only">Toggle menu</span>
            <span class="icon menu-toggle--gray" aria-hidden="true"></span>
          </button>

          <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
            <span class="sr-only">Switch theme</span>
            <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
            <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
          </button>

          <div class="nav-user-wrapper">
            <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
              <span class="sr-only">My profile</span>
              <span class="nav-user-img">
                <picture><source srcset="{{ asset('') }}img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="{{ asset('') }}img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
              </span>
            </button>
            <ul class="users-item-dropdown nav-user-dropdown dropdown">
              {{-- <li><a href="##">
                  <i data-feather="user" aria-hidden="true"></i>
                  <span>Profile</span>
                </a></li> --}}
              <li><a href="##">
                  <i data-feather="key" aria-hidden="true"></i>
                  <span>Ubah Password</span>
                </a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  {{-- <x-dropdown-link :href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Log Out') }}
                    </x-dropdown-link> --}}
                    <a class="danger" :href="route('logout')" onclick="event.preventDefault();
                    this.closest('form').submit();">
                      <i data-feather="log-out" aria-hidden="true"></i>
                      <span>Log out</span>
                    </a>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      @yield('content')
    </main>
    <!-- ! Footer -->
    <footer class="footer">
      <div class="container footer--flex">
        <div class="footer-start">
          <p>2021 © Bank BPR Jawa Timur - <a href="bank-bpr-jatim.com" target="_blank"
              rel="noopener noreferrer">bank-bpr-jatim.com</a></p>
        </div>
        <ul class="footer-end">
          <li><a href="##">About</a></li>
          <li><a href="##">Support</a></li>
          <li><a href="##">Puchase</a></li>
        </ul>
      </div>
    </footer>
  </div>
</div>
<!-- Chart library -->
<script src="{{ asset('plugins/chart.min.js') }}"></script>
<!-- Icons library -->
<script src="{{ asset('plugins/feather.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Custom scripts -->
<script src="{{ asset('js/script.js') }}"></script>
</body>

</html>