<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteForm" method="post">
                @csrf
                <input type="hidden" name="user_id" id="delete_id">
                <div>
                    <center>
                        <h1>!</h1>
                    </center>
                </div>
 
                <div class="modal-body">
                    <center>
                        <h1>Are You Sure?</h1>
                        <h6>You want to Delete the user!</h6>
                    </center>
                </div>
                <div class="row" style="margin-bottom: 50px; text-align: center;">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-danger btn-modal" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-success btn-modal" id="confirmDelete">Delete</button>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        $('#confirmDelete').click(function() {
            var userId = $('#delete_id').val();
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
                    // Tutup modal setelah berhasil menghapus
                    $('#modalDelete').modal('hide');
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error response, misalnya, tampilkan pesan kesalahan
                    console.error(xhr.responseText);
                    // Tutup modal jika terjadi kesalahan
                    $('#modalDelete').modal('hide');
                }
            });
        });
    });
</script>
@endpush
