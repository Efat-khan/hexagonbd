@extends('frontEnd.layouts.master')

@section('content')
<style>
  .project-documents {
    align-items: center;
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    /* spacing between images */
    justify-content: center;
    /* or center if you prefer */
  }

  .project-documents img {
    width: 250px;
    /* fixed width */
    height: 250px;
    /* fixed height -> square */
    object-fit: cover;
    /* keep proportions but crop */
    border-radius: 10px;
    /* rounded corners */
    margin: 10px 0;
    /* vertical spacing */
    cursor: pointer;
    /* clickable */
    transition: transform 0.3s ease;
  }

  .project-documents img:hover {
    transform: scale(1.05);
    /* zoom effect on hover */
  }
  .image-popup {
    display: none;
    position: fixed;
    z-index: 10000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
}

.image-popup img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.image-popup .close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: white;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
}

</style>
<!-- page-header-->
<div class="page-header title-area">
  <div class="header-title" style="background:url({{asset('images/bg/page-header1.jpg')}})">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title">Gallery</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <nav class="breadcrumb"><span>
              <a class="home" href="{{route('home')}}"><span>Home</span></a>
            </span><i class="fa fa-angle-right" aria-hidden="true"></i>
            <span><span>Gallery</span></span>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- page-header end -->
<div id="content" class="site-content" style="margin-top: 20px; margin-bottom: 20px;">
  <div class="container">
    <div class="row">
      <div id="primary" class="content-area col-md-12">
        <div class="site-main">
          <div class="fp-related-project">
            <div class="project-documents d-flex flex-wrap">
              @if (!empty($mergedImages))
              @foreach ($mergedImages as $key=>$value)
              <img src="{{!empty($value)?asset($value):''}}" alt="Document">
              @endforeach
              @endif
            </div>
            <!-- Image Popup -->
            <div id="imagePopup" class="image-popup">
              <span class="close">&times;</span>
              <img class="popup-content" id="popupImage">
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Image Popup Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const popup = document.getElementById("imagePopup");
    const popupImg = document.getElementById("popupImage");
    const closeBtn = document.querySelector(".image-popup .close");

    document.querySelectorAll(".project-documents img").forEach(img => {
        img.addEventListener("click", function() {
            popup.style.display = "flex";
            popupImg.src = this.src;
        });
    });

    closeBtn.addEventListener("click", function() {
        popup.style.display = "none";
    });

    popup.addEventListener("click", function(e) {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });
});
</script>
<!-- Gallery END -->

@endsection