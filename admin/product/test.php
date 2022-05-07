<style> 
#result{
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  padding: 10px 0;
}

.thumbnail {
  height: 192px;
}
</style>

<!-- <label for="image-product">Select multiple files</label>
<input id="image-product" type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg">


  <output id="result"> </output> -->
  <div id="image-product-upload">

<label for="image-product"> <i class="fas fa-upload"></i>Tải ảnh lên </label>
<input type="file" name="image-product" multiple="multiple" accept="image/jpeg, image/png, image/jpg" id="image-product" hidden>
    <!-- <div class="img-preview" style="height: 400px;"> -->
    <output id="result"></output>
        dsds
    <!-- </div> -->


<br>


<br><br>
</div>




  <script>
      document.querySelector("#image-product").addEventListener("change", (e) => { //CHANGE EVENT FOR UPLOADING PHOTOS
  if (window.File && window.FileReader && window.FileList && window.Blob) { //CHECK IF FILE API IS SUPPORTED
    const files = e.target.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
    const output = document.querySelector("#result");
    output.innerHTML = "";
    for (let i = 0; i < files.length; i++) { // LOOP THROUGH THE FILE LIST OBJECT
        if (!files[i].type.match("image")) continue; // ONLY PHOTOS (SKIP CURRENT ITERATION IF NOT A PHOTO)
        const picReader = new FileReader(); // RETRIEVE DATA URI 
        picReader.addEventListener("load", function (event) { // LOAD EVENT FOR DISPLAYING PHOTOS
          const picFile = event.target;
          const div = document.createElement("div");
          div.innerHTML = `<img class="thumbnail" src="${picFile.result}" title="${picFile.name}"/>`;
          output.appendChild(div);
        });
        picReader.readAsDataURL(files[i]); //READ THE IMAGE
    }
  } else {
    alert("Your browser does not support File API");
  }
});
  </script>