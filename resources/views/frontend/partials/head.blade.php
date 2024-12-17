@php
    $settings = DB::table('settings')->first();
@endphp


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blacktech')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{$settings->favicon}}" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    

    <style>
        #thankYouModal {
          display: flex;
          align-items: center;
          justify-content: center;
          position: fixed;
          inset: 0;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 50;
        }
    
        #mainImage {
          transition: opacity 0.3s ease-in-out;
        }
    
        .opacity-0 {
          opacity: 0;
        }
        .navbar {
          list-style-type: none;
          padding: 0;
          margin: 0;
          position: relative;
        }
    
        .nav-item {
          position: relative;
        }
    
        .nav-link {
          color: #007bff;
          text-decoration: none;
          font-weight: bold;
    
          display: block;
        }
    
        .submenu {
          display: none; /* Initially hidden */
          position: absolute;
          left: 0;
          background: white;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          border-radius: 4px;
          padding: 0;
          list-style-type: none;
        }
    
        .nav-item:hover .submenu {
          display: block; /* Show submenu on hover */
        }
    
        .submenu-item {
          position: relative;
          font-weight: 500;
        }
    
        .submenu-link {
          color: #007bff;
          padding: 10px 15px;
          display: block;
          text-decoration: none;
          border-bottom: 1px solid #e5e5e5; /* Separator line */
        }
    
        .submenu-link:hover {
          background-color: #f5f5f5;
          color: #0056b3; /* Darker shade on hover */
        }
    
        .childmenu {
          display: none; /* Initially hidden */
          position: absolute;
          left: 100%; /* Position to the right of the parent */
          top: 0;
          background: white;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          border-radius: 4px;
          margin-top: 0;
          padding: 5px;
          list-style-type: none;
        }
    
        .submenu-item:hover .childmenu {
          display: block; /* Show childmenu on hover over submenu item */
        }
    
        .childmenu-item {
          position: relative;
        }
    
        .childmenu-link {
          color: #007bff;
          padding: 4px 6px;
          display: block;
          text-decoration: none;
          font-size: 14px;
        }
    
        .childmenu-link:hover {
          background-color: #f5f5f5;
          color: #0056b3; /* Darker shade on hover */
        }
      </style>
    @stack('css')


  </head>
