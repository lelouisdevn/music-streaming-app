@extends('Admin/dashboard')
@section('content')

    <div class="title">GENRE MANAGEMENT</div>
    <div class="row">
        <div class="col add-btn"><a href="{{url('admin/genre/add-new-genre')}}">Add</a></div>
        <!-- <a href="{{ url('admin/genre/add-new-genre') }}">
          <button type="button" class="btn btn-danger" name="button">Add</button>
        </a> -->
        <div class="col-11"></div>
    </div>
    <table style="margin-bottom: 20px;">
        <tr>
            <td>GenreId</td>
            <td>GenreName</td>
            <td>GenreDescription</td>
            <td>GenreCover</td>
            <td>Edit/Delete</td>
        </tr>
        @foreach ($genre as $key => $g)
        <tr  class="albumQ">
            <td>{{ $g->GenreId }}</td>
            <td>{{ $g->GenreName }}</td>
            <td>{{ $g->GenreDescription }}</td>
            <td><img width="100px" src="{{asset('Uploads/Images/'.$g->GenreCover)}}"></td>
            <td>
              <a href="{{url('/admin/genre/edit/'.$g->GenreId)}}"><i class="fa fa-edit" style="margin-right: 10px; color: green; font-size: 20px;"></i></a>
              <a href="{{url('/admin/genre/delete/'.$g->GenreId)}}"><i class="fa fa-trash" style="color: crimson; font-size: 20px;"></i></a>
            </td>
        </tr>
        @endforeach
    </table>



@endsection
