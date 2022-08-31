<?php 
    session_start();
    $userLogin = $_SESSION["userLogin"];
?>
@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data SPP</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden>id kelas</th>
                        <th hidden>id siswa</th>
                        <th hidden>id periode</th>
                        <th>kelas</th>
                        <th>siswa</th>
                        <th>periode</th>
                        <th>tanggal bayar</th>
                        <th>biaya</th>
                        <th>status</th>
                        <?php if($userLogin->role != 'kepala'){?>
                            <th>aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="tr_{{$dt->id}}">
                            <td hidden class="id_kelas">{{$dt->id_kelas}}</td>
                            <td hidden class="id_siswa">{{$dt->id_siswa}}</td>
                            <td hidden class="id_periode">{{$dt->id_periode}}</td>
                            <td class="kelas">{{$dt->kelas}}</td>
                            <td class="siswa">{{$dt->nis}} - {{$dt->siswa}}</td>
                            <td class="periode">{{$dt->periode}}</td>
                            <td class="tanggal_pembayaran">{{$dt->tanggal_pembayaran}}</td>
                            <td class="biaya">{{$dt->biaya}}</td>
                            <td class="status">{{$dt->status}}</td>
                            <?php if($userLogin->role != 'kepala'){?>
                                <td>
                                    <button class="btn btn-warning btn-sm btnEdit" id="data_{{$dt->id}}">Edit</button>
                                    <button class="btn btn-danger btn-sm btnHapus" id="data_{{$dt->id}}">Hapus</button>
                                </td>
                            <?php } ?>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="js/spp.js"></script>

<script>
    var role = "<?php echo $userLogin->role; ?>";
    var kelas = <?php echo $kelas ?>;
    var siswa = <?php echo $siswa ?>;
    var periode = <?php echo $periode ?>;
</script>
@endsection