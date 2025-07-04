<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="assets/css/styles.css">

  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <title>Login</title>
</head>

<body>
  <div class="l-form">
    <div class="shape1"></div>
    <div class="shape2"></div>
    @if ($errors->any())
    <div id="alert" class="alert">
      <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="form">
      <img src="assets/img/authentication.svg" alt="" class="form__img">

      <form method="POST" action="{{route('login') }}">
        @csrf
        <h1 class="form__title">Welcome</h1>

        <div class="form__div form__div-one">
          <div class="form__icon">
            <i class='bx bx-user-circle'></i>
          </div>

          <div class="form__div-input">
            <label for="" class="form__label">Email</label>
            <input type="text" name="email" class="form__input">
          </div>
        </div>

        <div class="form__div">
          <div class="form__icon">
            <i class='bx bx-lock'></i>
          </div>

          <div class="form__div-input">
            <label for="" class="form__label">Password</label>
            <input type="password" name="password" class="form__input">
          </div>
        </div>
        <input type="submit" class="form__button" value="Login">
      </form>
    </div>

  </div>
  <script src="assets/js/main.js"></script>
</body>

</html>