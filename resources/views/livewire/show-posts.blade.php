<div>
    {{-- The whole world belongs to you. --}}

    <!-- Large modal -->


    <button type="button" wire:click="popUP(9)" type="button" class="btn btn-primary d-inline" data-toggle="modal"
        data-target=".bd-example-modal-lg">Ajax</button>
    <div id='popup'class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                ...
                {{-- <h5 class="card-title">Title: {{ $post['title'] }}</h5> --}}


                <h1>hello</h1>
            </div>
        </div>
    </div>
</div>
