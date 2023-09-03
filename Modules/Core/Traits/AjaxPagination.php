<?php
namespace Modules\Core\Traits;

trait AjaxPagination
{
    protected function ajaxPaginateLink($model)
    {
        if($model->lastPage() == 1)
            return '';
            $per_page_first_item_number =  ($model->perPage()*($model->currentPage()-1)+1);
            $per_page_last_item_number =  ((($model->perPage()*($model->currentPage()-1)) + ($model->perPage()) ) < $model->total())?($model->perPage()*($model->currentPage()-1)) + ($model->perPage()):$model->total();
            
            $nav_string ='<nav><div class="row"><div class="col-sm-12 col-md-5">';
            $nav_string = $nav_string.'Showing  '.$per_page_first_item_number.' to '.$per_page_last_item_number.' of '.$model->total().' entries';
            $nav_string =$nav_string.'</div><div class="col-sm-12 col-md-7"><div class="paginate_linkes">';
            $nav_string =$nav_string.'<ul class="pagination">';
            if($model->lastPage()>6){
                if($model->currentPage() != 1){
                    $nav_string =$nav_string. '<li class="page-item x"  aria-label="&laquo; Previous">
                                                    <button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->url(1).'" >&lsaquo;&lsaquo;</button>
                                                </li>';
                    $nav_string =$nav_string. '<li class="page-item x"  aria-label="&laquo; Previous">
                                                    <button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->previousPageUrl().'" >&lsaquo;</button>
                                                </li>';
                }
                for($i = $model->currentPage()-1;$i <= $model->currentPage()+2;$i++){
                    if($i==0)
                        continue;
                    if($i>$model->lastPage())
                        break;

                    $is_active = ($model->currentPage()==$i)?'active':'';
                    $nav_string = $nav_string.'<li class="page-item '.$is_active.'">';
                    if($model->currentPage()==$i){
                        $nav_string = $nav_string .'<span class="page-link">'.$i.'</span>';
                    }else{
                        $nav_string = $nav_string.'<button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->url($i).'" >'.$i.'</button>';
                    }
                    $nav_string = $nav_string.'</li>';
                }
                if($model->currentPage() != $model->lastPage()){
                    $nav_string =$nav_string. '<li class="page-item x"  aria-label="&laquo; Previous">
                                                    <button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->nextPageUrl().'" >&gt</button>
                                                </li>';
                    $nav_string =$nav_string. '<li class="page-item x"  aria-label="&laquo; Previous">
                                                    <button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->url($model->lastPage()).'" >&gt;&gt;</button>
                                                </li>';
                }
            }else{
                if($model->currentPage() != 1){
                $nav_string =$nav_string. '<li class="page-item x"  aria-label="&laquo; Previous">
                    <button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->previousPageUrl().'" >&lsaquo;</button>
                </li>';
                }
            for($i = 1;$i <= $model->lastPage();$i++){   
                $is_active = ($model->currentPage()==$i)?'active':'';
                $nav_string = $nav_string.'<li class="page-item '.$is_active.'">';
                if($model->currentPage()==$i){
                    $nav_string = $nav_string .'<span class="page-link">'.$i.'</span>';
                }else{
                    $nav_string = $nav_string.'<button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->url($i).'" >'.$i.'</button>';
                }
                $nav_string = $nav_string.'</li>';
            }
            if($model->currentPage() != $model->lastPage()){
                $nav_string =$nav_string. '<li class="page-item x"  aria-label="&laquo; Previous">
                                                <button onclick="loadPageGrid(this)" class="page-link" data-page-url="'.$model->nextPageUrl().'" >&gt</button>
                                            </li>';
            }
        }
        $nav_string =$nav_string.'</ul></nav>';
        return  $nav_string;
    }
}
