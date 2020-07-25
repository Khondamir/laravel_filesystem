<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{url('style.css')}}">
 
</head>
<body>
<div class="container-fluid  d-flex justify-content-center">
  <div class="col-10 col-lg-6 col-xl-5 col-md-9 col-sm-10">
  <h3 class="login-heading m-4">Welcome back!</h3>
     <form action="{{url('post-login')}}" method="POST" id="logForm">

       {{ csrf_field() }}

      <div class="form-label-group">
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" >
        <label for="inputEmail">Email address</label>

        @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
        @endif    
      </div> 

      <div class="form-label-group">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
        <label for="inputPassword">Password</label>
         
        @if ($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
        @endif  
      </div>

      <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign In</button>
      <div class="text-center">If you have an account?
        <a class="small" href="{{url('registration')}}">Sign Up</a></div>
    </form>

  </div>
</div>
 
</body>
</html>