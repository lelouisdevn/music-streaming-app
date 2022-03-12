@extends('Admin/dashboard')
@section('content')

    <div class="title">ALBUM MANAGEMENT</div>
    <div class="row">
        <div class="col add-btn"><a href="{{url('admin/album/add-new-album')}}">Add</a></div>
        <div class="col-11"></div>
    </div>
    <table>
        <tr>
            <td>ID</td>
            <td>Album Name</td>
            <td>Artist</td>
            <td>Description</td>
            <td>Album cover</td>
            <td>Genre</td>
            <td>Edit/Delete</td>
        </tr>
        @foreach ($album as $key => $a)
        <tr class="albumQ">
            <td>{{ $a->AlbumId }}</td>
            <td>{{ $a->AlbumName }}</td>
            <td>{{ $a->AlbumArtist }}</td>
            <td>{{ $a->AlbumDescription }}</td>
            <td><img width="100px" src="{{asset('Uploads/Images/'.$a->AlbumCover)}}"></td>
            <td>{{ $a->GenreName }}</td>
            <td>
              <a href="{{url('/admin/album/details/'.$a->AlbumId)}}"><i class="fa fa-eye" style="margin-right: 10px; color: green; font-size: 20px;"></i></a>
              <a href="{{url('/admin/album/edit/'.$a->AlbumId)}}"><i class="fa fa-edit" style="margin-right: 10px; color: blue; font-size: 20px;"></i></a>
              <a href="{{url('/admin/album/delete/'.$a->AlbumId)}}"
                 onclick="return confirm('Are you sure you want to delete this album?')">
                <i class="fa fa-trash" style="color: crimson; font-size: 20px;"></i></a>
            </td>
        </tr>
        @endforeach
    </table>


    <div>
    {{ $album->links() }}
    </div>
@endsection
