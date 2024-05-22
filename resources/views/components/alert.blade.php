<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: #dff0d8;
        color: #3c763d;
        align-items: center;
        display: none;
    }

    .alert-success {
        background-color: #dff0d8;
    }

    .alert-danger {
        background-color: #f2dede;
        color: #a94442;
    }

    .alert-button {
        margin-left: auto;
        border: none;
        background-color: transparent;
        cursor: pointer;
        font-size: 1.5rem;
    }

    .alert span {
        margin-left: 10px;
    }
</style>

<div id="alert-message" class="alert @if($type === 'success') alert-success @elseif($type === 'danger') alert-danger @endif ">
    <i class="bx bx-xs bx-desktop me-2"></i>
    <span id="alert-text"></span>
    <button class="alert-button">&times;</button>
</div>

<script>
    const alertElement = document.querySelector('.alert');
    const closeButton = document.querySelector('.alert-button');

    closeButton.addEventListener('click', () => {
        alertElement.style.display = 'none';
    });
</script>
