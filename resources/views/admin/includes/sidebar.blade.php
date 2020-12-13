<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <h4>{{ config('app.name') }}
            <span class="badge badge-pill badge-success">Admin</span>
        </h4>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="# ">Dashboard</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.users.index') }}" class="c-sidebar-nav-link">User Management</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('logout') }}" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
        </li>
    </ul>
</div>
