<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public $profile = 'Admin';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $rules = [
        'nombre' => 'required',
        'valor' => 'required|numeric',
        'descripcion' => 'required',
    ];

    public function index()
    {
        $perfil = Auth::user()->perfil;
        if($perfil == $this->profile){
            $gastos = Expense::get();
        }
        else{
            $gastos = Expense::where('user_id',Auth::user()->id)->get();
        }

        return ResponseController::Success($gastos,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $validator = Validator::make($req->input(), $this->rules);
        if($validator->fails()){
            return ResponseController::Error($validator->errors(),500);
        }
        $data = $validator->validated();
        $data['user_id'] = Auth::user()->id;
        $gasto = Expense::create($data);
        return ResponseController::Success($gasto,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $perfil = Auth::user()->perfil; 
        if($perfil == $this->profile){
            $expense = Expense::where('id',$id)->first();
        }else{
            $expense = Expense::where('id',$id)
            ->where('user_id',Auth::user()->id)
            ->first();
        }
        
        if(!$expense){
            return ResponseController::Error("No Existe Gastos con el ID $id",404);
        }
        return ResponseController::Success($expense,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perfil = Auth::user()->perfil; 
        if($perfil == $this->profile){
            $expense = Expense::where('id',$id)->first();
        }else{
            $expense = Expense::where('id',$id)
            ->where('user_id',Auth::user()->id)
            ->first();
        }
        
        if(!$expense){
            return ResponseController::Error("No Existe Gastos con el ID $id",404);
        }
        $validator = Validator::make($request->input(),[
            'nombre' => ['required'],
            'valor' => ['required', 'numeric'],
            'descripcion' => ['required'],

        ]);
        if($validator->fails()){
            return ResponseController::Error($validator->errors(),400);
        }
        $data = $validator->validated();
        $expense->update($data);
        return ResponseController::Success($expense,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $perfil = Auth::user()->perfil; 
        if($perfil == $this->profile){
            $expense = Expense::where('id',$id)->delete();
        }else{
            $expense = Expense::where('id',$id)
            ->where('user_id',Auth::user()->id)
            ->delete();
        }
        if(!$expense){
            return ResponseController::Error("No Existe Gastos con el ID $id",404);
        }
        return ResponseController::Success("Gasto Eliminado Con Exito",200);
    }

}
