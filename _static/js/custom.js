function autocomplete(inp) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
  		console.log("escribe");
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      cola = document.createElement("div");
      t = document.createElement("h6");
      t.setAttribute("class","list-item-title");
      cola.appendChild(t);
      cola.setAttribute("class", "col-xs-12");
      cola.setAttribute("style", "position: absolute;color:white;z-index: 10;background:black;padding:10px;");
      
      a.appendChild(cola);
      var rval = RegExp(val,'i');
      $.get("/habitantes/nombre="+val ,).done(data=>{      	
      		//if(data.len != document.getElementById("inputVisitado").value.length)return;
      		data.forEach(item => {
 				console.log(item);
	      		b = document.createElement("DIV");
	      		b.classList.add("text-center");
	      		b.innerHTML = item.nombre.substr(0, item.nombre.search(rval));
				b.innerHTML += "<strong>" + val + "</strong>";
				b.innerHTML += item.nombre.substr(item.nombre.search(rval) + val.length);
				b.innerHTML += "<input type='hidden' value='" +   + "'>";
				  b.addEventListener("click", function(e) {
				  inp.value = this.getElementsByTagName("input")[0].value;
				  closeAllLists();
				});
				cola.appendChild(b);
      		});
      });
      flecha = document.createElement("div");
      flecha.setAttribute("class","suggarrow");
      a.appendChild(flecha);
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
autocomplete(document.getElementById("inputVisitado"));






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