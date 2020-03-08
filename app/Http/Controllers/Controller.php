<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function addFile($model, $request, $field_name, $folder, $filename = null){
        if(!isset($model->id)){
            $model->save();
        }
        if(!empty($request->hasFile($field_name))) {
            //Generate filename
            if ($filename == null) {
                $filename = uniqid($model->id . '_') . '.' . $request->$field_name->getClientOriginalExtension();
            }
            //Hapus file lama jika ada
            $oldFile = public_path($folder . '/' . $model->$field_name);
            if (file_exists(public_path($folder . '/' . $filename))) {
                unlink($oldFile);
            }
            //Simpan file upload
            $request->file($field_name)->storeAs('public/'.$folder, $filename);
            $model->$field_name = $filename;
            $model->save();

            return $model;
        }
        return null;
    }
}
