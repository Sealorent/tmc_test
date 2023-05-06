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
                            <form action="{{ route('kabupaten.update', $kabupaten->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        <input type="text" name="nama_kabupaten" class="form-control   @error('nama_kabupaten') is-invalid @enderror" placeholder="Masukkan Nama kabupaten" value="{{ $kabupaten->nama_kabupaten }}">
                                        @error('nama_kabupaten')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <select name="id_provinsi" id="id_provinsi" class="form-control   @error('id_provinsi') is-invalid @enderror" >
                                            @foreach ($provinsi as $prov)
                                                <option value="{{ $prov->id }}" {{ $prov->id == $kabupaten->id_provinsi ? 'selected' : ' ' }}>{{ $prov->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <input type="number" name="jumlah_penduduk" class="form-control  @error('jumlah_penduduk') is-invalid @enderror" placeholder="Masukkan Jumlah Penduduk" value="{{ $kabupaten->jumlah_penduduk }}">
                                        @error('jumlah_penduduk')
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
                window.location = "/kabupaten";
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
                window.location = "/kabupaten";
            }
        }); 
    @endif
</script>
    
@endpush


