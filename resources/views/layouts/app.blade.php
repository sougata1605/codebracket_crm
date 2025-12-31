<!DOCTYPE html>
<html>

<head>




  <title>
    @hasSection('title')
    @yield('title') | {{ config('app.name') }}
    @else
    {{ config('app.name') }}
    @endif
  </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="subhas shanta chatterjee"
    referrerpolicy="no-referrer" />

  <style>
    #festivalGreeting {
      font-size: 16px;
      color: #ff9800;
      font-weight: bold;
      text-align: center;
      margin: 20px;
    }

    .balloon {
      width: 20px;
      height: 30px;
      background-color: red;
      border-radius: 50% 50% 50% 50%;
      position: absolute;
      animation: float 5s infinite;
    }

    @keyframes float {
      0% {
        transform: translateY(0) rotate(0deg);
      }

      50% {
        transform: translateY(-300px) rotate(180deg);
      }

      100% {
        transform: translateY(0) rotate(360deg);
      }
    }
  </style>






</head>

<body>

  @include('layouts.header')
  @include('layouts.sidebar')
  @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>