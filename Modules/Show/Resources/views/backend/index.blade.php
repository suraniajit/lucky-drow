@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('show::show/labels.show-page-title') !!}
@endsection
@section('page-title')    
    {!! __('show::show/labels.show-page-title') !!}
@endsection
@push('css-stack')
@endpush
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-11">   
                        {!! __('show::show/labels.show-page-title') !!}
                    </div>
                    <div class="col-sm-1">
                        @can('admin.show.create')
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_show_modal">+</button>  
                        @endcan
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('show::show/labels.gird-name') }}</th>
                        <th scope="col">{{ __('show::show/labels.gird-time') }}</th>
                        <th scope="col">{{ __('core::core/labels.start-date') }}</th>
                        <th scope="col">{{ __('core::core/labels.end-date') }}</th>
                        <th scope="col">{{ __('core::core/labels.gird-status') }}</th>
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
    <template id="show-grid-template">
        <tr>
            <th class="id"></th>
            <td class="name"></td>
            <td class="time"></td>
            <td class="start_date"></td>
            <td class="end_date"></td>
            <td class="status"></td>
            <td class="action"></td>         
        </tr>            
    </template>

    @can('admin.show.create')
        <div class="modal fade" id="add_show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{!! __('show::show/labels.show-form-add') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="show_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('role::role/labels.role-form-name') !!}</label>
                                    <input type="text" name="show_name" class="form-control" placeholder="Please Enter Show Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('show::show/labels.show-form-time') !!}</label>
                                    <input type="time" name="show_time" class="form-control time-picker" placeholder="Please Enter Show Time">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('show::show/labels.show-form-start_date') !!}</label>
                                    <input type="date" name="start_date" class="form-control date date-picker"  placeholder="Please Enter Show Start Date">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('show::show/labels.show-form-end_date') !!}</label>
                                    <input type="date" name="end_date" class="form-control date date-picker" placeholder="Please Enter Show End Date">
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="card">
                                        <div class="card-body">    
                                            @foreach(getDays() as $key=>$day)
                                            <div class="custom-control custom-switch ">
                                                <input type="checkbox" checked name="day[]" value={{$key}} class="custom-control-input show_status" id="add_day_custome_switch_{{$key}}">
                                                <label class="custom-control-label" for="add_day_custome_switch_{{$key}}">{{$day}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-control custom-switch ">
                                    <input type="checkbox" checked class="custom-control-input show_status" id="add_custom_switch_status" name="status" value="1" >
                                    <label class="custom-control-label" for="add_custom_switch_status">{{ __('core::core/labels.gird-status') }}</label>
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
    @can('admin.show.edit')
        <div class="modal fade" id="edit_show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_show_modal_long_title">{!! __('show::show/labels.show-form-edit') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="show_edit_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('role::role/labels.role-form-name') !!}</label>
                                    <input type="hidden" value="" name="id"  id="data-id">
                                    <input type="text" name="show_name" class="form-control" id="show_name" placeholder="Please Enter Show Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('show::show/labels.show-form-time') !!}</label>
                                    <input type="time" name="show_time" class="form-control time-picker" id="show_time" placeholder="Please Enter Show Time">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('show::show/labels.show-form-start_date') !!}</label>
                                    <input type="date" name="start_date" class="form-control date date-picker" id="start_date" placeholder="Please Enter Show Start Date">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('show::show/labels.show-form-end_date') !!}</label>
                                    <input type="date" name="end_date" class="form-control date date-picker" id="end_date" placeholder="Please Enter Show End Date">
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="card">
                                        <div class="card-body">    
                                            @foreach(getDays() as $key=>$day)
                                            <div class="custom-control custom-switch ">
                                                <input type="checkbox" name="day[]" value={{$key}} class="custom-control-input show_status" id="edit_day_custome_switch_{{$key}}">
                                                <label class="custom-control-label" for="edit_day_custome_switch_{{$key}}">{{$day}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input show_status" name="status" value="1" id="customSwitch_status">
                                    <label class="custom-control-label" for="customSwitch_status">{{ __('core::core/labels.gird-status') }}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="show_update">{!! __('core::core/labels.core-form-button-save') !!}</button>
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
        $('#show_update').click(function(){
            var token = window.localStorage.getItem('token');
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" +'/api/show/update',
                data:$('#show_edit_form').serialize(),
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
                        $('#show_form').trigger("reset");
                        loadPageGrid();
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
                            text: 'Something Went To Wrong',
                            showConfirmButton: false,
                            timer: 1500
                        });
                },
            });
            $('#edit_show_modal').modal('toggle');
        });
        $('#show_submit').click(function(){
            var token = window.localStorage.getItem('token');
                
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" +'/api/show/save',
                data:$('#show_form').serialize(),
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
                        $('#show_form').trigger("reset");
                        loadPageGrid();
                    }else{

                    }
                },
                error: function(data) {
                    
                },
            });
            $('#add_show_modal').modal('toggle');
        });
        function getEditShow(e){
            id = $(e).attr('data-id');
            url = "{{ url('') }}" +'/api/show/edit/'+id;
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
                    console.log(data);
                    if (data.status == 'Success') {
                        $('.show_status').prop('checked', false);
                        $('#data-id').val(data.data.id);
                        $('#show_name').val(data.data.show_name);
                        $('#show_time').val(data.data.show_time);
                        $('#start_date').val(data.data.start_date);
                        $('#end_date').val(data.data.end_date);
                        var show_day = $.parseJSON(data.data.show_day);
                        $(".show_status").prop('checked', false);
                        for(i=0;i<show_day.length;i++){
                            console.log(show_day[i]);
                            $("#edit_day_custome_switch_"+show_day[i]).prop('checked', true);
                        }
                        if(data.data.status==1){
                            $('#customSwitch_status').prop('checked', true);
                        }else{
                            $('#customSwitch_status').prop('checked', false);
                        }
                        $('#edit_show_modal').modal('toggle');
                       
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
        function deleteShow(e){
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {        
                    var id =$(e).attr('data-id');
                    url = "{{ url('') }}" +'/api/show/delete/'+id;
                    var token = window.localStorage.getItem('token'); 
                    $.ajax({
                        type: 'post',
                        url: url,
                        data:{},
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
                                loadPageGrid();
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
            });  
        }
        function updateStatus(e){
            url = "{{ url('') }}" +'/api/show/update_status';
            var token = window.localStorage.getItem('token'); 
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id:$(e).attr('data-id'),
                    status:($(e).prop('checked') == true)?1:2
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
                        Swal.fire({        
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        loadPageGrid();
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
        function loadPageGrid(e){
            url = $(e).attr('data-page-url');
            url = (url)?url:"{{ url('') }}" +'/api/show/';
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
                            const templ = document.getElementById("show-grid-template");
                            for (i = 0; i < data.data.length; i++) {
                                var url = '{{url("/backend/role/permission-manage")}}/'+data.data[i].name;
                                const clone = templ.content.cloneNode(true);
                                clone.querySelector(".id").innerHTML =i+1;
                                clone.querySelector(".name").innerHTML =data.data[i].name;
                                clone.querySelector(".time").innerHTML =data.data[i].time;
                                clone.querySelector(".start_date").innerHTML =data.data[i].start_date;
                                clone.querySelector(".end_date").innerHTML =data.data[i].end_date;
                                clone.querySelector(".status").innerHTML =data.data[i].status;
                                var action_str ='<div class="row">';
                                @can('admin.show.edit')
                                    var checkedstring = (data.data[i].status_id == 1)?'checked':'';
                                    var status_button ='<div class="custom-control custom-switch">'+
                                                            '<input type="checkbox" data-id="'+data.data[i].id+'" '+ checkedstring +' onChange="updateStatus(this)" class="custom-control-input show_grid_status" id="customSwitch'+data.data[i].id+'">'+
                                                            '<label class="custom-control-label" for="customSwitch'+data.data[i].id+'"></label>'+
                                                        '</div>';
                                    action_str = action_str +''+status_button ;
                                    edit_button = '';
                                    var edit_button =   '<button type="button" onClick="getEditShow(this)" data-id="'+data.data[i].id+'" class="btn btn-info btn-sm" >'+
                                                            '<i class="fa fa-pencil" aria-hidden="true"></i>'+
                                                        '</button>';
                                    action_str = action_str +''+edit_button ;
                                @endcan
                                @can('admin.show.delete')
                                    var delete_str = '<button type="button" onclick="deleteShow(this)" class="btn btn-danger btn-sm"  data-id="'+data.data[i].id+'">'+
                                                        '<i class="fa fa-trash" aria-hidden="true"></i>'+
                                                    '</button>';
                                    action_str = action_str+''+ delete_str; 
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