<?php 
    session_start();
    $userLogin = $_SESSION["userLogin"];
?>
@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
    </div>
    <div class="card-body">
        <div class="form-inline">
            <div class="form-group mb-2">
                Periode
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Periode</label>
                <select class="form-control" id="periode">
                    @foreach($periode as $dt)
                        <option value={{$dt->id}}>{{$dt->nama}}</option>
                    @endforeach
                </select>
            </div>
            <button id="cari" class="btn btn-primary mb-2">Cari</button>
        </div>

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
                        <th>Cetak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                    <tr class="tr_{{$dt->id}}">
                        <td hidden class="id_kelas">{{$dt->id_kelas}}</td>
                        <td hidden class="id_siswa">{{$dt->id_siswa}}</td>
                        <td hidden class="id_periode">{{$dt->id_periode}}</td>
                        <td class="kelas">{{$dt->kelas}}</td>
                        <td class="siswa">{{$dt->siswa}}</td>
                        <td class="periode">{{$dt->periode}}</td>
                        <td class="tanggal_pembayaran">{{$dt->tanggal_pembayaran}}</td>
                        <td class="biaya">{{$dt->biaya}}</td>
                        <td class="cetak"><button class="btn btn-primary btnCetak" id="{{$dt->id}}">Cetak</button></td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>

    $(document).on("click", "#cari", function(){
        window.location.replace($("#periode").val());
    });

    $(document).on("click", ".btnCetak", function(){
        var id = $(this).attr('id');
        

        window.location.replace('../cetak/'+id);
    });

    

</script>

@endsection