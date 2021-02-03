<div class="modal fade confirm-modal" id="confirm-modal-{{$quote->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 bg-theme">
                <h5 class="modal-title text-light" id="exampleModalLabel">Pay Quote</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="service-form" wire:submit.prevent="pay">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{$phone}}" wire:model.lazy="phone">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password1">Amount (Ksh)</label>
                            <input type="text" readonly name="service_cost"
                               id="service-cost" class="form-control" value="{{number_format($quote->amount * 110)}}">
                    </div>
                    <div class="form-group">
                        <label for="method">Payment Method</label>
                        <select class="form-control" id="method" name="method">
                            <option selected value="1">Mpesa</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit"
                        form="service-form"
                        class="btn bg-theme text-light btn-modal-pay">
                    Pay</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        livewire.on('stk_error', data => {
            toastr.error(data.message, "Ooops")
            $('.modal-body').remove('#loader');
            $('.btn-modal-pay').prop('disabled', false)
        });

        livewire.on('stk_success', data => {
            toastr.info(data.message, "Hurray!")
            $('.modal-body').remove('#loader');
            $('.btn-modal-pay').prop('disabled', false)
        });

        $('#service-form').on('submit', function (e){
            e.preventDefault();
            $('.confirm-modal .modal-body').append(`<div id="loader"></div>`);
            $('.btn-modal-pay').prop('disabled', true)
        });

        Echo.private(`stk.{{Auth::id()}}`)
            .listen('StkResponse', (data) => {
                if (data && data.error){
                    toastr.error(data.message, "Ooops");
                }else if(data && !data.error){
                    toastr.options.onHidden = function (){
                        location.reload();
                    }
                    toastr.success(data.message, 'Hurray!');
                }
            });
    </script>
@endsection
