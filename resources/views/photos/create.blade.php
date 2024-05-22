@extends('layouts.app')

@section('title', 'Add photos')

@push('stylesheets')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("#upload", {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 4, // MB
            maxFiles: 5,
            addRemoveLinks: true,
            clickable: ".dropzone",
            previewsContainer: "#previewsContainer",
            uploadMultiple: true,
            autoProcessQueue: false,
            acceptedFiles: 'image/*',
        });

        function callAlert() {
            // The photos have been successfully saved
            document.getElementById('alert-message').style.display = 'flex'
            document.getElementById('alert-text').textContent = 'The photos have been successfully saved'
        }

        function deleteFileFromFormData(fileName, formData) {
            let files = formData.getAll('photos[]');

            let editedFormData = new FormData()

            files.forEach( file => {
                if (file.name === fileName) {
                    return
                }

                editedFormData.append('photos[]', file)
            })

            return editedFormData;
        }

        myDropzone.on("addedfile", file => {
            if (!document.getElementById('upload').formData) {
                document.getElementById('upload').formData = new FormData();
            }
            // Append the file to the FormData object
            document.getElementById('upload').formData.append("photos[]", file);
        });

        myDropzone.on('removedfile', file => {
            // Remove the file from the FormData object
            document.getElementById('upload').formData = deleteFileFromFormData(file.name, document.getElementById('upload').formData)
        })

        document.getElementById('upload').addEventListener('submit', e => {
            e.preventDefault();
            // Get the FormData object attached to the form
            let formData = document.getElementById('upload').formData;

            // Make sure there are files to upload
            if (formData && myDropzone.getQueuedFiles().length > 0) {
                // Append any additional form data if needed
                // For example:
                // formData.append('name', document.getElementById('name').value);

                // Submit the form with the FormData using fetch
                fetch(document.getElementById('upload').action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            myDropzone.processQueue()
                            setTimeout(() => {
                                myDropzone.removeAllFiles(true)
                                callAlert()
                            }, 1700)
                        } else {
                            throw new Error('Network response was not ok.');
                        }
                    })
                    .catch(function(error) {
                        console.error('There was a problem with your fetch operation:', error.message);
                    });
            }
        })
    </script>
@endpush

@section('content')
    <x-alert type="success"></x-alert>
    <div>
        <div class="img_card">
            <div class="row justify-content-center">
                <div class="col-md-6 col-7 content_section">
                    <!--=================== contact info and form start====================-->
                    <div class="content_box">
                        <div class="content_box_inner">
                            <form id="upload" action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                                <div id="previewsContainer" class="dropzone">
                                    <div class="dz-default dz-message">
                                        <button class="dz-button" type="button">
                                            Drop files here to upload
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <button class="btn btn-outline-success" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--=================== contact info and form end====================-->
                </div>
                <div class="col-md-6 col-5 img_section">
                    <img src="{{ asset('assets/img/photos/create.jpeg') }}" alt="back">
                    <img src="{{ asset('assets/img/photos/create2.webp') }}" alt="back">
                </div>
            </div>
        </div>
    </div>
@endsection
