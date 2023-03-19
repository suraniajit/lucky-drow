@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('role::role/labels.role-page-title') !!}
@endsection
@section('page-title')    
    {!! __('role::role/labels.role-page-title') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-11">   
                        {!! __('role::role/labels.role-page-title') !!}
                    </div>
                    <div class="col-sm-1">
                        @can('admin.role.create')
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddRoleModal">+</button>  
                        @endcan
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <!-- table start --><table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Assign User</th>
                    <th scope="col">Action</th>
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
    <template id="role-grid-template">
        <tr>
            <th class="id">1</th>
            <td class="name">Super-Admin</td>
            <td class="user_count">1</td>
            <td class="action">&nbsp;</td>
        </tr>            
    </template>

    @can('admin.role.create')
    <!--  module  template for Add Role -->
        <div class="modal fade" id="AddRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{!! __('role::role/labels.role-form-add') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('role::role/labels.role-form-name') !!}</label>
                                    <input type="text" name="role_name" class="form-control" id="role" placeholder="Please Enter Role Name">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="role_submit">{!! __('core::core/labels.core-form-button-save') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- end module template for add role -->
    @endcan
@endsection
{{--
    @include('page-js')
--}}
@push('js-stack')
    <script>
        $( document ).ready(function() {
            loadPageGrid();
        });

        $('#role_submit').click(function(){
            var token = window.localStorage.getItem('token');
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" +'/api/role/store',
                data: {
                    name: $('#role').val(),
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
                        $('#role').val('');
                        loadPageGrid();
                    }else{

                    }
                },
                error: function(data) {
                    
                },
            });
            $('#AddRoleModal').modal('toggle');
        });
        function loadPageGrid(e){
            url = $(e).attr('data-page-url');
            url = (url)?url:"{{ url('') }}" +'/api/role/';
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
                            clone.querySelector(".name").innerHTML =data.data[i].name;
                            clone.querySelector(".user_count").innerHTML =data.data[i].user_count;
                            @can('admin.role.permission_change')
                            if(data.data[i].name != 'super-admin')
                                    clone.querySelector(".action").innerHTML ='<a href='+url+'><i class="fa fa-cog fa-spin fa-2x fa-fw"></i></a>';
                            else
                                 clone.querySelector(".action").innerHTML ='';
                            @endcan
                            $(".grid-data").append(clone);
                        }
                        $('#paginate').html(data.proparty.link);
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