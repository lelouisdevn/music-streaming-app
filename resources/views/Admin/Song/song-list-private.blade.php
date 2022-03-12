@extends('Admin/dashboard')
@section('content')


    <div class="title">SONG MANAGEMENT</div>
    <!-- <div class="row">
        <div class="col add-btn"><a href="{{url('admin/song/add-new-single')}}">Add</a></div>
         <div class="col-11"></div>
    </div> -->
    <table>
        <tr>
            <td>ID</td>
            <td>Song Name</td>
            <td>Artist</td>
            <td>Streams</td>
            <td>Edit/Delete</td>
        </tr>
        @foreach ($songs as $key => $s)
        <tr class="albumQ">
            <td>{{ $s->SongId }}</td>
            <td>{{ $s->SongName }}</td>
            <td>{{ $s->SongArtist }}</td>
            <td>{{ $s->SongStream }}</td>
            <td>
              <a href="#"><i class="fa fa-eye" style="margin-right: 10px; color: green; font-size: 20px;"></i></a>
              <a href="{{url('/admin/song/edit/'.$s->SongId)}}"><i class="fa fa-edit" style="margin-right: 10px; color: green; font-size: 20px;"></i></a>
              <a href="#"><i class="fa fa-trash" style="color: crimson; font-size: 20px;"></i></a>
            </td>
        </tr>
        @endforeach
    </table>

    <div>
    {{ $songs->links() }}
    </div>

@endsection
