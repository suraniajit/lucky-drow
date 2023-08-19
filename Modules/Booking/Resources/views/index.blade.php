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
                        @can('admin.booking.create')
                            <button type="button" id="add_booking_button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_booking_modal">+</button>  
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
    <template id="tiket-row-template">
        <div class="form-row booking_symbole_div symbole_row ">
            <div class="form-group col-md-3">
                <img src=""  class=" symbole_image" width="100">
                <input type="hidden" name="symbole_id[]" class="symbole_id_hidden_val" >                                
            </div>
            <div class="form-group col-md-3">
                <label class="symbole_label"></label>
                <input type="hidden" class="symbole_price" >                                
            </div>
            <div class="form-group col-md-3">
                <label >{!! __('booking::booking/labels.booking_count') !!}</label>
                <input type="number" min=0  name="symbole_booking_count[]" class="form-control symbole_booking_count " onchange="changeSymboleCount(this);"  value="0">                                
            </div>
            <div class="form-group col-md-3">
                <label >{!! __('booking::booking/labels.booking_total') !!}</label>
                <input type="number"  value="0" class="form-control symbole_booking_count_total" disabled>                                
            </div>
        </div>         
    </template>
    @can('admin.booking.create')
        <div class="modal fade" id="add_booking_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{!! __('booking::booking/labels.add-new-booking') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="book_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('booking::booking/labels.booking-show') !!}</label>
                                    <select class="form-control" id="show_id" name="show_id">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('booking::booking/labels.booking_mobile') !!}</label>
                                    <input type="text" name="mobile" class="form-control " placeholder="{!! __('booking::booking/labels.booking_mobile') !!}">                                
                                </div>
                            </div>
                            <div id="tiket_detail"> 
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Total</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" disabled id="final_total" value="0">                                
                                </div>
                            </div>                         
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="book_submit">{!! __('core::core/labels.core-form-button-save') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

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
<script>

$('#add_booking_button').click(function (){
    
        var token = window.localStorage.getItem('token'); 
       $.ajax({
            type: 'get',
            url: "{{ url('') }}" +'/api/booking/show_list',
            data: {},
            headers: {
                'Authorization': 'Bearer ' ,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: " ",
                clientsecret: " ",
                'APIAuthKey':token,
            },
            beforeSend: function() {
                $('#final_total').val(0);  
            },
            success: function(data) {
                if (data.status == 'Success') {
                    var option_string ='';
                    for (i = 0; i < data.data.length; i++) {
                        option_string = option_string + '<option value="'+data.data[i].id+'">'+data.data[i].time+'</option>';
                    }
                    $('#show_id').html(option_string);
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
        getSymbole();
       
});


function getSymbole(){
    var token = window.localStorage.getItem('token'); 
    $.ajax({
        type: 'get',
        url: "{{ url('') }}" +'/api/booking/symbole_list',
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
                    $("#tiket_detail").html('');
                    const templ = document.getElementById("tiket-row-template");
                    for (i = 0; i < data.data.length; i++) {
                        const clone = templ.content.cloneNode(true);
                        clone.querySelector(".symbole_image").setAttribute('src',data.data[i].file);
                        clone.querySelector(".symbole_id_hidden_val").setAttribute('value',data.data[i].id);
                        clone.querySelector(".symbole_label").innerHTML =data.data[i].name;
                        clone.querySelector(".symbole_price").setAttribute('value',data.data[i].price);
                        $('#tiket_detail').append(clone);   
                    }
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
function changeSymboleCount(event){
    var row = $(event).parent().parent();
    var tiket_price = row.find('.symbole_price').val();
    var tiket_count = $(event).val();
    $('#final_total').val(0);
    row.find('.symbole_booking_count_total').val(tiket_price * tiket_count);
    var all_item = $(".symbole_booking_count_total" );
    all_item.each(function(i,obj){
        var total = parseInt($('#final_total').val()) + parseInt($(obj).val());
        $('#final_total').val(total);
    });
}

$('#book_submit').click(function(){
    swal({
        title: "Are you sure?",
        text: "Once place Order , You Not Able To Change And Delete It!",
        type: "warning",
        showCancelButton: true,
        // confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirm!",
    }).then(result => {
        if (result.value) {
            booking();
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal("Cancelled", "Something went wrong", "error"); 
        }
        
    });
});
function booking(){
    var token = window.localStorage.getItem('token'); 
    $.ajax({
        type: 'post',
        url: "{{ url('') }}" +'/api/booking/save_booking',
        data: $('#book_form').serializeArray(),
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
                swal("Finish!", "Your Booking Successfuly Finsh", "success");
                alert('print data');
            }else{
                swal("Cancelled", "Your imaginary file is safe :)", "error"); 
            }
        },
        error: function(data) {
            swal("Cancelled", "Something went wrong)", "error"); 
            /*
            Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 1500
            });
            */
        },
    });
}
</script>
@endpush