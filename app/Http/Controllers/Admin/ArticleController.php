<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use  App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Article::paginate( PaginationEnum::Show10Records );
         return view('admin/article/index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/article/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
    $article = Article::create(  $request->createArticle() )
                ->translate();

    if ( $request->hasFile('video') &&
            $request->file('video')->isValid()
        )
        {
            $Vpath =  $request->file('video')
                                ->storeAs('public/article/video',
                                    $article->id.'.'.$request->video->extension()
                                );

                $article->video = $Vpath;
                $article->save();

        }

     if ( $request->hasFile('banner') &&
            $request->file('banner')->isValid()
        )
        {
            $path =  $request->file('banner')
                                ->storeAs('public/article/banner',
                                    $article->id.'.'.$request->banner->extension()
                                );
          \Log::info($path);

                $article->image()->create([
                    'url' => $path,
                ]);

        }
    return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::CreatedMsg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin/article/edit', [
            'record' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request,  Article $article)
    {
     $article->update(  $request->updateArticle() );

    $article->translate();
    return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::UpdateMsg);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Article $article)
    {
         $article->delete();
        return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }


    public function videoDelete($id)
    {
        $article = Article::findOrFail($id);


         // Storage::delete('public/'.$article->video);
         $article->video = null;
         $article->update();
        return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }



    public function imageDelete($id)
    {
        $article = Article::with('image')->findOrFail($id);

         Storage::delete('public/'.$article->image->url);
         $article->image()->delete();
        return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }

    public function imageUpdate (Request $request,$id)
    {
        $article = Article::with([ 'image' =>  function ($query) {
            $query->withTrashed('image');
        }])->findOrFail($id);


        if ( $request->hasFile('banner') &&
            $request->file('banner')->isValid()
        )
        {

            $path =  $request->file('banner')
                                ->storeAs('public/article/banner',
                                    $article->id.'.'.$request->banner->extension()
                                );
            if ( $article->image && $article->image->trashed()) {
              $article->image->restore();
            }
            $image =$article->image();

                if ( $article->image )
                {
                  $image->update([
                                'url' =>  Str::replaceFirst('public/', '', $path)
                            ]);
                } else {
                  $image->create([
                                'url' =>  Str::replaceFirst('public/', '', $path)
                            ]);
                }


          \Log::info(Str::replaceFirst('public/', '', $path));
        }

        return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::CreatedMsg);;

    }

     public function videoUpdate (Request $request,$id)
    {
        $article = Article::with('image')->findOrFail($id);
        if ( $request->hasFile('video') &&
            $request->file('video')->isValid()
        )
        {
            $Vpath =  $request->file('video')
                                ->storeAs('public/article/video',
                                    $article->id.'.'.$request->video->extension()
                                );

                $article->video = Str::replaceFirst('public/', '', $Vpath);
                $article->save();

        }


        return redirect()->route('admin.article.index')->with('success',FlashMessagesEnum::CreatedMsg);

    }


    public function bilingual(Article $article, $field)
    {
    return view('admin._common.bilingual',[
            'record' => $article,
             'text' => $field,
             'field' => 'hi_'.$field,
             'field_value'  =>  $article->{'hi_'.$field},
             'update_route' => route('admin.article.bilingual', $article->id)
        ]);
    }

    public function storeBilingual(Request $request, Article $article)
    {
        $final = collect($request->all() )->translatable($article);
       $article->update($final);

        return redirect()
                ->route('admin.article.index')
                ->with('success',FlashMessagesEnum::UpdateMsg);

    }
}
