let offset = 1;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let isLoading = false;

let $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    percentPosition: true,
    masonry: {
        columnWidth: '.grid-sizer'
    }
});

$grid.imagesLoaded().progress(function() {
    $grid.isotope('layout');
});

function addPhotos(photos) {
    const $photos = $(photos);
    $grid.append($photos)
        .isotope('appended', $photos);

    $photos.imagesLoaded().progress(function() {
        $grid.isotope('layout');
    });
}

function observeLastPhoto() {
    const photos = document.querySelectorAll('.photo-sq');
    const lastPhoto = photos[photos.length - 1];
    if (lastPhoto) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                observer.disconnect();
                loadMorePhotos();
            }
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 1.0
        });
        observer.observe(lastPhoto);
    }
}

function loadMorePhotos() {
    if (isLoading) return;
    isLoading = true;

    const loader = document.getElementById('loader');
    loader.style.display = 'flex';
    const noMoreDataElement = document.getElementById('no-more-data');

    fetch(`/photos/fetch/${offset}`, {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            if (response.status === 204) {
                noMoreDataElement.style.display = 'block';
                throw new Error('No more data');
            } else {
                return response.text();
            }
        })
        .then(data => {
            addPhotos(data);
            loader.style.display = 'none';
            isLoading = false;
            offset++;

            observeLastPhoto();
        })
        .catch(error => {
            console.error('Error fetching posts:', error);
            loader.style.display = 'none';
        });
}

observeLastPhoto();
