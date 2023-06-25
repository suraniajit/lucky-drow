@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('balance::balance/labels.balance-page-title') !!}
@endsection
@section('page-title')    
{!! __('balance::balance/labels.balance-page-title') !!}
@endsection
@push('css-stack')
@endpush
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-11">   
                        {!! __('balance::balance/labels.balance-page-title') !!}
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('balance::balance/labels.gird-user-name') }}</th>
                        <th scope="col">{{ __('balance::balance/labels.gird-user-mail') }}</th>
                        <th scope="col">{{ __('balance::balance/labels.gird-balance') }}</th>
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
        </div>
        <div class="card">
            <div class="card-body">
                <div id="paginate">
                </div>
            </div>
        </div>
    </div>
    <template id="balance-grid-template">
        <tr>
            <th class="id"></th>
            <td class="user"></td>
            <td class="mail"></td>
            <td class="balance"></td>
            <td class="action"></td>
        </tr>            
    </template>

    @can('admin.balance.deposit')
        <div class="modal fade" id="balance_deposit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{!! __('balance::balance/labels.balance_deposit') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deposit_amount_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.deposit_person') !!}</label>
                                    <input type="text" disabled   name="deposit_user_id" id="deposit_person" class="form-control">
                                    <input type="hidden" id="deposit_person_id" class="form-control">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <div class="form-row" id="deposit_transaction_no_div" style="display:none;">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.transaction_no') !!}</label>
                                    <input type="text" disabled name="deposit_transaction_no" id="deposit_transaction_no" class="form-control">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.balance_amount') !!}</label>
                                    <input type="text" name="deposit_amount" id="deposit_amount" class="form-control" placeholder="{!! __('balance::balance/labels.form-placeolder-deposit-amount') !!}">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <div class="form-row" id="otp_form_group" style="display:none;">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.deposit_OTP') !!}</label>
                                    <input type="text"  id="deposit_otp" name="deposit_otp" class="form-control" placeholder="{!! __('balance::balance/labels.form-placeolder-deposit-otp') !!}">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="deposit_request">{!! __('balance::balance/labels.button_deposit_title') !!}</button>
                        <button type="button" class="btn btn-primary" id="request_otp_varify">{!! __('core::core/labels.button_varify_title') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('admin.balance.withdrawal')
        <div class="modal fade" id="balance_withdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="withdrawalModalLongName">{!! __('balance::balance/labels.balance_withdrawal') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deposit_amount_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.withdrawal_person') !!}</label>
                                    <input type="text" name="user" disabled id="withdrawal_person" class="form-control">
                                    <input type="hidden" id="withdrawal_person_id" >
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                           <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.withdrawal_balance_amount') !!}</label>
                                    <input type="text" name="withdrawal_amount" id="withdrawal_amount" class="form-control" placeholder="{!! __('balance::balance/labels.form-placeolder-withdrawal-amount') !!}">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <div class="form-row" id="transaction_no_div" style="display:none;">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.transaction_no') !!}</label>
                                    <input type="text" disabled name="withdrawal_transaction_no" id="withdrawal_transaction_no" class="form-control">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <div class="form-row" id="withdrawal_otp_form_group" style="display:none;">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('balance::balance/labels.withdrawal_OTP') !!}</label>
                                    <input type="text" name="otp"  id="withdrawal_otp" class="form-control" placeholder="{!! __('balance::balance/labels.form-placeolder-withdrawal-otp') !!}">
                                </div>
                                <div class=" error_div text-danger">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="withdrawal_request">{!! __('balance::balance/labels.button_deposit_title') !!}</button>
                        <button type="button" class="btn btn-primary" id="request_withdrawal_otp_varify">{!! __('core::core/labels.button_varify_title') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan    
@endsection
@push('js-stack')   
   <script>
        const deposit_request_url = "{{route('api.balance.deposit_request')}}";
        const deposit_request_otp_varify_url = "{{route('api.balance.deposit_otp_varify')}}";
        const withdrawal_request_url = "{{route('api.balance.withdrawal_request')}}";
        const withdrawal_request_otp_varify_url = "{{route('api.balance.withdrawal_otp_varify')}}";
    </script>
    <script src="{{asset('modules/themes/backend/js/custome/image.js')}}"></script>
    <script src="{{asset('modules/balance/backend/js/balance_deposit.js')}}"></script>
    <script src="{{asset('modules/balance/backend/js/balance_withdrawal.js')}}"></script>
    <script>
        $( document ).ready(function() {
            loadPageGrid();
        });
        
        // for withdrawal process
       
        // above done
        function loadPageGrid(e){
            url = $(e).attr('data-page-url');
            url = (url)?url:"{{ url('') }}" +'/api/balance/';
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
                            const templ = document.getElementById("balance-grid-template");
                            for (i = 0; i < data.data.length; i++) {
                                const clone = templ.content.cloneNode(true);
                                clone.querySelector(".id").innerHTML =i+1;
                                clone.querySelector(".user").innerHTML =data.data[i].name;
                                clone.querySelector(".mail").innerHTML =data.data[i].email;
                                clone.querySelector(".balance").innerHTML = '<i class="fa fa-inr" aria-hidden="true"></i>  '+data.data[i].balance;
                                var action_str ='<div class="row">';
                                @can('admin.balance.deposit')
                                    var checkedstring = (data.data[i].status_id == 1)?'checked':'';
                                    deposit_button = '';
                                    var deposit_button =   '<button type="button" onClick="openDepositModel(this)"  data-toggle="modal" data-target="#balance_deposit_modal" title="Deposit Balance" data-name="'+data.data[i].name+'" data-id="'+data.data[i].id+'" class="btn btn-info btn-sm" >'+
                                                            '<i class="fa fa-plus" aria-hidden="true"></i>'+
                                                        '</button>';
                                    action_str = action_str +''+deposit_button ;
                                @endcan
                                @can('admin.balance.history')
                                    var history_button = '<a href="{{route('admin.balance.index')}}/history/'+data.data[i].id+'" target="__blank"  title="Balance History" class="btn btn-primary btn-sm">'+
                                                        '<i class="fa fa-history" aria-hidden="true"></i>'+
                                                    '</a>';
                                    action_str = action_str+''+ history_button; 
                                @endcan
                                @can('admin.balance.withdrawal')
                                    var withdrawal_button = '<button type="button"  onClick="openWithdrawalModel(this)" data-toggle="modal" data-target="#balance_withdrawal_modal" title="Withdrawal Balance"  data-name="'+data.data[i].name+'" data-id="'+data.data[i].id+'" class="btn btn-danger btn-sm" >'+
                                                            '<i class="fa fa-minus" aria-hidden="true"></i>'+
                                                        '</button>';
                                    action_str = action_str+''+ withdrawal_button; 
                                @endcan
                                
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