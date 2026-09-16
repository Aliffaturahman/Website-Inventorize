@extends('../layout.main')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Roll Kain</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../form/Roll">Roll</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- CONTENT -->
    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="select2SinglePlaceholder2">Kain</label>
                                <select class="select2-single-placeholder2 form-control" name="state"
                                    id="select2SinglePlaceholder2" required>
                                    <option value="">Select</option>
                                    <option value="Aceh">Aceh</option>
                                    <option value="Sumatra Utara">Sumatra Utara</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="touchSpin2">Total Yard</label>
                                <input id="touchSpin2" type="number" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mb-1">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsCode')
<script>
    $(document).ready(function () {

        // Select2 Single  with Placeholder
        $('.select2-single-placeholder2').select2({
            placeholder: "Select Kain",
            allowClear: true
        });

        $('#touchSpin2').TouchSpin({
            min: 0,
            max: 1000000000,
            decimals: 2,
            step: 0.01,
            postfix: 'yard',
            initval: 0,
            boostat: 5,
            maxboostedstep: 10
        });

    });
</script>
@endsection