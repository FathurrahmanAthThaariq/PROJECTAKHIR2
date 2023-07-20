<!--begin::Modal dialog-->
<div class="modal-dialog modal-dialog-centered mw-650px">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Form-->
        <form class="form" id="form_input" method="POST"
            action="{{ route('backend.products.updateStock', $product->id) }}">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder" data-kt-edit-limit="title">Add Stock</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip"
                    title="Close Modal Event" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
                <!--begin::Input group-->
                <div class="fv-row mb-9">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold required mb-2">Product</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div class="fv-input-group">
                        <input type="text" class="form-control" name="product" id="product" placeholder="Product"
                            value="{{ $product->name }}" readonly />
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-9">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold required mb-2">Quantity</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div class="fv-input-group">
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity"
                            value="0" />
                    </div>
                </div>
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" class="btn btn-primary" data-kt-element="submit">
                    <span class="indicator-label">Save Changes</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Modal footer-->
        </form>
        <!--end::Form-->
    </div>
</div>
<!--end::Modal dialog-->
<script>
    $(document).ready(function() {
        $('#form_input').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            $.ajax({
                url: url,
                method: method,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {

                },
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message, 'Success');
                        window.location.reload();
                    } else {
                        toastr.error(data.message, 'Error');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    toastr.error(thrownError, 'Error');
                },
                complete: function() {
                    KTApp.unblockPage();
                }
            });
        });
    });
</script>
