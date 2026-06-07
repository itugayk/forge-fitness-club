<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use App\Models\ClassSchedule;
use App\Models\GalleryImage;
use App\Models\MembershipApplication;
use App\Models\MembershipPlan;
use App\Models\Post;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Trainer;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => Service::active()->ordered()->get(),
            'plans' => MembershipPlan::active()->ordered()->get(),
            'trainers' => Trainer::active()->ordered()->take(4)->get(),
            'testimonials' => Testimonial::active()->ordered()->get(),
            'gallery' => GalleryImage::active()->ordered()->take(8)->get(),
            'posts' => Post::published()->latest('published_at')->take(3)->get(),
            'stats' => $this->stats(),
        ]);
    }

    public function timetable()
    {
        return view('pages.timetable');
    }

    public function services()
    {
        return view('pages.services', [
            'services' => Service::active()->ordered()->get(),
            'plans' => MembershipPlan::active()->ordered()->get(),
        ]);
    }

    public function trainers()
    {
        return view('pages.trainers', [
            'trainers' => Trainer::active()->ordered()->get(),
        ]);
    }

    public function trainerShow(Trainer $trainer)
    {
        abort_unless($trainer->is_active, 404);

        $trainer->load(['schedules' => fn ($q) => $q->active()->with('category')
            ->orderBy('day_of_week')->orderBy('start_time')]);

        return view('pages.trainer-show', [
            'trainer' => $trainer,
            'related' => Trainer::active()->ordered()->where('id', '!=', $trainer->id)->take(3)->get(),
        ]);
    }

    public function gallery()
    {
        return view('pages.gallery', [
            'images' => GalleryImage::active()->ordered()->get(),
        ]);
    }

    public function blog()
    {
        return view('pages.blog', [
            'posts' => Post::published()->latest('published_at')->paginate(9),
        ]);
    }

    public function blogShow(Post $post)
    {
        abort_unless($post->is_published, 404);

        return view('pages.blog-show', [
            'post' => $post,
            'related' => Post::published()->where('id', '!=', $post->id)
                ->latest('published_at')->take(3)->get(),
        ]);
    }

    public function join(Request $request)
    {
        return view('pages.join', [
            'plans' => MembershipPlan::active()->ordered()->get(),
            'selectedPlan' => $request->query('plan'),
            'selectedPeriod' => $request->query('period', 'monthly'),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    private function stats(): array
    {
        return [
            'members' => config('forge.stats.members_base') + MembershipApplication::count(),
            'classes' => ClassSchedule::active()->count(),
            'trainers' => Trainer::active()->count(),
            'years' => config('forge.stats.years'),
            'categories' => ClassCategory::count(),
            'pt_sessions' => config('forge.stats.pt_sessions'),
        ];
    }
}
