<x-layouts.app title="Create Article">
  <div class="container mt-5">
    <div class="row justify-content-center mb-4">
      <div class="col-12 text-center">
        <h1 class="display-5 fw-bold text-primary mb-2"><i class="bi bi-pencil-square me-2"></i>Create New Article</h1>
        <p class="lead text-muted">Share your knowledge with the community</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Title</label>
                <input type="text" class="form-control rounded-pill" id="title" placeholder="An interesting title here" name="title">
                <div class="mb-3">
                  <label for="image" class="form-label fw-semibold">Image URL</label>
                  <input type="text"
                    class="form-control rounded-pill"
                    id="image"
                    name="image"
                    placeholder="https://example.com/image.jpg"
                    value="{{ old('image') ?? ($article->image ?? '') }}"
                    oninput="previewImageUrl(this.value)">
                </div>

                <div class="mt-3">
                  <img id="preview"
                    src="{{ old('image') ?? ($article->image ?? '') }}"
                    style="max-width: 200px; border-radius: 10px; {{ (old('image') ?? ($article->image ?? '')) ? '' : 'display:none;' }}">
                </div>
              </div>
              <div class="mb-3">
                <label for="editor" class="form-label fw-semibold">Content</label>
                <div id="editor" style="height: 200px;"></div>
                <input type="hidden" name="content" id="content-input">
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold"><i class="bi bi-save me-1"></i>Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-slot:scripts>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script>
      const quill = new Quill('#editor', {
        theme: 'snow'
      });
      const contentInput = document.querySelector('#content-input');
      // Imposta il valore iniziale
      contentInput.value = quill.root.innerHTML;
      // Aggiorna a ogni modifica
      quill.on('text-change', function() {
        contentInput.value = quill.root.innerHTML;
      });
      // Aggiorna anche al submit (per sicurezza)
      const form = document.querySelector('form');
      form.onsubmit = function() {
        contentInput.value = quill.root.innerHTML;
      };

      function previewImageUrl(url) {
    const preview = document.getElementById('preview');

    if (url) {
        preview.src = url;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}
    </script>
    </x-slot>
</x-layouts.app>