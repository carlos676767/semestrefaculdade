<?php


namespace App\Providers;

use App\Http\Controllers\repo\ReporProduct;

final class ServiceItensInsert
{
    static public function Products($name, $price, $description, $req)
    {

      
        try {
            $file = $req->file('image');
            $path = $file->store('uploads', 'public');

            $pathbs = asset('storage/' . $path);

         
            ReporProduct::insertProduct($name, $pathbs, $price, $description);
        
        } catch (\Throwable $th) {
           throw new \Exception($th->getMessage(), 1);
           
        }
    }
}
