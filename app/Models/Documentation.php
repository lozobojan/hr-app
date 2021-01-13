<?php

namespace App\Models;

use App\Traits\FileHandling;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Documentation extends Model
{
    use HasFactory, \RecursiveRelationships\Traits\HasRecursiveRelationships, FileHandling;

    protected $table = 'documentations';

    public $primaryKey = "id";
    protected $guarded = [];

    public function showTree(){
        
        $descendents = $this->descendents();
        $return = '<li>';

        if($this->is_folder){
            $return = $return . '<span class="btn btn-outline-primary"><i class="fas fa-folder"></i>&nbsp&nbsp'. $this->name. '</span>&nbsp&nbsp
            <a href="#" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus" data-id="'.$this->id.'"></i>
            </a>
            &nbsp&nbsp<a><i class="text-danger fas fa-folder-minus" data-id="'. $this->id .'"></i></a>';
        }
        
        if($this->is_folder == 0){
            $return = $return . '
            <a href="/'.$this->file_path.'" target="_blank"><span class="btn-outline-success"><i class="fas fa-file"></i>
            &nbsp&nbsp'. $this->name.'</span></a>
            &nbsp&nbsp<a href="/directory/download/'.$this->id.'"><i class="text-success fas fa-download"></i></a>
            &nbsp&nbsp<i class="text-danger fas fa-trash-alt" data-id="'. $this->id .'"></i>
            ';
        }

        if(count($descendents)){
            $return = $return . '<ul>';
            for($i = 0; $i < count($descendents); $i++){
                if($descendents[$i]->parent_id == $this->id){
                    $return = $return . $descendents[$i]->showTree();
                }
            }
            $return = $return . '</ul>';
        }

        return $return . '</li>' ;
    }

}
