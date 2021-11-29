<?php

namespace App\Http\Controllers;

use App\Repositories\QrCodeRepository;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use File;
use ZipArchive;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function generate(Request $request){
    //foreach($request as $value){
        $image = \QrCode::format('png')
                 ->size(200)
                 ->generate($request[0]);
        $output_file = $request[0]. time() . '.png';
        Storage::disk('public')->put($output_file,$image); 
    //}
    }
    public function downloadZip()
    {
        $zip = new ZipArchive;
   
        $fileName = 'myFile.zip';
   
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
      
        if (file_exists(public_path($fileName)))
        {
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);  
        } else {
        return ['status'=>'zip file does not exist'];
    }
    }

}
