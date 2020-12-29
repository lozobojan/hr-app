<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait FileHandling {

    public static function storeFile( $file, $directory = 'unknown' ) {

        if( $file ) {
            //return $request->file($fieldname)->store('images/' . $directory, 'public');

            $destinationPath = '/images/' . $directory . '/';
            $fileName = $file->getClientOriginalName();
            $filenameCover = time() . $fileName;
            $file->move(public_path() . $destinationPath, $filenameCover);
            return $destinationPath . $filenameCover;
        }

        return null;

    }

    public function storeDocument($file){
        $fileNameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename . '_'.time().'.'.$extension;
        $path = $file->storeAs("public/files",$fileNameToStore);
        return str_replace('public', 'storage', $path);
    }

}
