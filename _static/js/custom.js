
function _getUserMedia(){
	return (navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
}
function tieneSoporteUserMedia(){
	return !!(navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
}

function active_camera(){
if (tieneSoporteUserMedia()) {
    _getUserMedia(
        {video: true},
        function (stream) {

         //   console.log("Permiso concedido");
        	var video = document.getElementById("video");
			video.srcObject  = (stream);
			video.play()
        	$('.info-foto').text("Presione \"Tomar captura\"");
        	$('.button-photo').prop('disabled', false);
        }, function (error) {
            alert("Permiso denegado o error: ", error);
        });
} else {
    alert("El navegador no soporta esta característica");
}
}

if( document.getElementsByClassName('modal').length == 0 &&  document.getElementsByTagName('video').length > 0 ) $('video').ready(active_camera);

	$('.button-photo').click(()=>{
			var text = $('.info-foto').text();
			if(text == "listo"){
						active_camera();
						$('.info-foto').text("Presione \"Tomar captura\"")
						$('.button-photo').text("Tomar captura")
						return;
					}
			var t = setInterval(()=>{
					var text = $('.info-foto').text();

					if(isNaN(text)){
						$('.info-foto').text(3);
					}else {
						text-=1;
						if(text > 0){
						//	alert(text);
							$('.info-foto').text(text)
						}else{
							document.getElementById("captura").classList.add('marco-foto')
							
							setTimeout(function() {
							document.getElementById("captura").classList.remove('marco-foto')
								
							}, 1);
							var video = document.getElementById("video")
							var canvas = document.getElementById("canvas")
							var mediaStream = video.srcObject;
							var tracks = mediaStream.getTracks();
							video.pause();

							tracks.forEach(track => track.stop())
							$('.info-foto').text("listo")
							$('.button-photo').text("Tomar de nuevo")
							$(".btn-form-foto").prop("disabled",false)
							var contexto = canvas.getContext("2d");
							canvas.width = video.videoWidth;
    						canvas.height = video.videoHeight;
    						contexto.drawImage(video, 0, 0, canvas.width, canvas.height);
    						
    					//	console.log(canvas.toDataURL())
    						$("#inputFoto").val(canvas.toDataURL())
    						
							clearInterval(t);
						}
					}
				}
				, 1010);
				
	}
)


$(".save-modal").click(
	() =>{
		f = $("#form-modal").serialize();
		$.ajax({
	  url: $("#form-modal").attr("action"),
	  type: $("#form-modal").attr("method"),
	  data: f,
	  success: function(data) {
	  	console.log(data)
	   	if(data.ok) location.reload();
	   	else alert(data.errorMsj)
	  }
	})
});

function desactive_camera(){
	var video = document.getElementById("video")
	var canvas = document.getElementById("canvas")
	var mediaStream = video.srcObject;
	var tracks = mediaStream.getTracks();
	video.pause();

	tracks.forEach(track => track.stop())
}
$(".btn-add").click(e=>{
	$("#form-modal").attr("method","post");
	$(".key-input").remove();
})

$(".btn-delete").click(e=>{
	$(".btn-aceptar").data({method: "delete",key: $(e.currentTarget).data("key"),model: $(e.currentTarget).data("model")})
	$("#askModal").modal("show");
})

$(".btn-aceptar").click(e=>{
	var a = $(e.currentTarget).data() ;
		$.ajax({
	  url: "./key=" +a.key,
	  type: a.method,
	  success: function(data) {
	  	console.log(data)
	   	if(data.ok) location.reload();
	   	else alert(data.errorMsj)
	  }
	})
  
})

$(".btn-view").click(e=>{
	var a = $(e.currentTarget).data();
	console.log(a.model);
	$.post("/api/" + a.model, a).done(
		data=>{
			Object.keys(data).forEach(a =>{
				if(typeof(data[a]) == 'object'){
					console.log(data[a]);
					var element = "#inputv"+a.charAt(0).toUpperCase()+a.slice(1);
					$(element+'1').val(data[a].ID);
					$.post("/api/" + $(element).data('clase'),
					{ 'key' : $("#"+$(element).attr("entrada")).val() },
					kk => {
						$(element).val(kk.presentation);
						$(element).addClass('input-success');
					});

				}
				else $("#inputv"+a.charAt(0).toUpperCase()+a.slice(1)).val(data[a]);
			});
			$(".image-buffer").each((i,u)=>{
				$(u).attr('src',$('#'+$(u).attr('fuente')).val());
			});
			$('#viewModal').modal('show');
		})
})

$(".btn-edit").click(e=>{
	var a = $(e.currentTarget).data();
	console.log(a);
	$.post("/api/"+a.model, a).done(
		data=>{
			Object.keys(data).forEach(a =>{
				
				if(typeof(data[a]) == 'object'){
					console.log(data[a]);
					var element = "#input"+a.charAt(0).toUpperCase()+a.slice(1);
					$(element+'1').val(data[a].ID);
					$.post("/api/" + $(element).data('clase'),
					{ 'key' : $("#"+$(element).attr("entrada")).val() },
					kk => {
						$(element).val(kk.presentation);
						$(element).addClass('input-success');
					});

				}
				else $("#input"+a.charAt(0).toUpperCase()+a.slice(1)).val(data[a]);

			});
			
			$("#form-modal").attr("method","put")
			$(".key-input").remove()
			var input = document.createElement('input')
			input.type = "hidden"
			input.name = "key"
			input.class = "key-input"
			input.value = a.key;
			$("#form-modal").append(input)
			$('#formModal').modal('show');

			//console.log(data);
		}
	);
});
$(".modal-camara").on('shown.bs.modal', function(){
    active_camera();
  });
$(".modal-camara").on('hide.bs.modal', function(){
    desactive_camera();
  });

$("#formModal").on('reset', function(){
    $("input").removeClass("input-success");
  });
$("#formModal").on('hide.bs.modal', function(){
    document.getElementById("form-modal").reset();
  });