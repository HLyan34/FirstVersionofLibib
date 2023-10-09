<?php

namespace App\Http\Middleware;

use App\Models\Author;
use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthorIsReal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bookId = $request->route('book');

        if (auth()->user()->user_role == 'author') {

            $author = Author::where("name", auth()->user()->name)->first();

            if (!$author || !$author->books()->where('id', $bookId)->exists()) {
                return redirect()->route('books.index')->with('error', 'You are not authorized to edit this book.');
            }
        }
        return $next($request);
    }
}
