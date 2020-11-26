<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB; 

use Carbon\Carbon; 
use Hash; 


class Usuario extends Model
{
    protected $connection= 'sqlite';
    protected $table= 'usuario';

    public static function listar (int $limite){
        $sql = self::select([
            "id",
            "nome",
            "email",
            "senha",
            "data_cadastro"
        ])
        ->limit($limite)->get();
        //dd($sql->toSql());
        return $sql;
    }

    public static function  cadastrar(Request $request){

        DB::enableQueryLog();

        return self::insert([
            "nome"=> $request -> input ('nome'), 
            "email"=> $request -> input ('email'), 
            "senha"=> Hash::make($request->input('senha')), 
            "data_cadastro"=> new Carbon()
        ]);
        
        dd(DB::getQueryLog());
        
    }
}
