// import "./styles.css";

const input = document.getElementById("image-product");
const image = document.getElementById("img-preview");

input.addEventListener("change", (e) => {
  if (e.target.files.length) {
    const src = URL.createObjectURL(e.target.files[0]);
    image.src = src;
  }
});
