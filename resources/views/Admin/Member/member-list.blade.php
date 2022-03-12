@extends('Admin/dashboard')
@section('content')

    <div class="title">MEMBER MANAGEMENT</div>
    <table>
        <tr>
            <td>ID</td>
            <td>Member Name</td>
            <td>Email</td>
            <td>Join time</td>
            <td>DOB</td>
            <td>Delete</td>
        </tr>
        @foreach ($members as $key => $m)
        <tr class="albumQ">
            <td>{{ $m->UserId }}</td>
            <td>{{ $m->UserName }}</td>
            <td>{{ $m->UserEmail }}</td>
            <td>{{ $m->UserJoinTime }}</td>
            <td>{{ $m->UserDOB }}</td>
            <td>
              <!-- <a href="#"><i class="fa fa-eye" style="margin-right: 10px; color: green; font-size: 20px;"></i></a> -->
              <!-- <a href="{{url('/admin/member/edit/'.$m->UserId)}}"><i class="fa fa-edit" style="margin-right: 10px; color: green; font-size: 20px;"></i></a> -->
              <a href="{{url('/admin/member/delete/'.$m->UserId)}}"
                 onclick="return confirm('Are you sure you want to delete this member?')">
                 <i class="fa fa-trash" style="color: crimson; font-size: 20px;"></i>
               </a>
            </td>
        </tr>
        @endforeach
    </table>

@endsection
