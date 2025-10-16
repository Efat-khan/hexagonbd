@if (isset($clients) && $clients->count() > 0)
<div class="partener yellowbg secpadd50">
  <div class="container">
    <h2 class="text-center" style="margin-top: 0; margin-bottom:20px;">CLIENTS & PARTNERS</h2>
    <div class="fp-partner clearfix">
      <div class="list-item d-flex flex-wrap justify-content-center">
        @foreach ($clients as $client)
        <div class="partner-item p-2">
          <div class="partner-content text-center">
            <a href="#" target="_self">
              <img src="{{ $client->image ?? '' }}" alt="{{ $client->company_name ?? '' }}">
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
  width: 150px;      /* fixed width */
  height: 100px;     /* fixed height */
  object-fit: contain; /* keeps aspect ratio inside box */
  border: 1px solid #ddd; /* optional: adds border */
  padding: 5px;      /* optional: spacing inside */
  background: #fff;  /* optional: white background */
}
.partner-item {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
@endif