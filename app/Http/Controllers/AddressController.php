<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function generateDistrict(Request $request, Province $province)
    {
        $datas = $province->districts;

        $text = "<option value=\"\">- Pilih Kota -</option>";

        foreach ($datas as $key => $data) {
            if ($request->selected_district && $request->selected_district == $data->id) {
                $text .= "<option value=\"".$data->id."\" selected>".$data->name."</option>";
            }else {
                $text .= "<option value=\"".$data->id."\">".$data->name."</option>";
            }

        }

        return $text; 
    }

    public function generateSubdistrict(Request $request, District $district)
    {
        $datas = $district->subdistricts;

        $text = "<option value=\"\">- Pilih Kecamatan -</option>";

        foreach ($datas as $key => $data) {
            if ($request->selected_subdistrict && $request->selected_subdistrict == $data->id) {
                $text .= "<option value=\"".$data->id."\" selected>".$data->name."</option>";
            }else {
                $text .= "<option value=\"".$data->id."\">".$data->name."</option>";
            }

        }

        return $text; 
    }
}
