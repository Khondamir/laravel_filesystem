<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
<link rel="stylesheet" type="text/css" href="{{url('style.css')}}">
 
</head>
<body>
<div class="container-fluid d-flex justify-content-center">
  <div class="col-10 col-lg-6 col-xl-5 col-md-9 col-sm-10">
   <h3 class="login-heading mb-4">Welcome Second Form!</h3>
      <div class="card">
          <div class="card-body">
           {{$id}} Welcome {{ ucfirst(Auth()->user()->name) }}
          </div>
          <div class="card-body">
            <a class="small" href="{{url('logout')}}">Logout</a>
          </div>
      </div>
  </div>
  <form action="{{route('secondFormUpload', $id)}}" method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5">Upload File</h3>
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
            <div class="custom-file">
                <input type="file" name="file_path1" class="custom-file-input" id="file_path1">
                <label class="custom-file-label" for="file_path1">Select file1</label>
            </div>
            <div class="custom-file">
                <input type="file" name="file_path2" class="custom-file-input" id="file_path2">
                <label class="custom-file-label" for="file_path2">Select file2</label>
            </div>

            <div class="custom-file">
                <input type="file" name="file_path3" class="custom-file-input" id="file_path3">
                <label class="custom-file-label" for="file_path3">Select file3</label>
            </div>

            <label for="length_optic">Uzunligi (km)</label><input type="text" name="length_optic" class="input" id="length_optic">

            <select class="form-control" name="mobile_technology" id="mobile_technology">
              <option selected="false">Mobil aloqa texnologiyasi</option>
              <option name="4g" id="4g" value="4G">4G</option>
              <option name="3g" id="3g" value="3G">3G</option>
              <option name="2g" id="2g" value="2G">2G</option>
            </select>

            <select class="form-control" name="object_type" id="object_type">
              <option selected="false">Obyekt turi</option>
              <option name="Switch" id="Switch" value="Switch">Switch</option>
              <option name="Hub" id="Hub" value="Hub">Hub</option>
              <option name="MSAN" id="MSAN" value="MSAN">MSAN</option>
              <option name="ATS" id="ATS" value="ATS">ATS</option>
            </select>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Yuborish
            </button>
        </form>

</div>
 
</body>
</html>
