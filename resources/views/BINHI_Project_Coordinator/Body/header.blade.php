<header class="header">
    <div class="menu-icon" id="btn">
        <span class="material-icons-outlined">menu_open</span>
    </div>
    <input type="checkbox" class="toggle-sidebar" id="toggle-sidebar">
    <label for="toggle-sidebar" class="toggle-icon">
        <div class="bar-top"></div>
        <div class="bar-center"></div>
        <div class="bar-bottom"></div>
    </label>
    <div class="header-left">
        <span class="material-icons-outlined">search</span>
        <input type="search" id="search" name="search" placeholder="Search">
    </div>
    <div class="header-right">
        <a href="#">
            <span class="material-icons-outlined">notifications</span>
        </a>
        <a href="{{url('programs_view')}}">
            <span class="material-icons-outlined">Programs</span>
        </a>
        <a href="{{ url('contacts') }}">
            <span class="material-icons-outlined">Contacts</span>
        </a>
        <a href="#">
            <span class="material-icons-outlined">login</span>
        </a>

    </div>
</header>
