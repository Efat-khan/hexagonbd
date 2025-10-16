<div class="welcom-video secpadd">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <p class="main-color bigtext margbtm20">Who We Are</p>
        <p class="margbtm20">{{ $layout_setting->who_we_are_text??'N/A' }}
        </p>
      </div>
      <div class="col-sm-6">
        <div class="wwrimg margbtm20" style="border-radius: 2%; overflow: hidden; height: 300px;">
          <img src="{{ asset($layout_setting->who_we_are_image ?? 'N/A') }}" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

      </div>
    </div>
  </div>
</div>