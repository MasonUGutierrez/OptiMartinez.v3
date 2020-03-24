<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanPagoFormRequest;
use App\PlanPago;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;

class PlanPagoController extends Controller
{
    //
    public function index(){

        $planpago= new PlanPago();

        $planpago = PlanPago::where('estado',1)->orderBy('id_plan_pago','desc')->get();


        return view('planpagos.index',['planpago'=>$planpago]);
    }

    public function show($id){
        /*$planpago= DB::table('plan_pago')->where('id_plan_pago','=',$id)->get();*/
        return view("planpagos.show",["planpago" => PlanPago::findOrFail($id)]);
    }

    public function edit($id){
        /*$planpago = DB::table('plan_pago')->where('id_plan_pago','=',$id)->get();*/
        return view("planpagos.edit",["planpago" => PlanPago::findOrFail($id)]);
    }

    public function create(){
        return view("planpagos.create");
    }

    public function store(PlanPagoFormRequest $request){
        try{
            DB::beginTransaction();
            $plan_pago = new PlanPago;
            $plan_pago->plan_pago = $request->get('plan_pago');
            $plan_pago->descripcion = $request->get('descripcion');
            $plan_pago->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return Redirect::to('planpago');
    }

    public function update(PlanPagoFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $plan_pago = PlanPago::findOrFail($id);
            $plan_pago->plan_pago = $request->get('plan_pago');
            $plan_pago->descripcion = $request->get('descripcion');
            $plan_pago->update();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return Redirect::to('planpago');
    }

    public function destroy($id){
        $planpago = PlanPago::findOrFail($id);
        $planpago->estado = '0';
        $planpago->update();
        return Redirect::to('planpago');
    }
}
