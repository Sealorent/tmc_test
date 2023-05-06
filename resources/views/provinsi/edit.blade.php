@extends('template.app')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow ">
                    <div class="card-header">
                        <div class="d-flex  justify-content-between">
                            <h4 class="card-tittle text-primary">{{ ucfirst(Request::segment(1)) }}</h4>
                            {{-- <a href="{{ route('tindakan.create') }}" class="btn  mt-0 btn-primary">
                                <span class="fa-solid fa-plus"></span>&nbsp;Tambah Data
                            </a> --}}
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                            {{-- Create Data --}}
                            <h5 class="text-warning">Edit Data</h5 class="text-warning">
                            <form action="{{ route('provinsi.update', $provinsi->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        <input type="text" name="nama_provinsi" class="form-control   @error('nama_provinsi') is-invalid @enderror" placeholder="Masukkan Nama provinsi" value="{{ $provinsi->nama_provinsi }}">
                                        @error('nama_provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class=" mb-3 col-md-3">
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('extraJS')
 <script>
    function btnDelete(dataId, dataName) {
        let id = dataId;
        let name = dataName;
        // console.log(id, name);
        let url = '{{ route('provinsi.destroy', ':id') }}';
        let urlDelete = url.replace(':id', id);

        $('#data').html(name);
        $('form').attr('action', urlDelete);
    }


    @if (Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ Session::get('success') }}',
        }).then(function (result) {
            if (result.value) {
                window.location = "/provinsi";
            }
        });
    @endif

    @if (Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ Session::get('error') }}',
        }).then(function (result) {
            if (result.value) {
                window.location = "/provinsi";
            }
        }); 
    @endif
</script>
    
@endpush


