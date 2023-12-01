
const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

function toggleNav() {
    const nav = document.querySelector('nav');
    nav.classList.toggle('open');
}
$(document).ready(function() {
    // Hide the name and submenus initially
    $(".sub-menus").hide();

    // Add a click event handler to the image
    $("i img").click(function() {
        // Toggle the visibility of the name and submenus
        $(".sub-menus").toggle();
    });
    $(document).click(function(e) {
    if (!$(e.target).closest("i img").length) {
        // Check if the clicked element is not inside the notification icon
        $(".sub-menus").hide();
    }
});
});
const numbers = document.querySelectorAll('.number');

numbers.forEach(number => {
    const value = parseInt(number.textContent);
    
    if (value >= 1000) {
        number.classList.add('high');
    } else if (value >= 500) {
        number.classList.add('medium');
    } else {
        number.classList.add('low');
    }
});

$(function(){
    $(document).on('click', '#blacklist',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

                            Swal.fire({
                                title: '<span style="color: black;">Are you sure?</span>',
                                text: "Add this user to Blacklist?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#7bb701',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, add to Blacklist!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = link
                                    Swal.fire(
                                        'Done',
                                        'User has been Blacklisted.',
                                        'success'
                                    )
                                }
                            })
    });
});

$(function(){
    $(document).on('click', '#restore',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

                            Swal.fire({
                                title: '<span style="color: black;">Are you sure?</span>',
                                text: "Remove this user from Blacklist?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#7bb701',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, restore user!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = link
                                    Swal.fire(
                                        'Done',
                                        'User has been restored.',
                                        'success'
                                    )
                                }
                            })
    });
});


  

