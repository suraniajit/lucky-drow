@extends('themes::layouts.backend.master')
@section('title')    
    {!! config('booking.name') !!}
@endsection
@section('page-title')    
    {!! config('booking.name') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Booking Tikets
            </div>  
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-11">   
                        &nbsp;
                    </div>
                    <div class="col-sm-1">
                        @can('admin.show.create')
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_show_modal">+</button>  
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('booking::booking/labels.booking_id') }}</th>
                            <th scope="col">{{ __('booking::booking/labels.transaction_id') }}</th>
                            <th scope="col">{{ __('booking::booking/labels.show') }}</th>
                            <th scope="col">{{ __('booking::booking/labels.date') }}</th>
                            <th scope="col">{{ __('booking::booking/labels.total') }}</th>
                            <th scope="col">{{ __('booking::booking/labels.mobile') }}</th>
                            <th scope="col">{{ __('booking::booking/labels.booking_by') }}</th>
                            <th scope="col">{{ __('core::core/labels.gird-action') }}</th>
                            </tr>
                        </thead>
                        <tbody class="grid-data">
                            <tr>
                                <td align="center" colspan="4">No Data Found</th>
                            </tr>
                        </tbody>
                    </table>
                    <!-- table end -->
                </div>
                <div class="card-body">
                    <div id="paginate">
                    </div>
                </div> 
            </div>
            <?php
            /*<div class="card-body">
                <div class="mb-3">{!! DNS2D::getBarcodeHTML('https://goo.gl/maps/pMx334XG3gVJxPMs8', 'QRCODE') !!}</div>
                <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div>
                <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</div>
                <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}</div>
                <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'KIX') !!}</div>
                <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'RMS4CC') !!}</div>
                <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>    
            </div>
            */
            ?>
        </div>
    </div>
    <template id="grid-template">
        <tr>
            <th class="id"></th>
            <td class="booking_id"></td>
            <td class="balance_transaction_id"></td>
            <td class="show"></td>
            <td class="date"></td>
            <td class="total"></td>
            <td class="mobile"></td>
            <td class="booking_by"></td>
            <td class="action"></td>         
        </tr>            
    </template>
@endsection
@push('js-stack')
<script>
        $( document ).ready(function() {
            loadPageGrid();
        });
</script>
<script>
    function loadPageGrid(e){
        const loading_url = "{{ url('') }}" +'/api/booking/';
        url = $(e).attr('data-page-url');
        url = (url)?url:loading_url;
        var token = window.localStorage.getItem('token'); 
        $.ajax({
            type: 'get',
            url: url,
            data: {},
            headers: {
                'Authorization': 'Bearer ' ,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: " ",
                clientsecret: " ",
                'APIAuthKey':token,
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    if(data.data.length>0){
                        $(".grid-data").html('');
                        const templ = document.getElementById("grid-template");
                        for (i = 0; i < data.data.length; i++) {
                            const clone = templ.content.cloneNode(true);
                            clone.querySelector(".id").innerHTML =i+1;
                            clone.querySelector(".booking_id").innerHTML =data.data[i].booking_id;
                            clone.querySelector(".balance_transaction_id").innerHTML =data.data[i].balance_transaction_id;
                            clone.querySelector(".show").innerHTML =data.data[i].show;
                            clone.querySelector(".date").innerHTML =data.data[i].date;
                            clone.querySelector(".total").innerHTML =data.data[i].total;
                            clone.querySelector(".mobile").innerHTML =data.data[i].mobile;
                            clone.querySelector(".booking_by").innerHTML =data.data[i].booking_by;
                            var action_str ='<div class="row">';
                            {{--
                            @can('admin.show.delete')
                                var delete_str = '<button type="button" onclick="deleteShow(this)" class="btn btn-danger btn-sm"  data-id="'+data.data[i].id+'">'+
                                                    '<i class="fa fa-trash" aria-hidden="true"></i>'+
                                                '</button>';
                                action_str = action_str+''+ delete_str; 
                            @endcan
                            --}}
                            action_str = action_str+'</div>'; 
                            
                            clone.querySelector(".action").innerHTML = action_str;
                            $(".grid-data").append(clone);
                        }
                        $('#paginate').html(data.proparty.link);
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: 'Something Went To Wrong',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                
            },
            error: function(data) {
                Swal.fire({
                        icon: 'error',
                        text: 'Something went wrong!',
                        showConfirmButton: false,
                        timer: 1500
                        });
            },
        });
    }
</script>
@endpush