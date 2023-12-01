<nav id='menu'>
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>

    <div class="nav-left">
        <div class="nav-title">
            <div class="nav-brand">
                <a href="#" class="apao-logo">
                    <img src="{{ asset('images/APAO-R5.jpg') }}">
                    <span class="nav-item">APAO R-V</span>
                </a>
            </div>

        </div>
    </div>

    <div class="nav-right">
        <ul>
        <li class="{{ request()->is('visitor.home') ? 'active' : '' }}">
            <a href="{{ route('visitor.home') }}" class="scrollToTopButton">Home</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'about' ? 'active' : '' }}">
            <a href='#aboutSection'>About</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'programs' ? 'active' : '' }}">
            <a href='#programsView'>Programs</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
            <a href='#contact'>Contact Us</a>
        </li>
            @if (Route::has('login'))
                @auth
                    @php
                        // Access the authenticated user
                        $user = auth()->user();
                        
                        // Access the role_name using the defined relationship
                        $roleName = $user->role->role_name;
                    @endphp
                    @if ($roleName === 'itstaff')
                        <li><a href="{{ url('/ITStaff/home') }}">Back to Dashboard</a></li>
                    @elseif($roleName === 'binhiprojectcoordinator')
                        <li><a href="{{ url('/BINHI_ProjectCoordinator/home') }}">Back to Dashboard</a></li>
                    @elseif($roleName === 'abakaprojectcoordinator')
                        <li><a href="{{ url('/ABAKA_ProjectCoordinator/home') }}">Back to Dashboard</a></li>
                    @elseif($roleName === 'agripinayprojectcoordinator')
                        <li><a href="{{ url('/AGRIPINAY_ProjectCoordinator/home') }}">Back to Dashboard</a></li>
                    @elseif($roleName === 'akbayprojectcoordinator')
                        <li><a href="{{ url('/AKBAY_ProjectCoordinator/home') }}">Back to Dashboard</a></li>
                    @elseif($roleName === 'leadprojectcoordinator')
                        <li><a href="{{ url('/LEAD_ProjectCoordinator/home') }}">Back to Dashboard</a></li>
                    @elseif($roleName === 'beneficiary')
                        <li><a href="{{ url('/Beneficiary/home') }}">Back to Dashboard</a></li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            @endif
        </ul>
    </div>

</nav>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#navbar a[href^='#']").on('click', function(e) {
        e.preventDefault();

        var targetSection = $(this).attr('href');
        $('html, body').animate({
            scrollTop: targetSection === '#top' ? 0 : $(targetSection).offset().top
        }, 500, 'swing', function() {
            // Highlight the active section after scrolling is complete
            highlightActiveSection();
        });
    });

    function highlightActiveSection() {
    var scrollPosition = $(window).scrollTop();

    // Check each section's offset from the top and highlight the corresponding navigation item
    var highlighted = false;
    $('section').each(function() {
        var sectionId = $(this).attr('id');
        var sectionTop = $(this).offset().top - 50; // Adjusted for better timing
        var sectionBottom = sectionTop + $(this).outerHeight();

        if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
            $('#menu ul li').removeClass('active');
            $('#menu ul li:has(a[href="#' + sectionId + '"])').addClass('active');
            highlighted = true;
        }
    });

    // If no section is currently highlighted, highlight the "Home" link
    if (!highlighted) {
        $('#menu ul li').removeClass('active');
        $('#menu ul li:has(a[href="{{ route('visitor.home') }}"])').addClass('active');
    }
}

// Highlight "Home" link on page load
highlightActiveSection();

// Highlight "Home" link when scrolling or resizing
$(window).on('scroll resize', function() {
    highlightActiveSection();
});
});


</script>
