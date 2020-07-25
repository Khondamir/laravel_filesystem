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
  <div class="">
    
    <h3 class="login-heading mb-4">Welcome Admin!</h3>
    <div class="card d-flex flex-row ">
        <div class="card-body">
          Welcome {{ ucfirst(Auth()->user()->name) }}

          <a class="small" href="{{url('logout')}}">Logout</a>
        </div>
        <div>Malumotlar
        <form action="{{route('get-info')}}" method="GET">
          <label for="from">Dan:</label><input type="date" name="from_date">
          <label for="from">gacha:</label><input type="date" name="to_date">
          <select class="form-control" name="region_id" id="region_id">
            <option selected="false">Viloyatlar</option>
            {{$regions}}
             @foreach($regions as $region)
              <option name="" id="" value="{{$region->id}}">{{$region->name}}</option>
            @endforeach
          </select>
          <input type="submit" name="submit">
        </form>
        @csrf
        @if(isset($info_data))
        <table class="table">
          <tr><th>Optik(km)</th><th>4G(soni)</th><th>3G</th><th>2G</th><th>Switch</th><th>Hub</th><th>MSAN</th><th>ATS</th></tr>
          <tr><td>{{$info_data['km']}}</td><td>{{$info_data['four']}}</td><td>{{$info_data['three']}}</td><td>{{$info_data['two']}}</td><td>{{$info_data['switch']}}</td><td>{{$info_data['hub']}}</td><td>{{$info_data['msan']}}</td><td>{{$info_data['ats']}}</td></tr>
        </table>
        @endif
        </div>
    </div>

    <table class="table table-bordered table-striped">
     <tr>
      <th>Number</th>
      <th width="">Text</th>
      <th width="">File1</th>
      <th width="">File2</th>
      <th>Status</th>
      <th>Izoh</th>
      <th></th>
      <th></th>
     </tr>
     @foreach($data as $row)
      <tr>
       <td>{{ $row->number }}</td>
       <td>{{ $row->text }}</td>
       <td><a href="{{ URL::to('/') }}/storage/{{ $row->file_path1 }}" class="" width="75">{{ $row->file_path1 }}</a></td>
       <td><a href="{{ URL::to('/') }}/storage/{{ $row->file_path2 }}" class="" width="75">{{ $row->file_path2 }}</a></td>
       <td>{{ $row->status }}</td>
       <form action="{{route('reprocess', $row->id)}}" method="GET">
       <td><input type="text" name="description" id="description"></td>
       <td><button type="submit">Qayta ishlash</button></td></form>
       <td><button><a href="{{url('accept', $row->id  )}}">Qabul qilindi</a></button></td>
      </tr>
     @endforeach
    </table>
    {!! $data->links() !!}

    <table class="table table-bordered table-striped">
     <tr>
      <th width="">File1</th>
      <th width="">File2</th>
      <th width="">File3</th>
      <th width="">Optika Uzunligi (km)</th>
      <th>Texlogiya</th>
      <th>Obyekt turi</th>
      <th>Status</th>
      <th>Izoh</th>
      <th></th>
      <th></th>
     </tr>
     @foreach($second_data as $second_row)
      <tr>
      <td><a href="{{ URL::to('/') }}/storage/{{ $second_row->file_path1 }}" class="" width="">{{ $second_row->file_path1 }}</a></td>
      <td><a href="{{ URL::to('/') }}/storage/{{ $second_row->file_path2 }}" class="" width="">{{ $second_row->file_path2 }}</a></td>
      <td><a href="{{ URL::to('/') }}/storage/{{ $second_row->file_path3 }}" class="" width="">{{ $second_row->file_path3 }}</a></td>
       <td>{{ $second_row->length_optic }}</td>
       <td>{{ $second_row->mobile_technology }}</td>
       <td>{{ $second_row->object_type }}</td>
       <td>{{ $second_row->status }}</td>
       <form action="{{route('reprocess2', $second_row->id)}}" method="GET">
       <td><input type="text" name="description2" id="description2"></td>
       <td><button type="submit">Qayta ishlash</button></td></form>
       <td><button><a href="{{url('accept2', $second_row->id  )}}">Qabul qilindi</a></button></td>
      </tr>
     @endforeach
    </table>


  </div>

 </div>
</body>
</html>
