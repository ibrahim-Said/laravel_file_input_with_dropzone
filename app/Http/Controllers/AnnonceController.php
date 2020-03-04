<?php

namespace App\Http\Controllers;

use App\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Return Response()->json(['success'=>$request->all()]);
        $path=storage_path('app/public/uploads');
        if($request->hasFile('file'));{
            foreach ($request->file as $photo) {
            /* $filename = uniqid() . '_' . trim($photo->getClientOriginalName());
            //$photo->move($path, $filename);
            //Storage::put('/uploads'.$filename,fopen($photo, 'r+'));
            $p=$photo->store('uploads/'.date('Y').'-'.date('m'));
            $annonce=new Annonce();
            $annonce->nom=$request->nom;
            $annonce->file=$p;
            $annonce->save(); */
            //$image = $request->file('image');

            $image_name = time() . '.' . $photo->getClientOriginalExtension();

            $destinationPath = public_path('storage/thumbnail') . '/'.date('Y').'-'.date('m').'/' ;

            $resize_image = \Image::make($photo->getRealPath());
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
                $resize_image->resize(600, 300, function($constraint){
                    $constraint->aspectRatio();
                   })->save($destinationPath. $image_name);
            }else{
                $resize_image->resize(600, 300, function($constraint){
                    $constraint->aspectRatio();
                   })->save($destinationPath. $image_name);
            }
            $annonce=new Annonce();
            $annonce->nom=$request->nom;
            $annonce->file=$destinationPath. $image_name;
            $annonce->save();

            //$destinationPath = public_path('/images');

           // $photo->move($destinationPath, $image_name);
        }
        Return Response()->json(['success'=>true]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
