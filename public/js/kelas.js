$(document).ready(function(){
    // membuat tombol add
    $(".dataTables_length label").before("<button class='btn btn-primary' id='add'>Tambah</button>");
});

// ketika tombol tambah ditekan 
$(document).on("click", "#add", function(){
    var id = makeid(10);
    $(".tblBarang tbody").prepend(`
        <tr class="tr_${id}">
            <td><input type="text" class="form-control nama_kelas"></td>
            <td><input type="number" class="form-control spp"></td>
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
        url : "kelas/store",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${respond.id}">
                <td class="nama_kelas">${data.nama_kelas}</td>
                <td class="spp">${data.spp}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="data_${respond.id}">Edit</button>
                    <button class="btn btn-danger btn-sm btnHapus" id="data_${respond.id}">Hapus</button>
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
    data.spp = $(`.tr_${classTr} .spp`).val();
    data.nama_kelas =  $(`.tr_${classTr} .nama_kelas`).val();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}


function getDataFromRecord(classTr){
    data = new Object();
    data.id = classTr;
    data.spp = $(`.tr_${classTr} .spp`).html().trim();
    data.nama_kelas =  $(`.tr_${classTr} .nama_kelas`).html().trim()
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}

$(document).on("click", ".btnEdit", function(){
    var classTr = $(this).attr("id").replace("data_","");
    var data = getDataFromRecord(classTr);
    console.log(data);

    var htmlFormEdit = `
        <tr class="tr_${data.id} formEdit_${data.id}">
            <td><input type="text" class="form-control nama_kelas" value="${data.nama_kelas}"></td>
            <td><input type="text" class="form-control spp" value="${data.spp}"></td>
            <td>
                <button class="btn btn-primary btnSaveEdit" id="btnSave_${data.id}">Update</button>
                <button class="btn btn-danger btnCancelEdit" id="btnCancel_${data.id}">Batal</button>
            </td>
        </tr>
        `;
    $(`.tr_${data.id}`).addClass("old");
    $(`.tr_${data.id}`).hide();
    $(`.tr_${data.id}`).before(htmlFormEdit);
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
        url : "kelas/update",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${data.id}">
                <td class="nama_kelas">${data.nama_kelas}</td>
                <td class="spp">${data.spp}</td>
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
            url : "kelas/hapus",
            type : "POST",
            data : data,
            success:function(respond){
                console.log(respond);
                $('.tr_'+id).remove();
            },
            error:function(){
                alert("terjadi kesalahan");
            }
        })
      } else {
        
    }
    
});