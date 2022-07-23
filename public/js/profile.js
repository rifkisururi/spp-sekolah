// 
$(document).on("click", "#profile", function(){
    var data = new Object();
    data.id = $("#id").val();
    data.name = $("#name").val();
    data.email = $("#email").val();
    data.password = $("#password").val();
    data.password2 = $("#password2").val();
    data._token = $('meta[name="csrf-token"]').attr('content');

    console.log(data);
    if(data.password != ""){
        // update password
        if(data.password != data.password2){
            alert('password harus sama');
        }else{
            console.log('update password');
            $.ajax({
                url : "updatePassword",
                type : "POST",
                data : data,
                success:function(respond){
                    console.log(respond);
                    alert('profile berhasil di perbarui');
                    document.location.reload();
                },
                error:function(){
                    alert("terjadi kesalahan");
                }
            });
        }
    }else{   
        console.log('update profile');
        $.ajax({
            url : "updateProfile",
            type : "POST",
            data : data,
            success:function(respond){
                alert('profile berhasil di perbarui');
                document.location.reload();
            },
            error:function(){
                alert("terjadi kesalahan");
            }
        });
    }
            
});