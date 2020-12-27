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
        }, function (error) {
            error("Permiso denegado o error: ", error);
        });
} else {
    alert("Lo siento. Tu navegador no soporta esta característica");
}}
);


	$('.button-photo').click(()=>{

				var video = document.getElementById("video");
				var mediaStream = video.srcObject;
				var tracks = mediaStream.getTracks();
				video.pause();
				tracks.forEach(track => track.stop())
	}
)