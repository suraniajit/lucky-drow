class CrudOpration {
    constructor() {
      this.grid_content_name = null;
      this.grid_url = null;
      this.filter_data =[];
      this.DisplayColumn =[];
      this.template_id = null;
    }

    setGridContentName(grid_content_name) {
      this.grid_content_name = grid_content_name;
      return this;
    }
    
    getGridContentName() {
         return this.grid_content_name;
    }
    
    setGridUrl(grid_url) {
        this.grid_url = grid_url;
        return this;
    }
    
    getGridUrl() {
        return this.grid_url;
    }
    setGridTemplateId(template_id) {
        this.template_id = template_id;
        return this;
    }
    getGridTemplateId() {
        return this.template_id;
    }
     
    addFilterData(key,value){
        this.filter_data[key] = value;
        return this;
    }
    setFilterDataArray(filter_data){
        this.filter_data = filter_data;
        return this;
    }
    getFilterData(){
        return this.filter_data;
    }

    setDisplayColumn(){
        this.display_column = display_column;
        return this;
    }

    getDisplayColumn(){
        return this.display_column;
    }

    setGridContent(e){
        url = $(e).attr('data-page-url');
        url = (url)?url:this.getGridUrl();
        const api_token  = window.localStorage.getItem('api_token');
        if(isEmpty(this.getFilterData())){
            _searching_data = this.getFilterData();
        }else{
            _searching_data={};
        }
        $.ajax({
            type: 'get',
            url: url,
            data: _searching_data,
            headers: {
                'Authorization': 'Bearer '+ api_token,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: " ",
                clientsecret: " ",
                
            },
            beforeSend: function() {
                $(grid_element).html('loading..');
            },
            success: function(data) {
                $(grid_element).html('');
                if (data.status) {
                    if(data.data.data.length>0){
                       const templ = document.getElementById(this.getGridTemplateId());
                        for (i = 0; i < data.data.data.length; i++) {
                            const clone = templ.content.cloneNode(true);
                            for (var coloum_name in this.getDisplayColumn()) {
                                if(display_column[coloum_name] == 'id'){
                                    clone.querySelector("."+coloum_name).innerHTML = (data.data.per_page * (data.data.current_page-1))+1+i;
                                }
                                if(display_column[coloum_name] == 'text'){
                                    clone.querySelector("."+coloum_name).innerHTML = data.data.data[i][coloum_name];
                                }
                                if(display_column[coloum_name] == 'barcode'){
                                    var barcode_image_src = "https://chart.googleapis.com/chart?cht=qr&chl="+data.data.data[i][coloum_name]+"&chs=160x160&chld=L|0";
                                    clone.querySelector("."+coloum_name).innerHTML = '<img width="100" src="'+barcode_image_src+'">';
                                }
                                if(display_column[coloum_name] == 'qrcode'){
                                    var barcode_image_src = "https://chart.googleapis.com/chart?cht=qr&chl="+data.data.data[i][coloum_name]+"&chs=160x160&chld=L|0";
                                    clone.querySelector("."+coloum_name).innerHTML = '<img width="100" src="'+barcode_image_src+'">';
                                }
                                if(display_column[coloum_name] == 'image'){
                                    clone.querySelector("."+coloum_name).innerHTML = '"<a href="'+data.data.data[i][coloum_name]+'"><img src= "'+data.data.data[i][coloum_name]+'" height="100" ></a>';
                                }
                                if(display_column[coloum_name] == 'date'){
                                    clone.querySelector("."+coloum_name).innerHTML =  data.data.data[i][coloum_name];
                                }
                                if(display_column[coloum_name] == 'view_link'){
                                    clone.querySelector(".view_link").innerHTML = '<a href="'+base_url+'/'+view_link+'?'+link_param+"="+data.data.data[i]['id']+'">view</a>';
                                }
                                if(display_column[coloum_name] == 'action_link'){
                                     action_str = 
                                        '<div class="dropdown show" bis_skin_checked="1">'+
                                            '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'+
                                                '<i class="fas fa-ellipsis-v"></i>'+
                                            '</a>'+
                                        '</div>';
                                    clone.querySelector(".action_link").innerHTML =  action_str;//'<a href='+base_url+"/"+view_link+'?edit">edit</a>';
                                }
                            }
                            $(grid_element).append(clone);
                        }
                        $('#paginate').html(getPaginationLink(data.data));
                    }
                }else{
                    alert('Something Went To Wrong');
                }
                
            },
            error: function(data) {
                alert('Something went wrong!');
            },
        });
        
    } 
}
  