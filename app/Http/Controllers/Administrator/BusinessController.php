<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function add_business()
    {
        $category = Category::where('parent_id', null)->where('is_active', 1)->get();
        return view('administrator.business.index', ['category' => $category]);
    }

    public function fetch_subcat(Request $r)
    {
        $id = $r->id;
        $html['category'] = '';

        if ($id !== null) {

            $query = Category::where('parent_id', $id)->where('is_active', 1)->get();

            if (count($query) > 0) {
                foreach ($query as $item) {

                    $html['category'] .= '<option value="' . $item->id . '">' . $item->name . '</option>';
                }
                echo json_encode($html);
            } else {
                $html['category'] .= '<option value="">Category is not selected</option>';
                echo json_encode($html);
            }
        } else {
            $html['category'] .= '<option value="">Select a category</option>';
            echo json_encode($html);
        }
    }

    public function businesse_create(Request $r)
    {
        $this->validate($r, [
            'cat' => 'required',
            'subcat' => 'required',

            'business_name' => 'required',
            'business_about' => 'required',
            'business_slug' => 'required',
            'business_website' => 'required',

            'business_service_form' => 'required',
            'business_service_to' => 'required',
        ]);

        $obj = new Business();
        $obj->name = $r->business_name;
        $obj->slug  = $r->business_slug;
        $obj->about  = $r->business_about;
        $obj->website  = $r->business_website;
        $obj->service_form = $r->business_service_form;
        $obj->service_to = $r->business_service_to;
        $obj->category_id = $r->subcat;
        $obj->user_id = auth()->user()->id;
        $obj->save();
    }
}


// if (auth()->user()->user_role == 1) {
//     $slug = uniqid();
// } else if (auth()->user()->user_role == 2) {
//     $slug = Str::slug($slugUrl, '_');
// } else {
//     $slug = uniqid();
// }
