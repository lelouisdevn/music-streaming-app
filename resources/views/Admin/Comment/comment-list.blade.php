@extends('Admin/dashboard')
@section('content')

    <div class="title">COMMENT MANAGEMENT</div>
    <table>
        <tr>
            <td>ID</td>
            <td>Member Name</td>
            <td>Comment</td>
            <td>Time</td>
            <td>Edit/Delete</td>
        </tr>
        @foreach ($comment as $key => $c)
        <tr class="albumQ">
            <td>{{ $c->CommentId }}</td>
            <td>{{ $c->UserName }}</td>
            <td style="width: 50%;">{{ $c->CommentContent }}</td>
            <td>{{ $c->CommentTime }}</td>
            <td>
              <a href="{{url('/admin/comment/delete/'.$c->CommentId)}}"
                 onclick="return confirm('Are you sure you want to delete this comment?')">
                <i class="fa fa-trash" style="color: crimson; font-size: 20px;"></i></a>
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        {{ $comment->links() }}
    </div>

@endsection
