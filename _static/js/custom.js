function _getUserMedia(){
	return (navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
}
function tieneSoporteUserMedia(){
	return !!(navigator.getUserMedia || (navigator.mozGetUserMedia ||  navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
}

$('#captura').click(()=>{
if (tieneSoporteUserMedia()) {
    _getUserMedia(
        {video: true},
        function (stream) {

            console.log("Permiso concedido");
        	var video = document.getElementById("video");
			video.srcObject  = (stream);
			video.play()
        	$('.info-foto').text("Presione \"Tomar captura\"");
        	$('.button-photo').prop('disabled', false);
        }, function (error) {
            error("Permiso denegado o error: ", error);
        });
} else {
    alert("Lo siento. Tu navegador no soporta esta característica");
}}
);


	$('.button-photo').click(()=>{
			var t = setInterval(()=>{
					var text = $('.info-foto').text();
					if(isNaN(text)){
						$('.info-foto').text(3);
					}else {
						if(text != 0){
						//	alert(text);
							text-=1;
							$('.info-foto').text(text)
						}else{
							var video = document.getElementById("video")
							var canvas = document.getElementById("canvas")
							var mediaStream = video.srcObject;
							var tracks = mediaStream.getTracks();
							video.pause();

							tracks.forEach(track => track.stop())
							$('.info-foto').text("Presione \"Tomar captura\"")
							$(".btn-form-foto").prop("disabled",false)
							var contexto = canvas.getContext("2d");
							canvas.width = video.videoWidth;
    						canvas.height = video.videoHeight;
    						contexto.drawImage(video, 0, 0, canvas.width, canvas.height);
    						console.log(canvas.toDataURL())
    						$("#inputFoto").val(canvas.toDataURL())
							clearInterval(t);
						}
					}
				}
				, 1010);
				
	}
)