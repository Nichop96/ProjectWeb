<?php

namespace ORC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ORC\Http\Controllers\Controller;
use ORC\Category;
use ORC\Survey;
use Charts;

class ChartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $labels = [];
        $values = [];
        
        foreach(Category::all() as $label){
            $labels[$label['id']] = $label['name'];
            $values[$label['id']] = 0;
           
        }
        
        foreach(Survey::all() as $survey){
            $values[$survey['category_id']] += 1;
        }
        
        
        $donut = Charts::create('donut', 'highcharts')
                ->title('My nice chart')
                ->labels($labels)
                ->values($values)
                ->dimensions(1000, 500)
                ->responsive(true);

        return view('admin.index', ['donut' => $donut]);
    }

}
