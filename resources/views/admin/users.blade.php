@extends('layouts.main-admin')

@section('title', 'Admin Users')

@section('content')
<!-- Page Heading -->
<h1>Users Table & Control (On Progress)</h1>

{{-- Main table --}}
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Nomor Telpon</th>
      <th scope="col">Status Admin</th>
      <th scope="col"></th>
      <th scope="col"></th>

    </tr>
  </thead>

  <tbody>
    @foreach($users['data'] as $row)
    <tr>
        <td>{{$row['name']}}</td>
        <td>{{$row['email']}}</td>
        <td>{{$row['phone']}}</td>
        <td>{{$row['is_admin']}}</td>

        <td>
                <form action="{{ route('users.destroy', $row['id']) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <a href="{{ route('users.edit', $row['id']) }}" class=" btn btn-sm btn-primary">Edit</a>
                  <button class="btn btn-sm btn-danger" type="submit"
                    onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                </form>

            
          </td>
      </tr>

    @endforeach
  </tbody>

</table>
<script>
$(document).ready(function()
{
    $('.delete_form').on('submit', function()
    {
        if(confirm("Are you sure you want to delete it?"))
        {
            return true;
        }
        else
        {
            return false;
        }

    });

});
</script>

{{-- Add new User --}}
<div class="d-flex justify-content-center">
  <a class="btn btn-primary justify-content-center"  href = "{{ route('users.create') }}" role="button">Menambah User Baru</a>
</div>

@endsection