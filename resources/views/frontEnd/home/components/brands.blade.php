@if (isset($brands) && $brands->count() > 0)
<div class="partener secpadd50" style="background-color: #F5F5F5;"> <!-- Light background -->
  <div class="container">
    <h2 class="text-center" style="margin-top: 0; margin-bottom:10px;">Brands</h2>
    <div class="divider"></div> <!-- Yellow Divider Line -->

    <div class="fp-partner clearfix" style="margin-top:20px;">
      <div class="list-item d-flex flex-wrap justify-content-center">
        @foreach ($brands as $data)
        <div class="partner-item p-2">
          <div class="partner-content text-center">
            <a href="#" target="_self">
              <img src="{{ $data->image ?? '' }}" alt="{{ $data->company_name ?? '' }}">
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<style>
.partner-item img {
  width: 150px;          /* fixed width */
  height: 100px;         /* fixed height */
  object-fit: contain;   /* keep aspect ratio */
  padding: 0;            /* remove extra space */
  border: none;          /* no border */
  background: transparent; /* transparent background */
  box-shadow: none;      /* no shadow */
}

.partner-item {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Yellow divider styling */
.divider {
  width: 100px;
  height: 4px;
  background-color: #FFD700;
  margin: 0 auto;
  border-radius: 2px;
}
</style>
@endif
