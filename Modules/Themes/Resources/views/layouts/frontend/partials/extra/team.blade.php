@push('css-stack')

@endpush
<section class="team-area section-padding-100-0">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="section-heading text-center mb-100">
               <h2>Our Team</h2>
            </div>
         </div>
      </div>
      @foreach($teams as $key=>$team)
         @if($key % 4 == 0 )
         </div>
         <div class="row">
         @endif
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="single-team-member-area mb-100">
                  <div class="team-thumb">
                     <img src="{{asset($team->getPhoto($team->photo))}}" class="team-image" alt="{{$team->name}}">
                  </div>
                  <div class="team-info">
                     <h5>{{$team->name}}</h5>
                     <h6>{{$team->post}}</h6>
                  </div>
               </div>
            </div>
      @endforeach
         </div>
    </div>
</section>
@push('js-stack')

@endpush
