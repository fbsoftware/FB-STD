<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <style>
  .modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.8);
  justify-content: center;
  align-items: center;
}

.modal-content {
  max-width: 10%;
  max-height: 10%;
  transition: transform 0.3s ease;
  cursor: zoom-in;
}

.modal-content.zoom {
  transform: scale(2);     /* Zoom 2x */
  cursor: zoom-out;
}

  </style>  
  <script>
  const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");
const closeBtn = document.querySelector(".close");

document.getElementById("openModalImg").onclick = () => {
    modal.style.display = "flex";
    modalImg.src = "immagine.jpg";
};

// toggle dello zoom
modalImg.onclick = () => {
    modalImg.classList.toggle("zoom");
};

closeBtn.onclick = () => {
    modal.style.display = "none";
    modalImg.classList.remove("zoom");
};

  </script>
</head>
<body>
  <img src="cactus.jpg" id="openModalImg">

<!-- MODALE -->
<div id="modal" class="modal">
    <span class="close">&times;</span>
    <img id="modalImg" class="modal-content">
</div>
  
</body>
</html>