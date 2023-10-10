<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function combinedDash()
    {
        if (auth()->user()->user_role == 'author') {
            $authorName = auth()->user()->name;
            $books = Book::with(['author', 'categories'])
                ->whereNull('deleted_at')
                ->whereHas('author', function ($query) use ($authorName) {
                    $query->where('name', $authorName);
                })
                ->count();


            return view('dashboard', [
                'numberOfBooks' => $books,
                // 'booksChange' => $this->calculateChange($books),
            ]);
        }
        $categories = Category::all();
        $categoryNames = $categories->pluck('name');
        $categorydata = [];
        $subscribers = Subscriber::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();
        $sub_dates = $subscribers->pluck('date');
        $sub_counts = $subscribers->pluck('count');

        foreach ($categories as $category) {
            $categorydata[] = $category->books->count();
        }
        return view('dashboard', [
            'numberOfBooks' => $this->getCount(new Book),
            'numberOfAuthors' => $this->getCount(new Author),
            'numberOfCategories' => $this->getCount(new Category),
            'numberOfUsers' => $this->getCount(new User),
            'numberOfSubscribers' => $this->getCount(new Subscriber),
            'usersChange' => $this->calculateChange(new User),
            'authorsChange' => $this->calculateChange(new Author),
            'booksChange' => $this->calculateChange(new Book),
            'subscribersChange' => $this->calculateChange(new Subscriber),
            'categoryNames' => $categoryNames,
            'categorydata' => $categorydata,
            'sub_dates' => $sub_dates,
            'sub_counts' => $sub_counts,
        ]);
    }





    private function getCount($model)
    {
        return $model::count();
    }

    private function calculateChange($model)
    {
        $thisWeek = $model::where('created_at', '>=', now()->startOfWeek())->count();
        $lastWeek = $model::whereBetween('created_at', [now()->startOfWeek()->subWeek(), now()->endOfWeek()->subWeek()])->count();

        return $this->calculatePercentageChange($lastWeek, $thisWeek);
    }

    private function calculatePercentageChange($lastWeek, $thisWeek)
    {
        if ($lastWeek == 0) return 100;
        return round((($thisWeek - $lastWeek) / $lastWeek) * 100, 2);
    }
}
