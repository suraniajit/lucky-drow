@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('role::role/labels.role-permission-page-title') !!}
@endsection
@section('page-title')    
    {!! __('role::role/labels.role-permission-page-title') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-11">   
                        {!! __('role::role/labels.role-permission-page-title') !!} : <b>{{$role_name}}</b>
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <!-- table start -->
                <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Side</th>
                    <th scope="col">Module</th>
                    <th scope="col">Permission</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="grid-data">
                    <tr>
                        <td align="center" colspan="4">No Data Found</th>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="paginate">
                </div>
            </div>
        </div>
    </div>
    <template id="role-grid-template">
        <tr>
            <th class="id">&nbsp;</th>
            <td class="side">&nbsp;</td>
            <td class="module">&nbsp;</td>
            <td class="permission">&nbsp;</td>
            <td class="action">
                
            </td>
        </tr>            
    </template>
@endsection
@push('css-stack')
@endpush
@push('js-stack')
    <script>
        $( document ).ready(function() {
            loadPageGrid();
        });
        $(document).on('change', '.role-permission', function(){ 
            if($(event.srcElement).is(':checked'))
                changePermissionStatus($(event.srcElement).attr('data-permission'),1);
            else
                changePermissionStatus($(event.srcElement).attr('data-permission'),0);
            loadPageGrid()
        });
        
        function changePermissionStatus(permission,flag){
            var token = window.localStorage.getItem('token');
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +'/api/role-permission/{{$role_name}}/'+permission+'/'+flag,
                data: {},
                headers: {
                    'Authorization': 'Bearer ' ,
                    //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
                    }else{
                        Swal.fire({
                            icon: 'error',
                            text: 'Error',
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
            url = (url)?url:"{{ url('') }}" +'/api/role-permission/{{$role_name}}';
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
                        $(".grid-data").html('');
                        const templ = document.getElementById("role-grid-template");
                        for (i = 0; i < data.data.length; i++) {
                            var url = '{{url("/backend/role/permission-manage")}}/'+data.data[i].name;
                            const clone = templ.content.cloneNode(true);
                            clone.querySelector(".id").innerHTML =i+1;
                            var data_arr = data.data[i].name.split('.');
                            clone.querySelector(".side").innerHTML = data_arr[0];
                            clone.querySelector(".module").innerHTML = data_arr[1];
                            clone.querySelector(".permission").innerHTML = data_arr[2];
                            var checkedstring = (data.data[i].status)?'checked':'';
                            clone.querySelector(".action").innerHTML =
                                                                    '<div class="custom-control custom-switch">'+
                                                                        '<input type="checkbox" '+ checkedstring +' data-permission="'+data.data[i].name+'" class="custom-control-input role-permission" id="customSwitch'+data.data[i].id+'">'+
                                                                        '<label class="custom-control-label" for="customSwitch'+data.data[i].id+'"></label>'
                                                                    '</div>';
                            $(".grid-data").append(clone);
                        }
                        $('#paginate').html(data.proparty.link);
                   }else{
                        Swal.fire({
                            icon: 'error',
                            text: 'Error',
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