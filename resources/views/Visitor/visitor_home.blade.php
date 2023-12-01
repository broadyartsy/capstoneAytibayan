<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albay Provincial Agricultural Office - Region V</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('visitor.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="\images\APAO logo.png" type="image icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- Font-Awesome Link -->
    <script src="https://kit.fontawesome.com/b530089f5c.js" crossorigin="anonymous"></script>

    <!-- BoxIcons Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- css link -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('Assets/css/visitor.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

    {{-- toastr CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

{{-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| --}}

{{-- 
    Take Backup and Restore in Localhost 
    php artisan config:cache
    php artisan cache:clear
    php artisan view:clear
    php artisan optimize
    --}}

{{-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| --}}

<body>

    <!-- header -->
    <!-- partial:partials/_header.html -->
    @include('Visitor.Body.navbar')
    <!-- header -->


    <!-- Header -->
    @include('Visitor.Body.header')
    <!-- Header -->

    <!-- main content -->
    @yield('visitor')
    <!-- main content -->


    <!-- footer -->
    @include('Visitor.Body.footer')
    <!-- footer -->


    <!-- Apex Charts Library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- custom JS -->
    <script src="{{ asset('Assets/js/visitor.js') }}"></script>
    

    {{-- toastr js --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ", 'Info!', {
                        timeOut: 12000
                    });
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ", 'Success!', {
                        timeOut: 12000
                    });
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ", 'Warning!', {
                        timeOut: 12000
                    });
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ", 'Error!', {
                        timeOut: 12000
                    });
                    break;
            }
        @endif
    </script>

    {{-- Add Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code/code.js') }}"></script>
    <script>
    function openImage(element) {
        var imageUrl = element.querySelector('img').src;

        // Create a modal container
        var modal = document.createElement('div');
        modal.classList.add('image-modal');

        // Create an image element in the modal
        var modalImage = document.createElement('img');
        modalImage.src = imageUrl;
        modal.appendChild(modalImage);

        // Add the modal to the body
        document.body.appendChild(modal);

        // Close the modal when clicking outside the image
        modal.addEventListener('click', function () {
            document.body.removeChild(modal);
        });
    }
</script>
<script>
    var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
    </script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<!-- <script>
    let menuBtn = document.querySelector('#menuBtn');
    let sidebar = document.querySelector('.sidebar');

    menuBtn.onclick = function() {
        sidebar.classList.toggle('active');
    };
</script> -->

</html>
