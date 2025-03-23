<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function index ()
    {
        $classifications = Classification::all();
        return view ('classifications/classification', compact ('classifications'));
    }

    public function createClassification (Request $request)
    {
        $request->validate([
            'class'=>'required',
            'level'=>'required',
            'category'=>'required',
            'subject'=> 'required',
        ]);

        $classification = new Classification ();
        $classification->class = $request->class;
        $classification->level = $request->level;
        $classification->category = $request->category;
        $classification->subject = $request->subject;

        $classification -> save();

        $classificationCheck = Classification::find($classification->id);

        return response()->json($classificationCheck);
    }

    public function getClassifications()
    {
        $classification = Classification::all();
        if ($classification){
            return response()->json($classification);
        }
        else {
            return response("No classification was found");
        }
    }

    public function getClassification($id)
    {
        try {
            $classification = Classification::findOrFail($id);
            return response()->json($classification);
        }
        catch(\Exception $e) {
            return response()->json([
                "error"=>"Classification not found with id: ", $id
            ], 404);
        }
    }

    public function updateClassification(Request $request, $id)
    {
        $request->validate([
            'class'=>'required',
            'level'=>'required',
            'category'=>'required',
            'subject'=> 'required',
        ]);

        try {
            $existingClassification = Classification::findOrFail($id);
            if($existingClassification) {
                $existingClassification->class = $request->class;
                $existingClassification->level = $request->level;
                $existingClassification->category = $request->category;
                $existingClassification->subject = $request->subject;

                $existingClassification->save();

                return response()->json($existingClassification);
            }
            else{
                response()->json("No Record Found!");
            }
        }
        catch(\Exception $e) {
            return response()->json([
                "error"=>"Classification could not be updated"
            ], 404);
        }
    }

    public function deleteClassification($id)
    {
        try{
            $existingClassification=Classification::findOrFail($id);
            if ($existingClassification){
                $existingClassification->delete();
                return response()->json([
                    "deleted"=>$existingClassification
                ]);
            }
            else {
                return response("Classification does not exist");
            }
        }
        catch (\Exception $e) {
            return response() -> json([
                "error"=>"Classification could not be deleted"
            ], 403);
        }
    }
}
