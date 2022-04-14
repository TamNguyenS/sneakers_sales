const actualBtn = document.getElementById('item-image');

actualBtn.addEventListener('change', function(){
  document.getElementById('image-upload').innerHTML = this.files[0].name;
})

var loadFile = function(event) {
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('review-image');
    output.style.display = "block";
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
};