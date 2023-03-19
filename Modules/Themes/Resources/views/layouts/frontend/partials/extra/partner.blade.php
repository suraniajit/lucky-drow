
@push('css-stack')
<link rel="stylesheet" href="{{asset('modules/themes/frontend/css/patner_slider.css')}}">
@endpush
<div class="container">
   <div class="row">
      <div class="col-12">
         <!-- Section Heading -->
         <div class="section-heading text-center mb-100 wow fadeInUp" data-wow-delay="100ms">
               <div class="line"></div>
               <p>Take look at our</p>
               <h2>Our Clients</h2>
         </div>
      </div>
   </div>
   <section class="customer-logos slider">
   @foreach($partners as $partner)
      <div class="slide">
         @if($partner->logo != null && file_exists(public_path($partner->getLogo($partner->logo))))
            <img src="{{asset($partner->getLogo($partner->logo))}}">
         @endif
      </div>
      
   @endforeach     
   </section>
</div>       
@push('js-stack')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src="{{asset('modules/themes/frontend/js/custom/partner_slider.js')}}"></script>
@endpush
