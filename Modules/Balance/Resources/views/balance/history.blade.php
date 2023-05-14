@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('balance::balance/labels.balance-history-page-title') !!}
@endsection
@section('page-title')    
{!! __('balance::balance/labels.balance-history-page-title') !!}
@endsection
@push('css-stack')
<style>
.withdrawal{
    color:red;
}
.deposit{
    color:green;
}

</style>
@endpush
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-11">   
                    {!! __('balance::balance/labels.balance-history-page-title') !!}
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('balance::balance/labels.gird-transaction-id') }}</th>
                            <th scope="col">{{ __('balance::balance/labels.gird-transaction-date') }}</th>
                            <th scope="col">{{ __('balance::balance/labels.gird-transaction-remark') }}</th>
                            <th scope="col">{{ __('balance::balance/labels.gird-transaction-status') }}</th>
                            <th scope="col">{{ __('balance::balance/labels.gird-transaction-amount') }}</th>
                            <th scope="col">{{ __('balance::balance/labels.gird-transaction-affect-balance') }}</th>
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
            <td class="transaction_id"></td>
            <td class="date_time"></td>
            <td class="remark"></td>
            <td class="status"></td>
            <td class="amount"></td>
            <td class="affected_balance"></td>
       </tr>            
    </template>

    
      
@endsection
@push('js-stack')   
   <script>
        $( document ).ready(function() {
            loadPageGrid();
        });
        
        // for withdrawal process
       
        // above done
        function loadPageGrid(e){
            url = $(e).attr('data-page-url');
            url = (url)?url:"{{ url('') }}" +'/api/balance/transaction/{{$id}}';
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
                                console.log(data.data[i]);
                                clone.querySelector(".id").innerHTML =i+1;
                                clone.querySelector(".transaction_id").innerHTML =data.data[i].transaction_id;
                                clone.querySelector(".date_time").innerHTML =data.data[i].date_time;
                                clone.querySelector(".remark").innerHTML =data.data[i].remark;
                                clone.querySelector(".status").innerHTML =data.data[i].status;
                                var transaction_type = (data.data[i].type == 'deposit')?'<i class="fa fa-arrow-down deposit" aria-hidden="true"></i>':'<i class="fa fa-arrow-up withdrawal" aria-hidden="true"></i>';
                                clone.querySelector(".amount").innerHTML = transaction_type +''+ data.data[i].amount;
                                clone.querySelector(".affected_balance").innerHTML =data.data[i].after_amount;
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