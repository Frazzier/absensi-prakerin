<div class="row">
    <div class="col-12 mb-2" style="border-left: 5px solid #f0ad4e; border-radius: 5px;"><h5>Identitas</h5></div>
    <div class="col-12 col-md-6 text-center">
        @if($user->profile_picture)
        <a href="{{$user->profile_picture}}" target="_blank" title="Photo">
            <img src="{{$user->profile_picture}}" class="thumb-img img-fluid" alt="Thumbnail">
        </a>
        @else
        <a href="/assets/images/noimage.jpeg" target="_blank" title="Photo">
            <img src="/assets/images/noimage.jpeg" class="thumb-img img-fluid" alt="Thumbnail">
        </a>
        @endif
    </div>
    <div class="col-12 col-md-6">
        <p><strong>Nama : </strong>{{$user->name}}</p>
        <p><strong>Email : </strong>{{$user->email}}</p>
    </div>
</div>