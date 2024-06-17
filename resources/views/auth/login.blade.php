<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> Login Form</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./logstyle.css">

</head>
<body>
<!-- partial:index.partial.html -->

<div class="login-form">
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('message'))
  <div class="alert alert-danger">{{ session('message') }}</div>
@endif
  <div class="text">
    LOGIN
  </div>
  <form method="POST" action="{{route('login') }}">
    @csrf
    <div class="field">
      <div class="fas fa-envelope"></div>
      <input type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
    <div class="field">
      <div class="fas fa-lock"></div>
      <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
  </form>
</div>
<!-- partial -->
  
</body>
</html>