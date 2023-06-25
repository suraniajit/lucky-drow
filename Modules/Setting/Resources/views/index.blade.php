@extends('themes::layouts.backend.master')
@section('title')    
    {!! config('setting.name') !!}
@endsection
@section('page-title')    
    {!! config('setting.name') !!}
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{!! config('setting.name') !!}</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form id="setting">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Minimum Alert Balance </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    </div>
                                    <input type="number" name="mini_alter_balance" id="mini_alter_balance" class="form-control" data-mask="" inputmode="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tiket Price </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    </div>
                                    <input type="number" name="tiket_price" id="tiket_price" class="form-control" data-mask="" inputmode="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Site Update Time</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <input type="time" id="setting_start_time" name="setting_start_time" class="form-control" data-mask="" inputmode="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <input type="time" id="setting_end_time" name="setting_end_time" class="form-control" data-mask="" inputmode="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Wing Price</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Auto</label>
                                            </div>
                                            <div class="col-md-6">    
                                                <div class="input-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="auto_win_price"  class="custom-control-input role-permission" id="auto_win_price">
                                                        <label class="custom-control-label" for="auto_win_price"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tiket price<span><i class='fa fa-close'></i></span> </label>
                                            </div>
                                            <div class="col-md-6">    
                                                <div class="input-group">
                                                    <input type="number"  name="win_price" id="win_price" class="form-control" data-mask="" inputmode="text">
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Win Quata</label>
                                <div id="quata_area">
                                    <div class="row" >
                                        <div class="col-md-5" id="quata_start">
                                            <div class="input-group">
                                                <input type="number" name="start_quata[]" class="form-control" data-mask="" inputmode="text">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5" id="quata_end">
                                            <div class="input-group">
                                                <input type="number" name="end_quata[]" class="form-control" data-mask="" inputmode="text">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="add_quata"  class="btn btn-block bg-gradient-primary">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stop Booking Before Drow Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="number" name="stop_booking_before" id="stop_booking_before" class="form-control" data-mask="" inputmode="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-md-8">
                    &nbsp;
                </div>    
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block bg-gradient-danger" id="load_default">Cancel</button>
                        </div>    
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block bg-gradient-primary " id="update">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <template id="quata-row-template">
        <div class="row">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="number" name="start_quata[]" class="form-control start_quata_class" data-mask="" inputmode="text">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div><div class="col-md-5">
                <div class="input-group">
                    <input type="number" name="end_quata[]" class="form-control end_quata_class " data-mask="" inputmode="text">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" onclick="removeRow(this)" class="btn btn-block bg-gradient-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>            
    </template>

@endsection
@push('js-stack')
<script src="{{asset('modules/themes/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script>
    $('#add_quata').click(function(){
        const templ = document.getElementById("quata-row-template");
        const clone = templ.content.cloneNode(true);
        $("#quata_area").append(clone);
    });
    function removeRow(btn){
        $(btn).parent().parent().remove()
    }
</script>
<script>
    $(document).ready(function(){
        getSetting();
    });
    function getSetting(){
        var token = window.localStorage.getItem('token');
        $.ajax({
                type: 'get',
                url: "{{ route('api.setting.getSetting') }}",
                data:[],
                headers: {
                    'Authorization': 'Bearer' ,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: " ",
                    clientsecret: " ",
                    'APIAuthKey':token,
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $('#mini_alter_balance').val(data.data.mini_alter_balance);
                        $('#tiket_price').val(data.data.tiket_price);
                        $('#setting_start_time').val(data.data.setting_start_time);
                        $('#setting_end_time').val(data.data.setting_end_time);
                        $('#win_price').val(data.data.win_price);
                        $('#stop_booking_before').val(data.data.stop_booking_before);
                        if(data.data.auto_win_price == 'on'){
                            $('#auto_win_price').prop('checked', true);
                            $('#win_price').attr('disabled',true);
                        }else{
                            $('#auto_win_price').prop('checked', false);
                            $('#win_price').attr('disabled',false);
                        }
                        $("#quata_area").html('');
                        const templ = document.getElementById("quata-row-template");
                        for (i = 0; i < data.data.win_quata.length; i++) {
                            const clone = templ.content.cloneNode(true);
                            clone.querySelector(".start_quata_class").value = data.data.win_quata[i].start_quata;
                            clone.querySelector(".end_quata_class").value = data.data.win_quata[i].end_quata;
                            $("#quata_area").append(clone);
                        }
                    }
                },
                error: function(data) {
                }
            });

    }
    $('#auto_win_price').change(function(){
        if(this.checked) {
            $('#win_price').attr('disabled',true);
        }else{
            $('#win_price').attr('disabled',false); 
        }
       
    });
    $('#update').click(function (){
        var token = window.localStorage.getItem('token');
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" +'/api/setting/update',
                data:$('#setting').serialize(),
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
                        Swal.fire({        
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        getSetting();
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
                }
            });

    })
</script>
@endpush