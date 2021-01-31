<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_note;  

class NoteRouterController extends Controller
{
    private $array = ['error'=>'', 'result'=>[]];

    public function all(){ 
        $tb_notes = Tb_note::all();

        foreach($tb_notes as $tb_note){
            $this->array['result'][] = [
                'id'=> $tb_note->id,
                'title' => $tb_note->title
            ];
        }

        return $this->array;
    }

    public function one($id){
        $tb_notes = Tb_note::find($id);

        if($tb_notes){
            $this->array['result'] = $tb_notes;
        }else{
            $this->array['error'] = 'ID não encontrado';
        }

        return$this->array;
    }

    public function new(Request $request){
        $title = $request->input('title');
        $body = $request->input('body');

        if($title && $body){
            $tb_notes = new Tb_note();
            $tb_notes->title = $title;
            $tb_notes->body = $body;
            $tb_notes->save();

            $this->array['result'] = [
                'id' => $tb_notes->id,
                'title' => $title,
                'body' => $body
            ];
        }else{
            $this->array['error'] = 'Campos não enviados';
        }
        return $this->array;
    }

    public function edit(Request $request, $id){

        $title = $request->input('title');
        $body = $request->input('body');

        if($id && $title && $body){
            $tb_notes = Tb_note::find($id);
            if($tb_notes){
                $tb_notes->title = $title;
                $tb_notes->body = $body;
                $tb_notes->save();

                $this->array['result'] =  [
                    'id' => $tb_notes->id,
                    'title' => $title,
                    'body' => $body
                ];
            }else{
                $this->array['error'] = 'ID não existe';
            }
        }else{
            $this->array['error'] = 'Campos não enviados';
        }

        return$this->array;
    }

    public function delete($id){
        $tb_notes = Tb_note::find($id);

        if($id){
            $tb_notes->delete();
        }else{
            $this->array['error'] = 'ID não existe';
        }

        return$this->array;
    }
}
