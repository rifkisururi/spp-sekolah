$(document).ready(function(){
    // membuat tombol add
    $(".dataTables_length label").before("<button class='btn btn-primary' id='add'>Tambah</button>");
});

// ketika tombol tambah ditekan 
$(document).on("click", "#add", function(){
    var id = makeid(10);
    var drKelas = makeDropdownKelas();
    $(".tblBarang tbody").prepend(`
        <tr class="tr_${id}">
            <td><input type="text" class="form-control nis"></td>
            <td><input type="text" class="form-control nama"></td>
            <td>
                <select class="form-control jenis_kelamin">
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </td>
            <td><input type="text" class="form-control alamat"></td>
            <td><input type="text" class="form-control no_hp"></td>
            <td>${drKelas}</td>
            <td>
                <button class="btn btn-primary btnSave" id="btnSave_${id}">Simpan</button>
                <button class="btn btn-danger btnCancel" id="btnCancel_${id}">Batal</button>
            </td>
        </tr>
    `);
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
        url : "siswa/store",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${respond.id}">
                <td class="nis">${data.nis}</td>
                <td class="nama">${data.nama}</td>
                <td class="jenis_kelamin">${data.jenis_kelamin}</td>
                <td class="alamat">${data.alamat}</td>
                <td class="no_hp">${data.no_hp}</td>
                <td class="kelas">${data.kelas}</td>
                <td class="id_kelas" hidden>${data.id_kelas}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="data_${respond.id}">Edit</button>
                    <button class="btn btn-danger btn-sm btnHapus" id="data_${respond.id}">Hapus</button>
                    <button class="btn btn-info btn-sm btnKartu" id="data_${respond.id}">Kartu SPP</button>
                </td>
            </tr>
            `;
            $(`tbody`).prepend(htmlNewRecore);
            $('.tr_'+id).remove();
        },
        error:function(){
            alert("terjadi kesalahan");
        }
    })
});

function getData(classTr){
    data = new Object();
    data.id = classTr;
    data.nis = $(`.tr_${classTr} .nis`).val();
    data.nama =  $(`.tr_${classTr} .nama`).val();
    data.jenis_kelamin =  $(`.tr_${classTr} .jenis_kelamin`).val();
    data.alamat =  $(`.tr_${classTr} .alamat`).val();
    data.no_hp =  $(`.tr_${classTr} .no_hp`).val();
    data.id_kelas =  $(`.tr_${classTr} .id_kelas`).val();
    data.kelas = $(`.tr_${classTr} .id_kelas option:selected`).text();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}


function getDataFromRecord(classTr){
    data = new Object();
    data.id = classTr;
    data.nis = $(`.tr_${classTr} .nis`).html().trim();
    data.nama = $(`.tr_${classTr} .nama`).html().trim();
    data.jenis_kelamin = $(`.tr_${classTr} .jenis_kelamin`).html().trim();
    data.alamat = $(`.tr_${classTr} .alamat`).html().trim();
    data.no_hp = $(`.tr_${classTr} .no_hp`).html().trim();
    data.id_kelas = $(`.tr_${classTr} .id_kelas`).html().trim();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}

$(document).on("click", ".btnEdit", function(){
    var classTr = $(this).attr("id").replace("data_","");
    var data = getDataFromRecord(classTr);
    console.log(data);
    var drKelas = makeDropdownKelas();
    var htmlFormEdit = `
        <tr class="tr_${data.id} formEdit_${data.id}">
            <td><input type="text" class="form-control nis" value="${data.nis}"></td>
            <td><input type="text" class="form-control nama" value="${data.nama}"></td>
            <td><input type="text" class="form-control jenis_kelamin" value="${data.jenis_kelamin}"></td>
            <td><input type="text" class="form-control alamat" value="${data.alamat}"></td>
            <td><input type="text" class="form-control no_hp" value="${data.no_hp}"></td>
            <td>${drKelas}</td>
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
        url : "siswa/update",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${data.id}">
                <td class="nis">${data.nis}</td>
                <td class="nama">${data.nama}</td>
                <td class="jenis_kelamin">${data.jenis_kelamin}</td>
                <td class="alamat">${data.alamat}</td>
                <td class="no_hp">${data.no_hp}</td>
                <td class="kelas">${data.kelas}</td>
                <td class="id_kelas" hidden>${data.id_kelas}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="data_${data.id}">Edit</button>
                    <button class="btn btn-danger btn-sm btnHapus" id="data_${data.id}">Hapus</button>
                    <button class="btn btn-info btn-sm btnKartu" id="data_${respond.id}">Kartu SPP</button>
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
            url : "siswa/hapus",
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
        //text = "You canceled!";
      }
    
});

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

$(document).on("click", ".btnKartu", function(){
    var id = $(this).attr("id").replace("data_","");
    window.location.href = "kartu/"+id;
});
