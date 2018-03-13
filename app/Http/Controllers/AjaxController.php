<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//su dung model category
use App\Category;
//su dung model typenews
use App\Typenews;
//su dung model news
use App\News;

class AjaxController extends Controller
{
    //
    public function getTypenews($id_category)
    {
    	$typenews = Typenews::where('id_category', $id_category)->get();
    	foreach( $typenews as $type)
    	{
    		
            echo "<option value='".$type->id."'>".$type->name."</option>";
            
    		
    	}

    }
}
?>
