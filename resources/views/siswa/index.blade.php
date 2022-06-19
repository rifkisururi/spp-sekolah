<?php 
    session_start();
    $userLogin = $_SESSION["userLogin"];
?>
@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIS </th>
                        <th>Nama </th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Kelas</th>
                        <th hidden>id_kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="tr_{{$dt->id}}">
                            <td class="nis">{{$dt->nis}}</td>
                            <td class="nama">{{$dt->nama}}</td>
                            <td class="jenis_kelamin">{{$dt->jenis_kelamin}}</td>
                            <td class="alamat">{{$dt->alamat}}</td>
                            <td class="no_hp">{{$dt->no_hp}}</td>
                            <td class="kelas">{{$dt->kelas}}</td>
                            <td class="id_kelas" hidden>{{$dt->id_kelas}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btnEdit" id="data_{{$dt->id}}">Edit</button>
                                <button class="btn btn-danger btn-sm btnHapus" id="data_{{$dt->id}}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot  >
                    <tr>
                        <th>NIS </th>
                        <th>Nama </th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Kelas</th>
                        <th hidden>id_kelas</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="js/siswa.js"></script>
<script>
    var kelas = <?php echo $kelas ?>;
</script>
@endsection