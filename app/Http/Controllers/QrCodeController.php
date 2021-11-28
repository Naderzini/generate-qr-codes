<?php

namespace App\Http\Controllers;

use App\Repositories\QrCodeRepository;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use File;
use ZipArchive;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function generate(Request $request){
    foreach($request->names as $name){
        $image = \QrCode::format('png')
                 ->size(200)
                 ->generate($name);
        $output_file= $name . time() . '.png';
        Storage::disk('public')->put($output_file,$image); 
        }
    }
    public function downloadZip()
    {
        $zip = new ZipArchive;
   
        $fileName = 'myNewFile.zip';
   
        $files = File::files(public_path('storage'));
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        if(File::exists(public_path('storage'))){
            foreach ($files as $file) {
                Storage::disk('public')->delete('app/public/' . basename($file));
            }
        }
        return response()->download(public_path($fileName));  
    }

}
