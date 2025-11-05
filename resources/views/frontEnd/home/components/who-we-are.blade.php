<!-- WHO WE ARE SECTION START -->
<style>
    /* === Custom Styles for Who We Are Section === */
    .welcom-video p {
        color: black !important;
        font-size: 18px;
        line-height: 1.6;
    }

    .welcom-video .main-color {
        color: #FFD700 !important; /* Deep yellow title */
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .welcom-video .wwrimg {
        border-radius: 12px;
        overflow: hidden;
        height: 300px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .welcom-video .wwrimg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .welcom-video .wwrimg img:hover {
        transform: scale(1.05);
    }
</style>

<div class="welcom-video secpadd">
  <div class="container">
    <div class="row align-items-center">
      <!-- Text Section -->
      <div class="col-sm-6">
        <p class="main-color bigtext margbtm20">Who We Are</p>
        <p class="margbtm20">
          {{ $layout_setting->who_we_are_text ?? 'N/A' }}
        </p>
      </div>

      <!-- Image Section -->
      <div class="col-sm-6">
        <div class="wwrimg margbtm20">
          <img src="{{ asset($layout_setting->who_we_are_image ?? 'images/default/who-we-are.jpg') }}" alt="Who We Are">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- WHO WE ARE SECTION END -->
