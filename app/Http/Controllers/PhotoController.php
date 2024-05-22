<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Photo;
use App\Repositories\PhotoRepository;
use App\Services\FileManager;
use App\Services\Searcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class PhotoController extends Controller
{
    private PhotoRepository $repository;

    public function __construct()
    {
        $this->repository = new PhotoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Searcher $searcher): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $search = $request->search;
        $dateFilterFrom = $request->date_from;
        $dateFilterTo = $request->date_to;

        if ($search === null && $dateFilterFrom === null && $dateFilterTo === null) {
            $photos = $this->repository->getLatestPhotos(15);

            return view('photos.index', ['photos' => $photos, 'withLazyLoad' => true]);
        }

        $photos = $searcher
            ->setTargets(['original_name', 'translated_name'])
            ->setModel(Photo::class)
            ->setDates($dateFilterFrom, $dateFilterTo)
            ->search($search);

        if ($photos->count() === Photo::count()) {
            return view('photos.index', ['photos' => $photos, 'withLazyLoad' => true]);
        }

        return view('photos.index', ['photos' => $photos, 'withLazyLoad' => false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Application|View|\Illuminate\Foundation\Application|Factory
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request, FileManager $fileManager): ResponseFactory|Application|Response|\Illuminate\Foundation\Application
    {
        $photos = $request->file('photos');

        $paths = $fileManager->save($photos);

        $this->repository->createPhotos($paths);

        return response('ok', status: 200);
    }

    public function show(Photo $photo, FileManager $fileManager): ResponseFactory|Application|Response|\Illuminate\Foundation\Application
    {
        $file = $fileManager->get($photo->path);
        $mimeType = $fileManager->mimeType($photo->path);

        return response($file, 200)->header('Content-Type', $mimeType);
    }

    public function download(Photo $photo): BinaryFileResponse
    {
        return response()->download(storage_path('app/' . $photo->path), $photo->original_name);
    }

    public function fetch(int $offset): ResponseFactory|Application|Response|\Illuminate\Foundation\Application|string
    {
        $photos = $this->repository->getPhotosWithOffset($offset, 4);

        if ($photos->isEmpty()) {
            return response(status: 204);
        }

        return view('photos.partials.photos', ['photos' => $photos])->render();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo, FileManager $fileManager): ResponseFactory|Application|Response|\Illuminate\Foundation\Application
    {
        $fileManager->delete($photo->path);
        $photo->delete();

        return response('ok', status: 200);
    }
}
