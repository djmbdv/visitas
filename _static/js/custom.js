
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
		$("#form-modal").submit();
	}
);
function desactive_camera(){
	var video = document.getElementById("video")
	var canvas = document.getElementById("canvas")
	var mediaStream = video.srcObject;
	var tracks = mediaStream.getTracks();
	video.pause();

	tracks.forEach(track => track.stop())
}

$(".modal-camara").on('shown.bs.modal', function(){
    active_camera();
  });
$(".modal-camara").on('hide.bs.modal', function(){
    desactive_camera();
  });