<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\News;

class NewsController extends Controller
{

    public function index() {
        return view('news.index', [ 'news' => News::orderBy('updated_at', 'desc')->get() ]);
    }

    public function create() {
        return view('news.create');
    }

    public function store(Request $request) {
        // Validacao
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'lead' => 'required|string|max:190',
            'image' => 'nullable|image|max:10000', // 10MB
            'body' => 'required|string|max:1000',
        ]);

        // Cria a noticia
        $news = new News($validated);
        
        // Atualiza campo para insercao no banco
        $news['image'] = null;

        // Se estiver logado
        if (Auth::check()) {
            // Usuario logado
            $user = Auth::user();

            // Salva a noticia atraves do usuario logado
            $user->news()->save($news);
        } else {
            // Salva a noticia sem usuario
            $news->save();
        }

        // Se houver arquivo e nao for nulo
        /* if ($request->hasFile('image') && $request->file('image')->isValid() && $validated['image'] != null) {

            // Faz o upload do arquivo para a pasta de imagens e gera o nome
            $filename = $request->file('image')->store('images', 'public');

            // Atualiza campo para atualizacao no banco
            $news->image = $filename;

            // Salva no banco o nome do arquivo
            $news->save();

        } */

        // Redireciona com a mensagem
        return redirect(route('news.create'))->with('status', __('Notícia cadastrada com sucesso.'));
    }

    public function details($id) {
        // Noticia
        $news = News::findOrFail($id);

        // View
        return view('news.details', [ 'news' => $news ]);
    }

    public function delete($id) {
        // Noticia
        $news = News::findOrFail($id);

        // Senao for do usuario, retorna
        if ($news->user != Auth::user()) return back();

        // Exclui a noticia
        $news->delete();

        // Retorna com a mensagem
        return redirect(route('news'))->with('status', __('Notícia excluída.'));
    }
}
