@extends('layouts.content')
@section('main-content')
<div class="container">
    <h2>
        PROJEK CRUD LARAVEL
    </h2>
    <div class="text-end mb-5">
        <a href="{{ route('user.create') }}" class="btn btn-primary">Add New User</a>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
 
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($users as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        <div class="showPhoto">
                            <div id="imagePreview" style="@if ($row->photo != '') background-image:url('{{ url('/') }}/uploads/{{ $row->photo }}')@else background-image: url('{{ url('/img/avatar.png') }}') @endif;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href={{ route('user.edit', ['id' => $row->id]) }} class="btn btn-primary"> Edit</a>
                        <button class="btn btn-danger delete-btn" data-user-id="{{ $row->id }}">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No Users Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@include ('admin.modal_delete')
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var userId = $(this).data('user-id');
            $.ajax({
                type: 'POST',
                url: '{{ route("user.delete") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId
                },
                success: function(response) {
                    // Handle success response, misalnya, perbarui tampilan jika perlu
                    console.log(response);
                    // Misalnya, hapus baris pengguna dari tabel:
                    $('button[data-user-id="' + userId + '"]').closest('tr').remove();
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error response, misalnya, tampilkan pesan kesalahan
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endpush
