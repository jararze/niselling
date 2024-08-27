<div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Exportar información.</h2>
                <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_customers_export_form" class="form" action="{{ route('backend.quote.index.export') }}" method="POST">
                    @csrf
                    <div class="fv-row mb-10">
                        <label class="fs-5 fw-semibold form-label mb-5">Select Export Format:</label>
                        <select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                            <option value="cvs">CVS</option>
                            <option value="zip">ZIP</option>
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                        <select data-control="select2" data-placeholder="Select a date range" data-hide-search="true" name="date_range" class="form-select form-select-solid">
                            @for ($i = 0; $i < 12; $i++)
                                <option value="{{ date('Y-m', strtotime("-$i months")) }}">{{ date('F Y', strtotime("-$i months")) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Discard</button>
                        <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
