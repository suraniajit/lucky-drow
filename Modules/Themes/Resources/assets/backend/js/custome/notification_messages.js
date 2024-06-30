function pushErrorMessage(title="Error",message="something went to wrong"){
    var notification_str =
        '<div classs="container p-5">'+
            '<div class="row no-gutters fixed-top-right pull-right">'+
                '<div class="alert alert-danger fade show" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="True">&times;</span>'+
                    '</button>'+
                    '<h4 class="alert-heading">'+title +'</h4>'+
                    '<p>'+message+'</p>'+
                '</div>'+
            '</div>'+
        '</div>';
    $(".__notification").append(notification_str);   
   
}

function pushSuccessMessage(title="success",message="success"){
   var notification_str =
    '<div classs="container p-5">'+
        '<div class="row no-gutters fixed-top-right pull-right">'+
            '<div class="alert alert-success fade show" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="True">&times;</span>'+
                '</button>'+
                '<h4 class="alert-heading">'+title +'</h4>'+
                '<p>'+message+'</p>'+
            '</div>'+
        '</div>'+
    '</div>';
    $(".__notification").append(notification_str);   
 }
function pushInfoMessage(title="info",message="success"){
    var notification_str =
    '<div classs="container p-5">'+
        '<div class="row no-gutters fixed-top-right pull-right">'+
            '<div class="alert  alert-info fade show" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="True">&times;</span>'+
                '</button>'+
                '<h4 class="alert-heading">'+title +'</h4>'+
                '<p>'+message+'</p>'+
            '</div>'+
        '</div>'+
    '</div>';
    $(".__notification").append(notification_str);   
}