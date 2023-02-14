let file = document.getElementById("img1");
let reader = new FileReader();
reader.addEventListener("load", function () {
  file.style.backgroundImage = `url(${ reader.result })`;
}, false);
file.addEventListener('change',function() {
  let image = this.files[0];
  if(image) reader.readAsDataURL(image);
}, false)



let file2 = document.getElementById("img2");
let reader2 = new FileReader();
reader2.addEventListener("load", function () {
  file2.style.backgroundImage = `url(${ reader2.result })`;
}, false);
file2.addEventListener('change',function() {
  let image2 = this.files[0];
  if(image2) reader2.readAsDataURL(image2);
}, false)


let file3 = document.getElementById("img3");
let reader3 = new FileReader();
reader3.addEventListener("load", function () {
  file3.style.backgroundImage = `url(${ reader3.result })`;
}, false);
file3.addEventListener('change',function() {
  let image3 = this.files[0];
  if(image3) reader3.readAsDataURL(image3);
}, false)