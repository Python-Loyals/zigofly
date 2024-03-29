<div class="modal fade checkout-modal" id="checkout-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 bg-theme">
                <h5 class="modal-title text-light" id="exampleModalLabel">Mpesa Checkout</h5>
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
                        <input type="text" readonly name="service_cost" readonly
                               id="service-cost" class="form-control" value="{{number_format(Cart::total() * 110)}}">
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
            $('.checkout-modal .modal-body').prepend(`<div id="loader"></div>`);
            $('.btn-modal-pay').prop('disabled', true)
        });
    </script>
@endsection

