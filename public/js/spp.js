$(document).ready(function(){
    // membuat tombol add
    if(role != "kepala"){
        $(".dataTables_length label").before("<button class='btn btn-primary' id='add'>Tambah</button>");
        drKelas = makeDropdownKelas();
        drSiswa = makeDropdownSiswa();
        drPeriode = makeDropdownPeriode();
    }
    
});

let drKelas = "";
let drSiswa = "";
let drPeriode = "";


// ketika tombol tambah ditekan 
$(document).on("click", "#add", function(){
    var id = makeid(10);
    
    $("tbody").prepend(`
        <tr class="tr_${id}">
            <td>${drKelas}</td>
            <td>${drSiswa}</td>
            <td>${drPeriode}</td>
            <td><input type="date" class="form-control tanggal_pembayaran"></td>
            <td><input type="number" class="form-control biaya" readonly></td>
            <td>
                <select class="form-control status">
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas" selected>Belum Lunas</option>
                </select>
            </td>
            <td>
                <button class="btn btn-primary btnSave" id="btnSave_${id}">Simpan</button>
                <button class="btn btn-danger btnCancel" id="btnCancel_${id}">Batal</button>
            </td>
        </tr>
    `);

    var id_kelas = $('.id_kelas').val();
    var getBiayaSpp = 'getSpp/'+ id_kelas;

    $.get(getBiayaSpp, function(data, status){
        $('.biaya').val(data);
    });
});

// ketika tombol cancel di tekan
$(document).on("click", ".btnCancel", function(){
    var classTr = $(this).attr("id").replace("btnCancel_","tr_");
    $("."+classTr).remove();
});

// ketika tombol save ditekan
$(document).on("click", ".btnSave", function(){
    var id = $(this).attr("id").replace("btnSave_","");
    var data = getData(id);
    console.log(data);
    // validasi data sebelum dikirim ke controller

    // aksi buat kirim data ke controller
    $.ajax({
        url : "spp/store",
        type : "POST",
        data : data,
        success:function(respond){
            if(respond.success == true){
                var htmlNewRecore = `
                <tr class="tr_${respond.id}">
                    <td hidden class="id_kelas">${data.id_kelas}</td>
                    <td hidden class="id_siswa">${data.id_siswa}</td>
                    <td hidden class="id_periode">${data.id_periode}</td>
                    <td class="kelas">${data.kelas}</td>
                    <td class="siswa">${data.siswa}</td>
                    <td class="periode">${data.periode}</td>
                    <td class="tanggal_pembayaran">${data.tanggal_pembayaran}</td>
                    <td class="biaya">${data.biaya}</td>
                    <td class="status">${data.status}</td>
                    <td>
                        <button class="btn btn-warning btn-sm btnEdit" id="data_${respond.id}">Edit</button>
                        <button class="btn btn-danger btn-sm btnHapus" id="data_${respond.id}">Hapus</button>
                    </td>
                </tr>
                `;
                $(`tbody`).prepend(htmlNewRecore);
                $('.tr_'+id).remove();
            }else{
                alert('Terjadi kesalahan, mohon cek kembali data yang anda masukkan');
            }
            
        },
        error:function(){
            alert("terjadi kesalahan");
        }
    })
});

function getData(classTr){
    data = new Object();
    data.id = classTr;
    data.id_kelas =  $(`.tr_${classTr} .id_kelas`).val();
    data.kelas = $(`.tr_${classTr} .id_kelas option:selected`).text();
    data.id_siswa =  $(`.tr_${classTr} .id_siswa`).val();
    data.siswa = $(`.tr_${classTr} .id_siswa option:selected`).text();
    data.id_periode =  $(`.tr_${classTr} .id_periode`).val();
    data.periode = $(`.tr_${classTr} .id_periode option:selected`).text();
    data.tanggal_pembayaran =  $(`.tr_${classTr} .tanggal_pembayaran`).val();
    data.biaya =  $(`.tr_${classTr} .biaya`).val();
    data.status =  $(`.tr_${classTr} .status`).val();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}


function getDataFromRecord(classTr){
    data = new Object();
    data.id = classTr;
    data.id_kelas = $(`.tr_${classTr} .id_kelas`).html().trim();
    data.id_siswa = $(`.tr_${classTr} .id_siswa`).html().trim();
    data.id_periode = $(`.tr_${classTr} .id_periode`).html().trim();
    data.tanggal_pembayaran =  $(`.tr_${classTr} .tanggal_pembayaran`).html().trim()
    data.biaya =  $(`.tr_${classTr} .biaya`).html().trim()
    data.status =  $(`.tr_${classTr} .status`).html().trim()
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}

$(document).on("click", ".btnEdit", function(){
    var classTr = $(this).attr("id").replace("data_","");
    var data = getDataFromRecord(classTr);
    console.log(data);

    var htmlFormEdit = `
        <tr class="tr_${data.id} formEdit_${data.id}">
            <td>${drKelas}</td>
            <td>${drSiswa}</td>
            <td>${drPeriode}</td>
            <td><input type="date" class="form-control tanggal_pembayaran" value="${data.tanggal_pembayaran}"></td>
            <td><input type="number" class="form-control biaya" value="${data.biaya}" readonly></td>
            <td>
                <select class="form-control status">
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas" selected>Belum Lunas</option>
                </select>
            </td>
            <td>
                <button class="btn btn-primary btnSaveEdit" id="btnSave_${data.id}">Update</button>
                <button class="btn btn-danger btnCancelEdit" id="btnCancel_${data.id}">Batal</button>
            </td>
        </tr>
        `;
    $(`.tr_${data.id}`).addClass("old");
    $(`.tr_${data.id}`).hide();
    $(`.tr_${data.id}`).before(htmlFormEdit);
    $(`.formEdit_${data.id} td .id_kelas`).val(data.id_kelas).change();
    $(`.formEdit_${data.id} td .id_siswa`).val(data.id_siswa).change();
    $(`.formEdit_${data.id} td .id_periode`).val(data.id_periode).change();
    $(`.formEdit_${data.id} td .status`).val(data.status).change();
});

// cancel edit
$(document).on("click", ".btnCancelEdit", function(){
    var id = $(this).attr("id").replace("btnCancel_","");
    $(`.formEdit_${id}`).remove();
    $(`.tr_${id}`).show();
});

// action update 
$(document).on("click", ".btnSaveEdit", function(){
    var id = $(this).attr("id").replace("btnSave_","");
    var data = getData(id);
    console.log('update',data);
    // validasi data sebelum dikirim ke controller

    // aksi buat kirim data ke controller
    $.ajax({
        url : "spp/update",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${data.id}">
                <td hidden class="id_kelas">${data.id_kelas}</td>
                <td hidden class="id_siswa">${data.id_siswa}</td>
                <td hidden class="id_periode">${data.id_periode}</td>
                <td class="kelas">${data.kelas}</td>
                <td class="siswa">${data.siswa}</td>
                <td class="periode">${data.periode}</td>
                <td class="tanggal_pembayaran">${data.tanggal_pembayaran}</td>
                <td class="biaya">${data.biaya}</td>
                <td class="status">${data.status}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="data_${data.id}">Edit</button>
                    <button class="btn btn-danger btn-sm btnHapus" id="data_${data.id}">Hapus</button>
                </td>
            </tr>
            `;
            $('.formEdit_'+id).after(htmlNewRecore);
            $('.formEdit_'+id).remove();
            $('.tr_'+id + '.old').remove();
            
        },
        error:function(){
            alert("terjadi kesalahan");
        }
    })
});

// hapus data
$(document).on("click", ".btnHapus", function(){
    var id = $(this).attr("id").replace("data_","");
    var data = getData(id);
    if (confirm("Apakah anda yakin ?") == true) {
        $.ajax({
            url : "spp/hapus",
            type : "POST",
            data : data,
            success:function(respond){
                console.log(respond);
                $('.tr_'+id).remove();
            },
            error:function(){
                alert("terjadi kesalahan");
            }
        });
      } else {
      }
    
});

// membuat dropdown kelas
function makeDropdownKelas(){
    var dr = "";
    for(var i = 0; i< kelas.length; i++){
        dr += `<option value='${kelas[i].id}'>${kelas[i].nama_kelas}</option>`;
    }

    dr = `
        <select class="form-control id_kelas">
            ${dr}
        </select>`;

    return dr;
}

// membuat dropdown siswa
function makeDropdownSiswa(){
    var dr = "";
    for(var i = 0; i< siswa.length; i++){
        dr += `<option value='${siswa[i].id}'>${siswa[i].nis} - ${siswa[i].nama}</option>`;
    }

    dr = `
        <select class="form-control id_siswa">
            ${dr}
        </select>`;

    return dr;
}

// membuat dropdown periode
function makeDropdownPeriode(){
    var dr = "";
    for(var i = 0; i< periode.length; i++){
        dr += `<option value='${periode[i].id}'>${periode[i].nama}</option>`;
    }

    dr = `
        <select class="form-control id_periode">
            ${dr}
        </select>`;

    return dr;
}

$(document).on("change", ".id_kelas", function(){
    var id_kelas = $(this).val();
    console.log('id kelas ',id_kelas);
    var getBiayaSpp = 'getSpp/'+ id_kelas;

    $.get(getBiayaSpp, function(data, status){
        $('.biaya').val(data);
        //alert("Data: " + data + "\nStatus: " + status);
    });
});
