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
  <div>
    <table class="table table-bordered table-striped">
     <tr>
      <th>Number</th>
      <th>Status</th>
      <th>Izoh</th>
      <th>Qo'shimcha</th>
     </tr>
     @foreach($data as $row)
      <tr>
       <td>{{ $row->number }}</td>
       <td>{{ $row->status }}</td>
       <td>{{ $row->description }}</td>
       <td><button><a href="{{url('second-form', $row->id, $row->region_id)}}">Hujjatlar</a></button></td>
      </tr>
     @endforeach
    </table>
  </div>
  <div class="col-10 col-lg-6 col-xl-5 col-md-9 col-sm-10">
   <h3 class="login-heading mb-4">Welcome Dashboard!</h3>
      <div class="card">
          <div class="card-body">
            Welcome {{ ucfirst(Auth()->user()->name) }}
          </div>
          <div class="card-body">
            <a class="small" href="{{url('logout')}}">Logout</a>
          </div>
      </div>

        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
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
            <select class="form-control" name="region_id" id="region_id">
              <option selected="false">Viloyatlar</option>
              {{$regions}}
              @foreach($regions as $region)
                <option name="" id="" value="{{$region->id}}">{{$region->name}}</option>
              @endforeach
            </select>
            <label for="number">Raqam:</label><input type="text" name="number" class="" id="number">
            <label for="text">Tekst:</label><input type="text" name="text" class="" id="text">
            <div class="custom-file">
                <input type="file" name="file_path1" class="custom-file-input" id="file_path1">
                <label class="custom-file-label" for="file_path1">Select file1</label>
            </div>
            <div class="custom-file">
                <input type="file" name="file_path2" class="custom-file-input" id="file_path2">
                <label class="custom-file-label" for="file_path2">Select file2</label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>
        </form>

  </div>
</div>
 
</body>
</html>
