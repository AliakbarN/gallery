@foreach($photos as $photo)
    <div class="grid-item photo-sq col-sm-12 col-md-6 col-lg-3">
        <a href="{{ route('photos.show', $photo->id) }}" data-delete-url="{{ route('photos.destroy', $photo->id) }}" data-download-url="{{ route('photos.download', $photo->id) }}" title="{{ $photo->original_name }}">
            <div class="project_box_one">
                <img src="{{ route('photos.show', $photo->id) }}" alt="{{ $photo->original_name }}" />
                <div class="product_info">
                    <div class="product_info_text">
                        <div class="product_info_text_inner">
                            <i class="ion ion-plus"></i>
                            <h4>{{ $photo->original_name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
