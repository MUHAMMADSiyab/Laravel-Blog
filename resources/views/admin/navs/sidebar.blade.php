<button class="sidebar-toggler d-md-none d-lg-none">
    <span class="material-icons"> menu </span>
</button>

<div class="col-md-2 col-lg-2 col-sm-12 col-12 sidebar hidden-sm">

    <header class="sidebar-header">
        <a href="#" class="app-name">
            <span class="d-block main__name">{{ config('APP_NAME') }}</span>
        </a>
    </header>

    <div class="sidebar-wrapper">
        <ul class="nav nav-pills flex-column" id="main__nav">

            <li class="nav-item{{ $activePage === 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li
                class="nav-item 
                            {{ $activePage === 'posts' || $activePage === 'post_add' || $activePage === 'post_edit' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#posts" aria-expanded="false">
                    <i class="material-icons">dynamic_feed</i>
                    <p>{{ __('Posts') }}
                        <i class="material-icons v-middle float-right down-arrow">keyboard_arrow_down</i>
                    </p>
                </a>
                <div class="collapse {{ $activePage === 'posts' || $activePage === 'post_add' || $activePage === 'post_edit' ? ' show' : '' }}"
                    id="posts">
                    <ul class="nav nav-pills flex-column submenu">
                        <li class="nav-item {{ $activePage === 'post_add' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.posts.create') }}">
                                <i class="material-icons arrow">navigate_next</i>
                                <p>{{ __('Add Post') }}</p>
                            </a>
                        </li>


                        <li
                            class="nav-item {{ $activePage === 'posts' || $activePage === 'post_edit' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.posts.index') }}">
                                <i class="material-icons arrow">navigate_next</i>
                                <p>{{ __('Manage Posts') }}</p>
                            </a>
                        </li>



                    </ul>
                </div>
            </li>


        </ul>
    </div>
</div>
