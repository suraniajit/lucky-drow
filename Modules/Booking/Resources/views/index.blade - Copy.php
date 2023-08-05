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
        <div class="form-row symbole_row">
            <div class="form-group col-md-6">
                <label >{!! __('booking::booking/labels.booking_symbole') !!}</label>
                <select class="form-control symbole"  name="symbole[]">
                    <option></option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label >{!! __('booking::booking/labels.booking_count') !!}</label>
                <input type="number" min=1 name="count" class="form-control " value="1">                                
            </div>
            <div class="form-group col-md-2">
                <label >{!! __('booking::booking/labels.booking_total') !!}</label>
                <input type="text" name="mobile" class="form-control " disabled>                                
            </div>
            <div class="col-md-2">
                <label > Action</label>
                <button type="button" onclick="removeRow(this)"  class="form-control btn btn-block bg-gradient-danger">
                    <i class="fa fa-trash"></i>
                </button>
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
                        <form id="show_form">
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
                                <div class="form-row symbole_row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">{!! __('booking::booking/labels.booking_symbole') !!}</label>
                                        <select class="form-control symbole" id="first_symbole_option"  name="symbole[]">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">{!! __('booking::booking/labels.booking_count') !!}</label>
                                        <input type="number" min=1 name="count" class="form-control " value="1">                                
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">{!! __('booking::booking/labels.booking_total') !!}</label>
                                        <input type="text" name="mobile" class="form-control " disabled>                                
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                    <div class="col-md-10">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="add_booking_row"  class="btn btn-block bg-gradient-primary">+</button>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Total</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" disabled value="100">                                
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="show_submit">{!! __('core::core/labels.core-form-button-save') !!}</button>
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
        $('#add_booking_row').click(function(){
            const templ = document.getElementById("tiket-row-template");
            const clone = templ.content.cloneNode(true);
            $("#tiket_detail").append(clone);
        });
        function removeRow(btn){
            $(btn).parent().parent().remove()
        }
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
            beforeSend: function() {},
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
        var element = $('#first_symbole_option');
        getSymbole(element);
       
});
$('.symbole').change(function(e){
    getSymbole($(this).parent().parent().next().find('.symbole'),[]);
    // $(this).parent().parent().next().find('.symbole').html("<option>aa</option>")

});

function getSymbole(element,already_selected=[]){
    var token = window.localStorage.getItem('token'); 
    $.ajax({
        type: 'post',
        url: "{{ url('') }}" +'/api/booking/symbole_list',
        data: {
            'already_selected_syboles':already_selected,
        },
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
                setSymboleElement(data,element);
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
function setSymboleElement(data,element){
    var option_string ='';
    for (i = 0; i < data.data.length; i++) {
        option_string = option_string + '<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>';
    }
    element.html(option_string);
}

</script>
@endpush