<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="css/login.css">

</head>
<body>
  
<!-- partial:index.partial.html -->
<div class="center">
  <div class="ear ear--left"></div>
  <div class="ear ear--right"></div>
  <div class="face">
    <div class="eyes">
      <div class="eye eye--left">
        <div class="glow"></div>
      </div>
      <div class="eye eye--right">
        <div class="glow"></div>
      </div>
    </div>
    <div class="nose">
      <svg width="38.161" height="22.03">
        <path d="M2.017 10.987Q-.563 7.513.157 4.754C.877 1.994 2.976.135 6.164.093 16.4-.04 22.293-.022 32.048.093c3.501.042 5.48 2.081 6.02 4.661q.54 2.579-2.051 6.233-8.612 10.979-16.664 11.043-8.053.063-17.336-11.043z" fill="#243946"></path>
      </svg>
      <div class="glow"></div>
    </div>
    <div class="mouth">
      <svg class="smile" viewBox="-2 -2 84 23" width="84" height="23">
        <path d="M0 0c3.76 9.279 9.69 18.98 26.712 19.238 17.022.258 10.72.258 28 0S75.959 9.182 79.987.161" fill="none" stroke-width="3" stroke-linecap="square" stroke-miterlimit="3"></path>
      </svg>
      <div class="mouth-hole"></div>
      <div class="tongue breath">
        <div class="tongue-top"></div>
        <div class="line"></div>
        <div class="median"></div>
      </div>
    </div>
  </div>
  <div class="hands">
    <div class="hand hand--left">
      <div class="finger">
        <div class="bone"></div>
        <div class="nail"></div>
      </div>
      <div class="finger">
        <div class="bone"></div>
        <div class="nail"></div>
      </div>
      <div class="finger">
        <div class="bone"></div>
        <div class="nail"></div>
      </div>
    </div>
    <div class="hand hand--right">
      <div class="finger">
        <div class="bone"></div>
        <div class="nail"></div>
      </div>
      <div class="finger">
        <div class="bone"></div>
        <div class="nail"></div>
      </div>
      <div class="finger">
        <div class="bone"></div>
        <div class="nail"></div>
      </div>
    </div>
  </div>
  @if(session('success'))
  <div style="background-color: #D1FAE5; color: #047857; font-size: 1rem; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-left: 5px solid #10B981; margin-bottom: 1.5rem; animation: slideIn 0.5s ease-out;">
        {{ session('success') }}
    </div>
@endif
@if ($errors->has('email'))
<div style="background-color: #FEE2E2; color: #B91C1C; font-size: 1rem; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-left: 5px solid #DC2626; margin-bottom: 1.5rem; animation: slideIn 0.5s ease-out;">
        {{ $errors->first('email') }}
    </div>
@endif

@if ($errors->has('password'))
<div style="background-color: #FEE2E2; color: #B91C1C; font-size: 1rem; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-left: 5px solid #DC2626; margin-bottom: 1.5rem; animation: slideIn 0.5s ease-out;">
        {{ $errors->first('password') }}
    </div>
@endif

  <form method="POST" action="/login">
  @csrf
  <div class="login">
    <label>
      <div class="fa fa-envelope"></div>
      <input class="username" type="email" name="email" autocomplete="on" placeholder="john@gmail.com" value="{{ old('email') }}" required />
    </label>
    <label>
      <div class="fa fa-commenting"></div>
      <input class="password" type="password" name="password" autocomplete="off" placeholder="********" required />
      <button class="password-button" type="button">👁️</button>
    </label>
    <button class="login-button" type="submit">Login</button>
  </div>
</form>

  <p class="already-registered">
    Belum punya akun? 
    <a href="/register" class="login-link">Daftar di sini</a>
</p>


<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js'></script><script  src="js/login.js"></script>

</body>
</html>
