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
                        <div class="table-responsive text-nowrap">
                            {{-- Create Data --}}
                            <h5 class="text-warning">Tambah Data</h5 class="text-warning">
                            <form action="{{ route('kabupaten.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        <input type="text" name="nama_kabupaten" value="{{ old('nama_kabupaten') }}" class="form-control   @error('nama_kabupaten') is-invalid @enderror" placeholder="Masukkan Nama Kabupaten">
                                        @error('nama_kabupaten')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <select name="id_provinsi" id="id_provinsi" class="form-control   @error('id_provinsi') is-invalid @enderror" >
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}" {{ old('id_provinsi') == $item->id ? 'selected' : ' ' }} >{{ $item->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk') }}" class="form-control   @error('jumlah_penduduk') is-invalid @enderror" placeholder="Masukkan Jumlah Penduduk">
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
                            {{-- List Data --}}
                            <h5 class="text-warning">List Data Kabupaten</h5>
                            <form action="{{ route('kabupaten.index') }}" method="get">
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        <select name="id_provinsi" id="id_provinsi" class="form-control   @error('id_provinsi') is-invalid @enderror" >
                                            <option value="">--Pilih Provinsi--</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        @error('nama_provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class=" mb-3 col-md-3">
                                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                                        <a href="{{ route('kabupaten.index') }}">
                                            <button  class="btn btn-danger me-2 ">Reset</button>
                                        </a>
                                    </div>
                                </div>
                            </form> 
                            <table class="table table-bordered table-striped" id="provinsiTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kabupaten</th>
                                        <th>Provinsi</th>
                                        <th>Jumlah Penduduk</th>
                                        <th>Opsi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kabupaten as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kabupaten }}</td>
                                            <td>{{ $item->provinsi->nama_provinsi }}</td>
                                            <td>{{ $item->jumlah_penduduk }}</td>
                                            <td>
                                                <a href="{{ route('kabupaten.edit', $item->id) }}">
                                                    <button type="button" class="btn btn-primary btn-icon">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('kabupaten.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn  btn-danger btn-icon">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

    $(function() {
        $('#provinsiTable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            autoWidth: false,
            buttons: [
                {
                    extend: 'print',
                    title: 'Data {{ ucfirst(Request::segment(1)) }}',
                    customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                                );
        
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                    },
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                'colvis'
            ],
        });
    });

    @if (Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ Session::get('success') }}',
        });
    @endif

    @if (Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ Session::get('error') }}',
        });
    @endif
</script>
    
@endpush

