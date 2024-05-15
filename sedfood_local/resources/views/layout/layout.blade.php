<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo/HK.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <header>
        @include('layout.header')
    </header>

    <main>
        {{-- phần main sẽ chạy vào trong ruột này --}}
        @yield('content')
    </main>

    <footer>
        @include('layout.footer')
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/api63Tinh.js"></script>
    <script src="js/main.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
//             $(document).ready(function() {
//     $('#coupon-form').submit(function(e) {
//         e.preventDefault();
//         var couponInput = $('#coupon-input').val();
//         $.ajax({
//             type: 'post',
//             url: '{{ route("coupon") }}',
//             data: {
//                 _token: '{{ csrf_token() }}',
//                 name_coupon: couponInput
//             },
//             success: function(response) {
//                 alert("Coupon Name: " + response.couponName);

//                 if (response.success) {
//                     $('#total-amount').html(response.discount + 'đ');
//                     alert(response.message);
//                 } else {
//                     alert(response.message);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 alert('Đã xảy ra lỗi khi áp dụng mã giảm giá. Vui lòng thử lại.');
//             }
//         });
//     });
// });

    </script>
    </body>
    </html>
