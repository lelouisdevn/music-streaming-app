@extends('play')
@section('playContent')

<div class="row songs">
  <div class="col-12">
    Liked albums
  </div>
</div>
<div class="row content-genre">
  @foreach ($album as $key => $a)
    <div class="col-3 abc" style="margin: 20px w0px 10em 20px; background-color: grey; height: auto;">
      <a href="{{url('user/album/play/'.$a->AlbumId)}}">
        <img src="{{asset('/Uploads/Images/'.$a->AlbumCover)}}" alt="" style="width: 100%;">
        <p style="height: 50px; color: white; font-size: 18px; overflow-y: hidden;">{{$a->AlbumName}}</p>
        <p style="color: white; font-size: 16px; margin-bottom: 0;">{{$a->AlbumArtist}}</p>
      </a>
      <i class="fa fa-heart library">
        <input type="hidden" value="{{ $a->AlbumId }}" name="aid">
      </i>
    </div>
  @endforeach
</div>


<script>
  $('.fa').on('click', function(){
    var query = $(this).find('input').val();
    var abc = $(this).parent();
    console.log(abc);
    $.ajax({
      context: this,
      url: "{{ route('dlike-album-library') }}",
      method: "POST",
      data:{query:query, _token: "{!! csrf_token() !!}"},
      success:function(data){
        abc.remove();
      }
    });
  })

</script>

@endsection