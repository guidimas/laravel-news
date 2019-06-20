<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\News;
use App\Comment;
use App\User;

class CommentsController extends Controller
{

    public function store(Request $request) {
        // Encontra a noticia
        $news = News::findOrFail($request->input('news_id'));

        // Validacao
        $validated = $request->validate([
            'comment' => 'required|string|max:10000',
            'attachment' => 'nullable|file|max:10000', // Maximo 10MB
        ]);

        // Cria o comentario
        $comment = new Comment($validated);

        // Usuario logado
        $user = null;
        
        // Se estiver logado, pega o user
        if (Auth::check()) $user = Auth::user();
        
        // Realiza a associacao do user logado como autor
        $comment->user()->associate($user);

        // Atualiza campo para insersao no banco
        $comment['attachment'] = null;

        // Salva o comentario atraves da noticia
        $comment = $news->comments()->save($comment);

        // Se houver arquivo e nao for nulo
        /* if ($request->hasFile('attachment') && $request->file('attachment')->isValid() && $validated['attachment'] != null) {

            // Novo nome do arquivo
            $filename =  str_replace('/', '', md5($comment->id)); // . '.' . $request->file('attachment')->extension();

            // Faz o upload do arquivo para a pasta uploads
            $request->file('attachment')->storeAs('uploads', $filename);

            // Atualiza campo para atualizacao no banco
            $comment->attachment = $request->file('attachment')->getClientOriginalName();

            // Salva no banco o nome do arquivo
            $comment->save();

        } */

        // Redireciona com a mensagem
        return redirect(route('news.details', $news->id))->with('status', __('Comentário adicionado.'));
    }

    public function download($id) {
        // Encontra o comentario ou morre
        $comment = Comment::findOrFail($id);

        // Recria o nome do arquivo
        $filename = 'uploads/' . str_replace('/', '', md5($comment->id));

        // Se existir o arquivo do anexo
        if (Storage::exists($filename)) {

            // Forca o download do arquivo, com o nome original
            return Storage::download($filename, $comment->attachment);

        }

        // Se nao existir o anexo
        $comment->attachment = null;

        // Salva sem o anexo
        $comment->save();

        // Se nao existir, retorna
        return back();
    }

    public function delete($id) {
        // Retorna o comentario ou morre
        $comment = Comment::findOrFail($id);

        // Se for do usuario, exclui logicamente
        if ($comment->user == Auth::user()) $comment->delete();

        return back();
    }

}
