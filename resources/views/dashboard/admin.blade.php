<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card-box">
            <form action="/import/data" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="header-title mt-0 mb-3">Import Data</h4>
                <span class="text-muted">Download template import <a href="/assets/import/Template.xlsx" target="_blank">Disini</a> !</span>
                <input type="file" name="file" class="dropify"/>
                <button class="btn btn-sm btn-primary float-right mt-3">Upload</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>