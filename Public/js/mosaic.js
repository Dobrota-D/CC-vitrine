var modal = document.getElementById("myModal");

var imgs = document.getElementsByClassName("mosaicImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

for (let i = 0; i < imgs.length; i++) {
    var img = imgs[i];
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
}

var spans = document.getElementsByClassName("close");
for(var i = 0; i < spans.length; i++) {
            var span = spans[i];
            span.onclick = function() {
                modal.style.display = "none";
            }
} 