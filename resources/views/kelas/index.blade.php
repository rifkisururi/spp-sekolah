@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama kelas</th>
                        <th>SPP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="tr_{{$dt->id}}">
                            <td class="nama_kelas">{{$dt->nama_kelas}}</td>
                            <td class="spp">{{$dt->spp}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btnEdit" id="data_{{$dt->id}}">Edit</button>
                                <button class="btn btn-danger btn-sm btnHapus" id="data_{{$dt->id}}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nama kelas</th>
                        <th>SPP</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="js/kelas.js"></script>
@endsection