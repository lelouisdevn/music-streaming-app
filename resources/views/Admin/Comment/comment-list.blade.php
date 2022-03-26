@extends('Admin/dashboard')
@section('content')

    <div class="title">COMMENT MANAGEMENT</div>
    <table>
        <tr>
            <td>ID</td>
            <td>Member Name</td>
            <td>Song</td>
            <td>Comment</td>
            <td>Time</td>
            <td>Edit/Delete</td>
        </tr>
        @foreach ($comment as $key => $c)
        <tr class="albumQ">
            <td>{{ $c->CommentId }}</td>
            <td>{{ $c->UserName }}</td>
            <td>{{ $c->SongName }}</td>
            <td style="width: 30%;">{{ $c->CommentContent }}</td>
            <td>{{ $c->CommentTime }}</td>
            <td>
                <a href="{{url('/admin/comment/delete/'.$c->CommentId)}}">
                    <i class="fa fa-trash" style="color: crimson; font-size: 20px;"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        {{ $comment->links() }}
    </div>

@endsection
